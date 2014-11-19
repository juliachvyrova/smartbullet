<?php

class m141119_132253_add_game_map extends CDbMigration
{
	public function up()
	{
            $this->createTable('game_map', array(
            'id' => 'pk',
            'game_id' => 'int(11) DEFAULT NULL',
            'user_count' => 'int(11) DEFAULT NULL',
            'user1' => 'int(11) not null',
            'user2' => 'int(11) not null',
            'user3' => 'int(11) not null',
            'user4' => 'int(11) not null',
            'user5' => 'int(11) not null',
            'user6' => 'int(11) not null',
            ));
	}

	public function down()
	{
		$this->dropTable('game_map');
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