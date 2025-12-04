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
        Schema::create('book_imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('import_date');
            $table->integer('total_quantity');
            $table->decimal('total_cost', 12, 2);
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('imported_by')->nullable();
            $table->timestamps();

            $table->foreign('imported_by')->references('id')->on('users')->onDelete('set null');
            $table->index('import_date');
            $table->index('imported_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_imports');
    }
};

