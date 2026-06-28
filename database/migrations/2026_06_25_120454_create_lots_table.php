<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')->constrained();

            $table->foreignId('member_id')->constrained();

            $table->string('lot_no');

            $table->foreignId('deposit_item_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('quantity_received', 12, 3);

            $table->decimal('quantity_remaining', 12, 3);

            $table->string('status')->default('available');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};