<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%presensi_keluar}}`.
 */
class m191019_113723_create_presensi_keluar_table extends Migration
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
        $this->createTable('{{%presensi_keluar}}', [
            'id' => $this->primaryKey(),
            'id_presensi'=>$this->integer(),
            'id_pegawai'=>$this->integer(),
            'jam_pulang'=>$this->time(),
            'status'=>$this->boolean(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->addForeignKey('fk-presensi_keluar-presensi','{{%presensi_keluar}}','id_presensi','{{%presensi}}','id','cascade','cascade');
        $this->addForeignKey('fk-presensi_keluar-pegawai','{{%presensi_keluar}}','id_pegawai','{{%pegawai}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-presensi_keluar-pegawai','{{%presensi_keluar}}');
        $this->dropForeignKey('fk-presensi_keluar-presensi','{{%presensi_keluar}}');
        $this->dropTable('{{%presensi_keluar}}');
    }
}
