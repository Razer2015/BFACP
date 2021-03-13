<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BranchFix extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (! Schema::hasTable('bfacp_password_resets')) {
            // Creates the password resets table
			Schema::create('bfacp_password_resets', function (Blueprint $table) {
				$table->string('email')->index();
				$table->string('token')->index();
				$table->timestamp('created_at');
			});
        }
        
		if (! Schema::hasTable('bfacp_user_role')) {
            // Creates the assigned_roles (Many-to-Many relation) table
			Schema::create('bfacp_user_role', function ($table) {
				$table->engine = 'InnoDB';
				$table->integer('user_id')->unsigned();
				$table->integer('role_id')->unsigned();
				$table->foreign('user_id')->references('id')->on('bfacp_users')->onUpdate('cascade')->onDelete('cascade');
				$table->foreign('role_id')->references('id')->on('bfacp_roles')->onUpdate('cascade');
				$table->primary(['user_id', 'role_id']);
			});
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bfacp_user_role', function (Blueprint $table) {
            $table->dropForeign('bfacp_user_role_user_id_foreign');
            $table->dropForeign('bfacp_user_role_role_id_foreign');
        });

        Schema::dropIfExists('bfacp_password_resets');
    }
}
