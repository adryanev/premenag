<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pegawai}}`.
 */
class m191007_073142_create_pegawai_table extends Migration
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
        $this->createTable('{{%pegawai}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'id_golongan' => $this->integer(),
            'nip' => $this->string(),
            'nama' => $this->string(),
            'jabatan' => $this->string(),
            'avatar'=>$this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->addForeignKey('fk-pegawai-user', '{{%pegawai}}', 'id_user', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-pegawai-gologan', '{{%pegawai}}', 'id_golongan', '{{%golongan}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pegawai}}');
    }
}
