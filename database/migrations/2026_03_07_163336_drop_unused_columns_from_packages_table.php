<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            // Drop columns safely. Check if they exist to prevent errors.
            $table->dropColumn(['image', 'items_included', 'item_images', 'duration']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->json('items_included')->nullable();
            $table->json('item_images')->nullable();
            $table->string('duration')->nullable();
        });
    }
};
