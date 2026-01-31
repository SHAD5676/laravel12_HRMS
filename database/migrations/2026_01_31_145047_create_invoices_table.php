<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id'); // Foreign key type thik kora hoyeche
        $table->string('invoice_no');
        $table->decimal('amount', 10, 2);
        $table->string('status')->default('pending');
        $table->timestamps();

        // Relation setup
        $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
