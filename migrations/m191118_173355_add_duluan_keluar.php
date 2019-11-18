<?php

use yii\db\Migration;

/**
 * Class m191118_173355_add_duluan_keluar
 */
class m191118_173355_add_duluan_keluar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%presensi_keluar}}', 'duluan_keluar', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%presensi_keluar}}', 'duluan_keluar');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191118_173355_add_duluan_keluar cannot be reverted.\n";

        return false;
    }
    */
}
