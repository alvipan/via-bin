<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();

            $table->string('withdrawal_no')->unique();

            $table->foreignId('member_id')->constrained()->cascadeOnDelete();

            $table->string('status')->default('draft');

            $table->timestamp('posted_at')->nullable();

            $table->foreignId('posted_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->decimal('amount', 18, 2);

            $table->text('notes')->nullable();

            $table->foreignId('member_ledger_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['tenant_id', 'member_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};