<?php

use yii\db\Migration;

/**
 * Class m191031_125536_change_koordinat_table
 */
class m191031_125536_change_koordinat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%koordinat}}', 'c_lat');
        $this->dropColumn('{{%koordinat}}', 'c_lng');
        $this->dropColumn('{{%koordinat}}', 'd_lat');
        $this->dropColumn('{{%koordinat}}', 'd_lng');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%koordinat}}', 'c_lat', $this->float());
        $this->addColumn('{{%koordinat}}', 'c_lng', $this->float());
        $this->addColumn('{{%koordinat}}', 'd_lat', $this->float());
        $this->addColumn('{{%koordinat}}', 'd_lng', $this->float());

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191031_125536_change_koordinat_table cannot be reverted.\n";

        return false;
    }
    */
}
