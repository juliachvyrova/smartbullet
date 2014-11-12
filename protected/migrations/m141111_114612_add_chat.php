<?php

class m141111_114612_add_chat extends CDbMigration
{
	public function up()
	{
            $this->createTable('chatmsg', array(
            'id' => 'pk',
            'text' => 'text',
            'author_id' => 'int(11) not null',
            'game_id' => 'int(11) not null',
            ));
            
            $this->createTable('game', array(
            'id' => 'pk', 
            'game_status' => 'int(2) not null',
            ));
            
	}

	public function down()
	{
            $this->dropTable('chatmsg');
             $this->dropTable('game');
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