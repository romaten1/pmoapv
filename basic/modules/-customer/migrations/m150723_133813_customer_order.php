<?php

use yii\db\Schema;
use yii\db\Migration;

class m150723_133813_customer_order extends Migration
{
    private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    public function up()
    {
        $this->createTable( '{{%customer}}', [
            'id'      => Schema::TYPE_PK,
            'name'    => Schema::TYPE_STRING . '(32) NOT NULL',
            'phone'   => Schema::TYPE_STRING . '(32) NOT NULL',
            'address' => Schema::TYPE_STRING . '(255) NOT NULL'
        ], $this->tableOptions );

        $this->createTable( '{{%customer_order}}', [
            'id'          => Schema::TYPE_PK,
            'customer_id' => Schema::TYPE_INTEGER . '(5) NOT NULL',
            'posted_at'   => Schema::TYPE_INTEGER . '(10) NOT NULL',
            'amount'      => Schema::TYPE_INTEGER . '(10) NOT NULL',
            'paid_at'     => Schema::TYPE_INTEGER . '(10) NOT NULL',
        ], $this->tableOptions );

        $this->createIndex('FK_customer_name', '{{%customer}}', 'name');
        $this->createIndex('FK_custorder_customer_id', '{{%customer_order}}', 'customer_id');
        $this->addForeignKey(
            'FK_customer_order_id', '{{%customer_order}}', 'customer_id', '{{%customer}}', 'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('FK_customer_order_id', 'customer_order');
        $this->dropTable( '{{%customer}}' );
        $this->dropTable( '{{%customer_order}}' );
    }

}
