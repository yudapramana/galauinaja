<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration {

	public function up()
	{
		Schema::create('employees', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('nip', 18)->unique();
			$table->string('full_name', 100);
			$table->date('date_of_birth')->nullable();
			$table->enum('gender', array('M', 'F'))->nullable();
			$table->string('phone_number', 15)->nullable();
			$table->string('email', 100)->unique()->nullable();
			$table->string('job_title', 255);
			$table->integer('id_work_unit')->unsigned();
			$table->enum('employment_status', array('PNS', 'PPPK'));
			$table->date('tmt_pangkat')->nullable();
			$table->date('tmt_jabatan')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('employees');
	}
}