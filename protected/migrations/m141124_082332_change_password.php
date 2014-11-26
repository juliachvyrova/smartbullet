<?php

class m141124_082332_change_password extends CDbMigration
{
	public function up()
	{
            $this->alterColumn('user','password','varchar(50)');
       
	}

	public function down()
	{

	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}