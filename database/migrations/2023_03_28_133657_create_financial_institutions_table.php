<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateFinancialInstitutionsTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("financial_institutions", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('user_id')->unsigned();
						$table->bigInteger('company_id')->nullable()->unsigned();
						$table->string('financial_institution_name',30)->nullable();
						$table->string('financial_institution_branch_name',30)->nullable();
						$table->string('account_type',10)->nullable();
						$table->integer('account_number')->nullable();
						$table->string('account_holder',30)->nullable();
						$table->string('yucho_store_name',30)->nullable();
						$table->timestamps();
						$table->foreign("user_id")->references("id")->on("users");
						$table->foreign("company_id")->references("id")->on("companies");



						// ----------------------------------------------------
						// -- SELECT [financial_institutions]--
						// ----------------------------------------------------
						// $query = DB::table("financial_institutions")
						// ->leftJoin("users","users.id", "=", "financial_institutions.user_id")
						// ->leftJoin("companies","companies.id", "=", "financial_institutions.company_id")
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
                    Schema::dropIfExists("financial_institutions");
                }
            }
        