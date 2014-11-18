<?php

class m141113_091200_add_game_log extends CDbMigration
{
	public function up()
	{
            $this->createTable('log_game', array(
            'id' => 'pk',
            'user_id' => 'int(11) not null',
            'game_id' => 'int(11) not null',
            'action' => 'int',
            'direction' => 'int',
            'tern' => 'int'
            ));
	}

	public function down()
	{
		$this->dropTable('log_game');
	}
}