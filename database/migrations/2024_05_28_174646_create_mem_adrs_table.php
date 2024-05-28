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
        Schema::create('mem_adrs', function (Blueprint $table) {
            $table->string('mem_id', 10);
            $table->string('address', 100);
            $table->string('sub_dist_id', 5);
            $table->foreign('mem_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('sub_dist_id')->references('id')->on('sub_districts')->onDelete('cascade');
            $table->primary(['mem_id', 'sub_dist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mem_adrs');
    }
};
