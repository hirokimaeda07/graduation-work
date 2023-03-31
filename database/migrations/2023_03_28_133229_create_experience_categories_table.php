<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateExperienceCategoriesTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("experience_categories", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->string('big_category')->nullable();
						$table->string('small_category')->nullable();
						$table->timestamps();



						// ----------------------------------------------------
						// -- SELECT [experience_categories]--
						// ----------------------------------------------------
						// $query = DB::table("experience_categories")
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
                    Schema::dropIfExists("experience_categories");
                }
            }
        