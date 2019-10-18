<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%presensi_detail}}`.
 */
class m191018_083843_create_presensi_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%presensi_detail}}', [
            'id' => $this->primaryKey(),
            'id_presensi'=>$this->integer(),
            'id_pegawai'=>$this->integer(),
            'jam_masuk'=>$this->time(),
            'jam_keluar'=>$this->time(),
            'telat_masuk'=>$this->time(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%presensi_detail}}');
    }
}
