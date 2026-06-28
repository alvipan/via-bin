<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('member_code')->index();

            $table->string('name');
            $table->string('phone', 30)->nullable();

            $table->text('address')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique(['tenant_id', 'member_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};