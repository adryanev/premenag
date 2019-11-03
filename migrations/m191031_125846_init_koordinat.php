<?php

use yii\db\Migration;

/**
 * Class m191031_125846_init_koordinat
 */
class m191031_125846_init_koordinat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%koordinat}}', ['a_lat' => 0.474219, 'a_lng' => 101.360121, 'b_lat' => 0.472438, 'b_lng' => 101.358919]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%koordinat}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191031_125846_init_koordinat cannot be reverted.\n";

        return false;
    }
    */
}
