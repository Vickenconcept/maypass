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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
<<<<<<<< HEAD:database/migrations/2024_08_06_110317_create_templates_table.php
            $table->foreignId('user_id')->nullable();
            $table->string('name');
            $table->string('path'); // Path to the template image
            $table->json('editable_regions'); // JSON to store editable regions
========
            $table->string('name');
            $table->text('description');
>>>>>>>> 3090c57 (update):database/migrations/2024_08_08_090834_create_categories_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
