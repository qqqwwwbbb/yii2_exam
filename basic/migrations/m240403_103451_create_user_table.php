<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m240403_103451_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(32)->notNull(),
            'lastname' => $this->string(32)->notNull(),
            'username' => $this->string(25)->unique()->notNull(),
            'password' => $this->string(32)->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string(12)->notNull(),
            'role' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
