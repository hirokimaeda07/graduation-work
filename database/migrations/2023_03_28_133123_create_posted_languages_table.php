<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreatePostedLanguagesTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("posted_languages", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->string('posted_language')->nullable();
						$table->timestamps();
						$table->softDeletes();



						// ----------------------------------------------------
						// -- SELECT [posted_languages]--
						// ----------------------------------------------------
						// $query = DB::table("posted_languages")
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
                    Schema::dropIfExists("posted_languages");
                }
            }
        