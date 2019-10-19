<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%presensi_masuk}}`.
 */
class m191018_083843_create_presensi_masuk_table extends Migration
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
        $this->createTable('{{%presensi_masuk}}', [
            'id' => $this->primaryKey(),
            'id_presensi'=>$this->integer(),
            'id_pegawai'=>$this->integer(),
            'jam_masuk'=>$this->time(),
            'telat_masuk'=>$this->time(),
            'status'=>$this->boolean(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-presensi_masuk-presensi','{{%presensi_masuk}}','id_presensi','{{%presensi}}','id','cascade','cascade');
        $this->addForeignKey('fk-presensi_masuk-pegawai','{{%presensi_masuk}}','id_pegawai','{{%pegawai}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-presensi_masuk-pegawai','{{%presensi_masuk}}');
        $this->dropForeignKey('fk-presensi_masuk-presensi','{{%presensi_masuk}}');
        $this->dropTable('{{%presensi_masuk}}');
    }
}
