<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfluencersTable extends Migration
{
    /**x
     * Run the migrations.
     *
     * @return voidd
     */
    public function up()
    {
        Schema::create('influencers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('picture');
            $table->longText('country');
            $table->json('categories')->nullable();
            $table->string('interesting');
            $table->longText('reach')->nullable();
            $table->json('photos')->nullable();
            $table->integer('age');
            $table->integer('followers')->nullable();
            $table->integer('phone_number')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('influencers');
    }
}
