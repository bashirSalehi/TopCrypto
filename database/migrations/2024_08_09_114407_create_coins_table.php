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
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->string('coin_id');
            $table->string('symbol')->unique();
            $table->string('name');
            $table->string('image')->nullable();
            $table->decimal('current_price', 15, 2);
            $table->bigInteger('market_cap');
            $table->integer('market_cap_rank');
            $table->bigInteger('total_volume');
            $table->decimal('high_24h', 15, 2);
            $table->decimal('low_24h', 15, 2);
            $table->decimal('price_change_24h', 15, 5);
            $table->decimal('price_change_percentage_24h', 15, 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coins');
    }
};
