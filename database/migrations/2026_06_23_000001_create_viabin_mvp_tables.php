<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('status')->default('active')->index();
            $table->timestamps();
        });

        Schema::create('tenant_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('role')->default('cashier');
            $table->string('status')->default('active')->index();
            $table->timestamps();

            $table->unique(['tenant_id', 'user_id']);
            $table->index(['tenant_id', 'role']);
        });

        Schema::create('member_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('member_number');
            $table->text('address')->nullable();
            $table->string('status')->default('active')->index();
            $table->timestamps();

            $table->unique(['tenant_id', 'member_number']);
            $table->index(['tenant_id', 'user_id']);
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('symbol')->unique();
            $table->timestamps();
        });

        Schema::create('waste_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained();
            $table->string('name');
            $table->string('code');
            $table->decimal('default_price', 15, 2)->default(0);
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();

            $table->unique(['tenant_id', 'code']);
            $table->index(['tenant_id', 'unit_id']);
        });

        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('member_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('waste_category_id')->constrained();
            $table->foreignId('created_by')->constrained('users');
            $table->string('reference_number');
            $table->decimal('quantity', 15, 3);
            $table->decimal('unit_price', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamp('deposited_at');
            $table->timestamps();

            $table->unique(['tenant_id', 'reference_number']);
            $table->index(['tenant_id', 'member_profile_id', 'deposited_at']);
        });

        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('deposit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('member_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('waste_category_id')->constrained();
            $table->string('lot_number');
            $table->decimal('initial_quantity', 15, 3);
            $table->decimal('remaining_quantity', 15, 3);
            $table->string('status')->default('available')->index();
            $table->timestamps();

            $table->unique(['tenant_id', 'lot_number']);
            $table->index(['tenant_id', 'waste_category_id', 'status']);
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users');
            $table->string('reference_number');
            $table->string('buyer_name');
            $table->string('buyer_type')->nullable();
            $table->decimal('quantity', 15, 3);
            $table->decimal('unit_price', 15, 2);
            $table->decimal('gross_amount', 15, 2);
            $table->timestamp('sold_at');
            $table->timestamps();

            $table->unique(['tenant_id', 'reference_number']);
            $table->index(['tenant_id', 'sold_at']);
        });

        Schema::create('sale_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lot_id')->constrained();
            $table->foreignId('member_profile_id')->constrained()->cascadeOnDelete();
            $table->decimal('quantity', 15, 3);
            $table->decimal('gross_amount', 15, 2);
            $table->decimal('fee_amount', 15, 2)->default(0);
            $table->decimal('net_amount', 15, 2);
            $table->timestamps();

            $table->index(['tenant_id', 'sale_id']);
            $table->index(['tenant_id', 'member_profile_id']);
        });

        Schema::create('member_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('member_profile_id')->constrained()->cascadeOnDelete();
            $table->string('transaction_type');
            $table->string('reference_type');
            $table->unsignedBigInteger('reference_id');
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_after', 15, 2);
            $table->timestamps();

            $table->index(['tenant_id', 'member_profile_id', 'created_at']);
            $table->index(['tenant_id', 'reference_type', 'reference_id']);
        });

        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('member_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('reference_number');
            $table->decimal('amount', 15, 2);
            $table->string('status')->default('pending')->index();
            $table->timestamps();

            $table->unique(['tenant_id', 'reference_number']);
            $table->index(['tenant_id', 'member_profile_id']);
        });

        Schema::create('operational_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users');
            $table->string('transaction_type');
            $table->decimal('amount', 15, 2);
            $table->date('transaction_date');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['tenant_id', 'transaction_date']);
            $table->index(['tenant_id', 'transaction_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operational_transactions');
        Schema::dropIfExists('withdrawals');
        Schema::dropIfExists('member_ledgers');
        Schema::dropIfExists('sale_allocations');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('lots');
        Schema::dropIfExists('deposits');
        Schema::dropIfExists('waste_categories');
        Schema::dropIfExists('units');
        Schema::dropIfExists('member_profiles');
        Schema::dropIfExists('tenant_users');
        Schema::dropIfExists('tenants');
    }
};
