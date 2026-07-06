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
        Schema::create('finish_goods_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('po');
            $table->string('style');
            $table->string('destination');
            $table->integer('qty_carton');
            $table->integer('qty_garment');
            $table->string('rack_code');
            $table->string('action_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finish_goods_transactions');
    }
};
