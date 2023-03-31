<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateApplicationConfirmationListsTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("application_confirmation_lists", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('project_id')->unsigned();
						$table->string('application_confirmation list_confirm')->nullable();
						$table->text('application_confirmation list_note')->nullable();
						$table->timestamps();
						$table->foreign("project_id")->references("id")->on("projects");



						// ----------------------------------------------------
						// -- SELECT [application_confirmation_lists]--
						// ----------------------------------------------------
						// $query = DB::table("application_confirmation_lists")
						// ->leftJoin("projects","projects.id", "=", "application_confirmation_lists.project_id")
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
                    Schema::dropIfExists("application_confirmation_lists");
                }
            }
        