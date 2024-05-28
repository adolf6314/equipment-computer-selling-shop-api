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
        Schema::create('members', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->char('password', 70);
            $table->char('phone', 10);
            $table->char('gender', 1);
            $table->char('work_status', 1);
            $table->char('status', 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
