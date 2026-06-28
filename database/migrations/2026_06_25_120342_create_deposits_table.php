<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
        $table->id();

        $table->foreignId('tenant_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('member_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('deposit_no');

        $table->timestamp('posted_at')->nullable();

        $table->string('status')->default('draft');

        $table->text('notes')->nullable();

        $table->unsignedBigInteger('created_by');

        $table->timestamps();

        $table->unique(['tenant_id', 'deposit_no']);
        $table->index(['tenant_id', 'member_id']);
        $table->index(['tenant_id', 'status']);
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};