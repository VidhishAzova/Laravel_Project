<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders',function(Blueprint $table)
        {
            $table->increments('oid');
            $table->unsignedInteger('uid');
            $table->unsignedInteger('pid');
            $table->foreign('uid')->references('uid')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pid')->references('pid')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('totalquantity');
            $table->bigInteger('totalprice');
            $table->timestamps();
        });
        // Schema::create('password_resets', function (Blueprint $table)
        // {
        //     $table->string('email')->index();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });

        // Schema::create('qualification',function(Blueprint $table)
        // {
        //     $table->increments('qid');
        //     $table->string('qname');
        //     $table->timestamps();
        // });

        // Schema::create('available_product_category',function(Blueprint $table)
        // {
        //     $table->increments('pcid');
        //     $table->string('productcategoryname');
        //     $table->timestamps();
        // });

        // Schema::create('user', function (Blueprint $table)
        // {
        //     $table->increments('uid');
        //     $table->string('first_name');
        //     $table->string('last_name');
        //     $table->string('gender');
        //     $table->bigInteger('number');
        //     $table->string('email');
        //     $table->string('states');
        //     $table->string('profilepic');
        //     $table->unsignedInteger('qualification')->nullable();
        //     $table->foreign('qualification')->references('qid')->on('qualification')->onUpdate('cascade')->onDelete('cascade');
        //     $table->string('password');
        //     $table->timestamps();
        //    // $table->string('api_token', 80)->unique()->nullable()->default(null);
        // });

        // Schema::create('regis_has_qualification',function(Blueprint $table)
        // {

        //     $table->unsignedInteger('uid');
        //     $table->unsignedInteger('qid');
        //     $table->foreign('uid')->references('uid')->on('user')->onUpdate('cascade')->onDelete('cascade');
        //     $table->foreign('qid')->references('qid')->on('qualification')->onUpdate('cascade')->onDelete('cascade');
        //     $table->timestamps();
        // });

        // Schema::create('products',function(Blueprint $table)
        // {
        //     $table->increments('pid');
        //     $table->string('productname');
        //     $table->string('productdescription');
        //     $table->unsignedInteger('productcategory')->nullable();
        //     $table->foreign('productcategory')->references('pcid')->on('available_product_category')->onUpdate('cascade')->onDelete('cascade');
        //     $table->string('productimage');
        //     $table->integer('productquantity');
        //     $table->float('productprice');
        //     $table->timestamps();
        // });

        // Schema::create('user_has_products',function(Blueprint $table)
        // {
        //     $table->unsignedInteger('uid');
        //     $table->unsignedInteger('pid');
        //     $table->foreign('uid')->references('uid')->on('user')->onUpdate('cascade')->onDelete('cascade');
        //     $table->foreign('pid')->references('pid')->on('products')->onUpdate('cascade')->onDelete('cascade');
        //     $table->integer('quantity');
        //     $table->float('totalprice');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
