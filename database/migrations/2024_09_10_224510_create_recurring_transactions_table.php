<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurringTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('recurring_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['expense', 'income']);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('description')->nullable();
            $table->date('start_date');
            $table->enum('frequency', ['daily', 'weekly', 'monthly', 'yearly']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recurring_transactions');
    }
}
