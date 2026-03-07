{{-- Auto-logout component - Automatically logs out user after inactivity --}}
<script>
    (function () {
        // Configuration
        const TIMEOUT_DURATION = {{ $timeout ?? 18000 }}; // seconds (default: 5 hours)
        const WARNING_BEFORE = {{ $warningBefore ?? 30 }}; // show warning X seconds before logout

        let inactivityTimer;
        let warningShown = false;

        // Create warning modal
        const warningModal = document.createElement('div');
        warningModal.id = 'auto-logout-warning';
        warningModal.className = 'fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50';
        warningModal.innerHTML = `
        <div class="bg-dark-900 border border-dark-800 rounded-lg p-6 max-w-md mx-4 shadow-xl">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-10 h-10 bg-yellow-500/10 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-white mb-2">Sesi Akan Berakhir</h3>
                    <p class="text-gray-400 text-sm mb-4">Anda akan otomatis logout dalam <span id="countdown" class="text-yellow-500 font-semibold"></span> detik karena tidak ada aktivitas.</p>
                    <button onclick="window.autoLogout.resetTimer()" class="w-full px-4 py-2 bg-gold-400 hover:bg-gold-500 text-dark-950 font-medium rounded transition-colors">
                        Tetap Login
                    </button>
                </div>
            </div>
        </div>
    `;
        document.body.appendChild(warningModal);

        // Reset inactivity timer
        function resetTimer() {
            clearTimeout(inactivityTimer);
            warningShown = false;
            hideWarning();

            inactivityTimer = setTimeout(() => {
                logout();
            }, TIMEOUT_DURATION * 1000);

            // Show warning before logout
            if (WARNING_BEFORE > 0 && WARNING_BEFORE < TIMEOUT_DURATION) {
                setTimeout(() => {
                    showWarning();
                }, (TIMEOUT_DURATION - WARNING_BEFORE) * 1000);
            }
        }

        // Show warning modal
        function showWarning() {
            if (!warningShown) {
                warningShown = true;
                warningModal.classList.remove('hidden');
                warningModal.classList.add('flex');

                // Countdown
                let remaining = WARNING_BEFORE;
                const countdownEl = document.getElementById('countdown');
                countdownEl.textContent = remaining;

                const countdownInterval = setInterval(() => {
                    remaining--;
                    if (remaining > 0) {
                        countdownEl.textContent = remaining;
                    } else {
                        clearInterval(countdownInterval);
                    }
                }, 1000);
            }
        }

        // Hide warning modal
        function hideWarning() {
            warningModal.classList.add('hidden');
            warningModal.classList.remove('flex');
        }

        // Logout function
        function logout() {
            // Find logout form and submit it
            const logoutForm = document.querySelector('form[action*="logout"]');
            if (logoutForm) {
                logoutForm.submit();
            } else {
                // Fallback: redirect to logout route
                window.location.href = '{{ route("logout") }}';
            }
        }

        // Activity events to track
        const events = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click'];

        // Add event listeners
        events.forEach(event => {
            document.addEventListener(event, resetTimer, true);
        });

        // Expose resetTimer globally for the "Stay Logged In" button
        window.autoLogout = {
            resetTimer: resetTimer
        };

        // Initialize timer on page load
        resetTimer();
    })();
</script>