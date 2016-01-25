<?php

use yii\db\Schema;
use yii\db\Migration;

class m160124_135001_chat extends Migration
{
	private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

	public function up()
	{
		// ��� �������� ���������� ��� ��������� ����
		$this->createTable( '{{%chat}}', [
			'id'     => Schema::TYPE_PK,
			'title'  => Schema::TYPE_STRING . '(64) NOT NULL',
			'status' => Schema::TYPE_INTEGER . '(5) NOT NULL',
		], $this->tableOptions );

		// ��� �������� ���������� ��� ��������� �� ���� ����� �� �����
		$this->createTable( '{{%chat_message}}', [
			'id'         => Schema::TYPE_PK,
			'chat_id'    => Schema::TYPE_INTEGER . '(10) NOT NULL',
			'user_id'    => Schema::TYPE_INTEGER . '(10) NOT NULL',
			'message'    => Schema::TYPE_STRING . '(255) NOT NULL',
			'created_at' => Schema::TYPE_INTEGER . '(10) NOT NULL',
		], $this->tableOptions );
		$this->addForeignKey(
			'FK_chat_message_chat', '{{%chat_message}}', 'chat_id', '{{%chat}}', 'id'
		);
		$this->addForeignKey(
			'FK_chat_message_user', '{{%chat_message}}', 'user_id', '{{%user}}', 'id'
		);

	}

	public function down()
	{
		$this->dropForeignKey( 'FK_chat_message_chat', 'chat_message' );
		$this->dropForeignKey( 'FK_chat_message_user', 'chat_message' );
		$this->dropTable( '{{%chat_message}}' );
		$this->dropTable( '{{%chat}}' );
	}
}
