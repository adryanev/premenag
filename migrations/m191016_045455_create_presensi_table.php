<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%presensi}}`.
 */
class m191016_045455_create_presensi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%presensi}}', [
            'id' => $this->primaryKey(),
            'tanggal' => $this->date(),
            'is_buka'=>$this->boolean(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%presensi}}');
    }
}
