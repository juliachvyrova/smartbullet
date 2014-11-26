<?php

class m141124_085223_utf8_convert extends CDbMigration
{
	public function up()
	{
            $this->execute('ALTER TABLE user CONVERT TO CHARACTER SET utf8');
            $this->execute('ALTER TABLE relationship CONVERT TO CHARACTER SET utf8');
            $this->execute('ALTER TABLE message CONVERT TO CHARACTER SET utf8');
            $this->execute('ALTER TABLE post CONVERT TO CHARACTER SET utf8');
            $this->execute('ALTER TABLE comment CONVERT TO CHARACTER SET utf8');
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