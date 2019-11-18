<?php

use yii\db\Migration;

/**
 * Class m191118_150127_change_presensi_masuk_telat_masuk_to_integer
 */
class m191118_150127_change_presensi_masuk_telat_masuk_to_integer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->alterColumn('{{%presensi_masuk}}', 'telat_masuk', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%presensi_masuk}}', 'telat_masuk', $this->time());

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191118_150127_change_presensi_masuk_telat_masuk_to_integer cannot be reverted.\n";

        return false;
    }
    */
}
