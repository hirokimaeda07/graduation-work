<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateTimeSchedulesTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("time_schedules", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('project_id')->unsigned();
						$table->time('time_schedule_time')->nullable();
						$table->string('time_schedule_title',250)->nullable();
						$table->text('time_schedule_body')->nullable();
						$table->timestamps();
						$table->foreign("project_id")->references("id")->on("projects");



						// ----------------------------------------------------
						// -- SELECT [time_schedules]--
						// ----------------------------------------------------
						// $query = DB::table("time_schedules")
						// ->leftJoin("projects","projects.id", "=", "time_schedules.project_id")
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
                    Schema::dropIfExists("time_schedules");
                }
            }
        