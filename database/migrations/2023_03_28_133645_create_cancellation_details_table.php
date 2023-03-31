<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateCancellationDetailsTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("cancellation_details", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('project_id')->unsigned();
						$table->string('setting_cancellation_date',10)->nullable();
						$table->integer('setting_cancellation_rate')->nullable();
						$table->text('setting_cancellation_note')->nullable();
						$table->text('reason_for_cancellation')->nullable();
						$table->timestamps();
						$table->foreign("project_id")->references("id")->on("projects");



						// ----------------------------------------------------
						// -- SELECT [cancellation_details]--
						// ----------------------------------------------------
						// $query = DB::table("cancellation_details")
						// ->leftJoin("projects","projects.id", "=", "cancellation_details.project_id")
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
                    Schema::dropIfExists("cancellation_details");
                }
            }
        