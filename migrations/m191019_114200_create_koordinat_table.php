<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%koordinat}}`.
 */
class m191019_114200_create_koordinat_table extends Migration
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

        $this->createTable('{{%koordinat}}', [
            'id' => $this->primaryKey(),
            'a_lat'=>$this->float(),
            'a_lng'=>$this->float(),
            'b_lat'=>$this->float(),
            'b_lng'=>$this->float(),
            'c_lat'=>$this->float(),
            'c_lng'=>$this->float(),
            'd_lat'=>$this->float(),
            'd_lng'=>$this->float(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%koordinat}}');
    }
}
