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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('id',  7)->primary();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->char('password', 70);
            $table->char('phone', 10);
            $table->char('role', 1);
            $table->char('gender', 1);
            $table->char('work_status', 1);
            $table->string('address', 100);
            $table->char('status', 1);
            $table->string('sub_dist_id', 5);
            $table->foreign('sub_dist_id')->references('id')->on('sub_districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
