<?php

use yii\db\Schema;
use yii\db\Migration;

class m150721_135424_books extends Migration
{
    private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    public function safeUp()
    {
        $this->createTable( '{{%authors}}', [
            'id'         => Schema::TYPE_PK,
            'first_name' => Schema::TYPE_STRING,
            'last_name'  => Schema::TYPE_STRING,
        ], $this->tableOptions );

        $this->createTable( '{{%books}}', [
            'id'          => Schema::TYPE_PK,
            'name'        => Schema::TYPE_STRING,
            'date_create' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_update' => Schema::TYPE_INTEGER . ' NOT NULL',
            'preview'     => Schema::TYPE_STRING . '(255)',
            'date'        => Schema::TYPE_INTEGER . ' NOT NULL',
            'author_id'   => Schema::TYPE_INTEGER . '(25) NOT NULL',
        ], $this->tableOptions );

        $this->createIndex('FK_books_name', '{{%books}}', 'name');
        $this->createIndex('FK_books_author_id', '{{%books}}', 'author_id');
        $this->createIndex('FK_author_id', '{{%authors}}', 'id');
        $this->addForeignKey(
            'FK_books_author', '{{%books}}', 'author_id', '{{%authors}}', 'id'
        );
        $this->insert('{{%authors}}', [
            'first_name' => 'Айзек',
            'last_name' => 'Азимов'
        ]);
        $this->insert('{{%authors}}', [
            'first_name' => 'Дин',
            'last_name' => 'Кунц'
        ]);
        $this->insert('{{%authors}}', [
            'first_name' => 'Стивен',
            'last_name' => 'Кинг'
        ]);
        $this->insert('{{%authors}}', [
            'first_name' => 'Курт',
            'last_name' => 'Воннегут'
        ]);
        $this->insert('{{%authors}}', [
            'first_name' => 'Пол',
            'last_name' => 'Андерсон'
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_books_author', 'books');
        $this->dropTable( '{{%authors}}' );
        $this->dropTable( '{{%books}}' );
    }
}
