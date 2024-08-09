<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
<<<<<<< HEAD:database/migrations/2024_08_06_110325_create_pins_table.php
        Schema::create('pins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('template_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('image_path')->nullable();
            $table->text('url')->nullable();
            $table->timestamps();
=======
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->constrained()->onDelete('set null');
>>>>>>> 3090c57 (update):database/migrations/2024_08_08_093457_add_role_to_users_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_id');
        });
    }
};
