<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateCompaniesTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("companies", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('user_id')->unsigned();
						$table->string('company_name',100);
						$table->string('company_name_kana',100);
						$table->string('shop_name',100);
						$table->integer('company_phone_number')->nullable();
						$table->string('company_email')->nullable();
						$table->string('business_hour',200)->nullable();
						$table->string('regular_holiday',200)->nullable();
						$table->text('company_profile')->nullable();
						$table->integer('employees_number')->nullable();
						$table->integer('instructor_number')->nullable();
						$table->text('selling_point')->nullable();
						$table->timestamps();
						$table->softDeletes();
						$table->foreign("user_id")->references("id")->on("users");



						// ----------------------------------------------------
						// -- SELECT [companies]--
						// ----------------------------------------------------
						// $query = DB::table("companies")
						// ->leftJoin("users","users.id", "=", "companies.user_id")
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
                    Schema::dropIfExists("companies");
                }
            }
        