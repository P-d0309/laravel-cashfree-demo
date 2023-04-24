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
        Schema::create('cash_free_links', function (Blueprint $table) {
            $table->id();
			$table->text('link_purpose')->nullable();
			$table->double('link_amount', 2)->default(1);
			$table->double('link_amount_paid', 2)->default(1);
			$table->uuid('link_id')->nullable();
			$table->string('customer_phone')->nullable();
			$table->string('order_id')->nullable();
			$table->string('order_hash')->nullable();
			$table->string('order_amount')->nullable();
			$table->string('transaction_id')->nullable();
			$table->string('transaction_status')->nullable();
			$table->string('link_currency')->default('INR');
			$table->string('customer_email')->nullable();
			$table->string('customer_name')->nullable();
			$table->boolean('is_upi')->default(0);
			$table->boolean('send_sms')->default(0);
			$table->boolean('send_email')->default(0);
			$table->string('notify_url')->nullable();
			$table->string('return_url')->nullable();
			$table->string('link_url')->nullable();
			$table->string('link_status')->nullable();
			$table->string('cf_link_id')->nullable();
			$table->dateTime('link_expiry_time');
			$table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_free_links');
    }
};
