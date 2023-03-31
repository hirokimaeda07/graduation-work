<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreatePlanCharmsTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("plan_charms", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('project_id')->unsigned();
						$table->string('plan_charm_title',100)->nullable();
						$table->text('plan_charm_body')->nullable();
						$table->timestamps();
						$table->foreign("project_id")->references("id")->on("projects");



						// ----------------------------------------------------
						// -- SELECT [plan_charms]--
						// ----------------------------------------------------
						// $query = DB::table("plan_charms")
						// ->leftJoin("projects","projects.id", "=", "plan_charms.project_id")
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
                    Schema::dropIfExists("plan_charms");
                }
            }
        