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
        Schema::create('book_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('sale_date');
            $table->decimal('total_amount', 12, 2);
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('sold_by')->nullable();
            $table->timestamps();

            $table->foreign('sold_by')->references('id')->on('users')->onDelete('set null');
            $table->index('sale_date');
            $table->index('sold_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_sales');
    }
};

