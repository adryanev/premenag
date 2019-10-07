<?php

use yii\db\Migration;

/**
 * Class m191007_074030_init_superadmin
 */
class m191007_074030_init_superadmin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert('{{%user}}',[
            'username'=>'root',
            'password_hash'=>Yii::$app->security->generatePasswordHash('12345678'),
            'email'=>'root@premenag.test',
            'auth_key'=>Yii::$app->security->generateRandomString(32),
            'status'=>1,
            'group'=>'superadmin',
            'created_at'=>\Carbon\Carbon::now()->timestamp,
            'updated_at'=>\Carbon\Carbon::now()->timestamp

        ]);
        $this->insert('{{%golongan}}',[
            'nama'=>'SuperAdmin',
            'tunjangan'=>999999999
        ]);
        $this->insert('{{%pegawai}}',[
            'id_user'=>1,
            'id_golongan'=>1,
            'nama'=>'Super Admin',
            'nip'=>'000000000001',
            'jabatan'=>'Super Administrator'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->truncateTable('pegawai');
       $this->truncateTable('golongan');
       $this->truncateTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191007_074030_init_superadmin cannot be reverted.\n";

        return false;
    }
    */
}
