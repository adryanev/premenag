<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%presensi_bolos}}`.
 */
class m191019_111732_create_presensi_bolos_table extends Migration
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
        $this->createTable('{{%presensi_bolos}}', [
            'id' => $this->primaryKey(),
            'id_presensi'=>$this->integer(),
            'id_pegawai'=>$this->integer(),
            'waktu'=>$this->time(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-presensi_bolos-presensi','{{%presensi_bolos}}','id_presensi','{{%presensi}}','id','cascade','cascade');
        $this->addForeignKey('fk-presensi_bolos-pegawai','{{%presensi_bolos}}','id_pegawai','{{%pegawai}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-presensi_bolos-pegawai','{{%presensi_bolos}}');
        $this->dropForeignKey('fk-presensi_bolos-presensi','{{%presensi_bolos}}');
        $this->dropTable('{{%presensi_bolos}}');
    }
}
