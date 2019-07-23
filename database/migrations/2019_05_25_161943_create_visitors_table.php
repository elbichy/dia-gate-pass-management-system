<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('fullname')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();            
            $table->integer('status')->default(0);            
            $table->integer('processedBy')->default(0);            
            $table->softDeletes();
            $table->timestamp('verifiedAtGate')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->timestamp('verifiedAtReception')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
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
        Schema::dropIfExists('visitors');
    }
}
