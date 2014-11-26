<?php

class m141126_110937_add_invite extends CDbMigration
{
	public function up()
	{
            $this->execute("create table invite(id integer(11) NOT NULL AUTO_INCREMENT, user1 integer(11), user2 integer(11), game integer(11),PRIMARY KEY (id), FOREIGN KEY (user2) REFERENCES user(id), FOREIGN KEY (user1) REFERENCES user(id), FOREIGN KEY (game) REFERENCES game(id))");
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