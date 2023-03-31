<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateAddressesTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("addresses", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('user_id')->nullable()->unsigned();
						$table->bigInteger('company_id')->nullable()->unsigned();
						$table->integer('postcode')->nullable();
						$table->string('prefecture',10)->nullable();
						$table->string('municipalitie',50)->nullable();
						$table->string('house_number',50)->nullable();
						$table->string('apartment',50)->nullable();
						$table->timestamps();
						$table->softDeletes();
						$table->foreign("user_id")->references("id")->on("users");
						$table->foreign("company_id")->references("id")->on("companies");



						// ----------------------------------------------------
						// -- SELECT [addresses]--
						// ----------------------------------------------------
						// $query = DB::table("addresses")
						// ->leftJoin("users","users.id", "=", "addresses.user_id")
						// ->leftJoin("companies","companies.id", "=", "addresses.company_id")
						// ->get();
						// dd($query); //For checking



                    });
                }
    
                /**
                 * Reverse the migrations.
                 *
                 * @return void
                 */
                public function down()
                {
                    Schema::dropIfExists("addresses");
                }
            }
        