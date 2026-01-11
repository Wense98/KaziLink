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
        Schema::table('job_requests', function (Blueprint $table) {
            $table->decimal('agreed_price', 15, 2)->nullable();
            $table->decimal('commission_fee', 15, 2)->default(0);
            $table->string('payment_status')->default('pending'); // pending, in_escrow, released, refunded
            $table->string('work_status')->default('pending'); // pending, in_progress, completed, disputed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_requests', function (Blueprint $table) {
            $table->dropColumn(['agreed_price', 'commission_fee', 'payment_status', 'work_status']);
        });
    }
};
