<?php
$response = file_get_contents('http://127.0.0.1:8000/api/available-dates?month=3&year=2026');
$json = json_decode($response, true);
echo "total_slots: " . $json['dates']['2026-03-01']['total_slots'] . "\n";
echo "remaining_slots: " . $json['dates']['2026-03-01']['remaining_slots'] . "\n";
echo "is_blocked: " . ($json['dates']['2026-03-01']['is_blocked'] ? 'true' : 'false') . "\n";
