<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%golongan}}`.
 */
class m191007_073007_create_golongan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%golongan}}', [
            'id' => $this->primaryKey(),
            'nama'=>$this->string(),
            'tunjangan'=>$this->bigInteger(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%golongan}}');
    }
}
