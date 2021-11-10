<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refils', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('old_stock')->default(0);
            $table->integer('quantity')->default(0);
            $table->integer('total_stock')->default(0);
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
        Schema::dropIfExists('refils');
    }
}
