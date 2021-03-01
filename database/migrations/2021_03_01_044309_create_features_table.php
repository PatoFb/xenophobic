<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id('ID');
            $table->text('Text');
            $table->string('Class');
            $table->string('score_tag')->nullable(true);
            $table->string('agreement')->nullable(true);
            $table->string('subjectivity')->nullable(true);
            $table->string('confidence')->nullable(true);
            $table->string('irony')->nullable(true);
            $table->string('Angry')->nullable(true);
            $table->string('Sad')->nullable(true);
            $table->string('Excited')->nullable(true);
            $table->string('Bored')->nullable(true);
            $table->string('Happy')->nullable(true);
            $table->string('Fear')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('features');
    }
}
