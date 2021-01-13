<?php

use yii\db\Migration;

/**
 * Class m210113_140808_initial_schema
 */
class m210113_140808_initial_schema extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%app_log_model_behavior}}', [
            'id'                => $this->primaryKey(),
            'change_attributes' => $this->text(),
            'user'              => $this->integer(),
            'event'             => $this->string(30),
            'object'            => $this->string(30),
            'created_at'        => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210113_140808_initial_schema cannot be reverted.\n";
        return false;
    }

    /*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
echo "m210113_140808_create_app_log_model_behavior cannot be reverted.\n";

return false;
}
 */
}