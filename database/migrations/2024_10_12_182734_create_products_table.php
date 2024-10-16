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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->unique();
            $table->string('category', 250);
            $table->bigInteger('batch_number')->unsigned()->unique();
            $table->unsignedBigInteger('research_status_id')->nullable();
            $table->foreign('research_status_id')
                ->references('id')
                ->on('research_statuses')
                ->onDelete('set null');
            $table->date('manufacturing_date');
            $table->date('expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
