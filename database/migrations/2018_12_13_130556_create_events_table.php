<?php use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /** * Run the migrations. * * @return void */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->json('EventPhoto')->nullable();
            $table->json('video')->nullable();
            $table->longText('description');
            $table->timestamps();
        });
    }

    /** * Reverse the migrations. * * @return void */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}