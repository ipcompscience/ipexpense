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
        Schema::table('expenses', function (Blueprint $table) {
            // Drop the old category column if it exists
            if (Schema::hasColumn('expenses', 'category')) {
                $table->dropColumn('category');
            }
            
            // Add a foreign key for category_id
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            // In the rollback, add the category column back if needed
            $table->string('category')->nullable();
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
    };
