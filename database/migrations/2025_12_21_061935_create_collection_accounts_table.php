<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_accounts', function (Blueprint $table) {
             $table->id();

            $table->string('owner_number');
            $table->string('collection_method');
            $table->string('account_number');
            $table->string('account_name');
            $table->string('collection_day'); 
            $table->text('collection_notes')->nullable();
            $table->timestamps();

               /**
             * ===========================
             * INDEXES
             * ===========================
             */

            // Fast lookup by owner
            $table->index('owner_number');
            $table->index('collection_method');
            $table->index('account_number');
            $table->index('account_name');

            // Common query patterns
            $table->index(['owner_number', 'account_number']);
            $table->index(['owner_number', 'account_name']);

            // Sorting & recent activity
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_accounts');
    }
};
