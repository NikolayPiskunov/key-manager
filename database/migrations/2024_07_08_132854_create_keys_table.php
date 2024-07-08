<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('key')->unique();
            $table->foreignUuid('app_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignUuid('tariff_id')
                ->constrained()
                ->onDelete('cascade');

            $table->timestamp('expire_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keys');
    }
};
