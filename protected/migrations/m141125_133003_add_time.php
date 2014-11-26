<?php

class m141125_133003_add_time extends CDbMigration
{
	public function up()
	{
            $this->execute('alter table game_map add column time int(15)');
	}

	public function down()
	{
		echo "m141125_133003_add_time does not support migration down.\n";
		return false;
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