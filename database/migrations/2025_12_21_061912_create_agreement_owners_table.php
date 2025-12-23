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
        Schema::create('agreement_owners', function (Blueprint $table) {
           $table->id();

            // Relationship
            $table->string('owner_number');

            $table->string('agreement_number');
            $table->string('agreement_type');

            $table->decimal('profit_percentage', 5, 2);
            $table->string('payment_mode');
            $table->decimal('penalty_percentage', 5, 2)->default(0);

            $table->string('status')->default('ACTIVE');

            $table->text('agreements_notes')->nullable();

            $table->timestamps();

               /**
             * ===========================
             * INDEXES
             * ===========================
             */

            // Fast lookup by owner
            $table->index('owner_number');
            $table->index('agreement_number');
            $table->index('agreement_type');
            $table->index('payment_mode');
            $table->index('status');

            // Common query patterns
            $table->index(['owner_number', 'status']);
            $table->index(['owner_number', 'agreement_number']);
            $table->index(['owner_number', 'agreement_type']);

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
        Schema::dropIfExists('agreement_owners');
    }
};
