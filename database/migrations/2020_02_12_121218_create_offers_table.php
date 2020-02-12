<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo')->nullable();
            $table->string('company_name')->nullable();
            $table->bigInteger('offer_type_id')->unsigned();
            $table->bigInteger('pricing_package_id')->unsigned();
            $table->float('offer_amount',10,2);
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
            $table->foreign('offer_type_id')->references('id')->on('offer_types');
            $table->foreign('pricing_package_id')->references('id')->on('pricing_packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
