<?php

use yii\db\Migration;

/**
 * Class m191010_041037_seed_golongan_table
 */
class m191010_041037_seed_golongan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $golongan = [
            ['II/a', '2199000'],
            ['II/b', '2399000'],
            ['II/c', '2616000'],
            ['II/d', '2927000'],
            ['III/a','3348000'],
            ['III/b','3952000'],
            ['III/c','4519000'],
            ['III/d','6045000'],
            ['IV/a', '7293000'],
            ['IV/b', '9600000'],
        ];

        $this->batchInsert('golongan',['nama','tunjangan'],$golongan);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->truncateTable('golongan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191010_041037_seed_golongan_table cannot be reverted.\n";

        return false;
    }
    */
}
