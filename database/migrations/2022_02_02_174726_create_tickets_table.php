<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('influencer_id');
            $table->unsignedBigInteger('service_id');
            $table->string('status')->nullable();
            $table->string('price')->nullable();
            $table->string('payment_method')->nullable();

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreign('influencer_id')->references('id')->on('influencers')
            ->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')
            ->onDelete('cascade');
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
        Schema::dropIfExists('tickets');
    }
}
