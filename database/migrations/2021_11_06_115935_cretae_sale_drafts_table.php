<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CretaeSaleDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_drafts', function (Blueprint $table) {
            $table->id();
            $table->integer('draft_id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->decimal('total',10,2)->default(0.00);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_drafts');
    }
}
