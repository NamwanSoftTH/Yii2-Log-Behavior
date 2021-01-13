<?php

namespace namwansoftth\log;

use \yii\db\ActiveRecord;

/**
 * This is the model class for table "log".
 */
class Log extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%app_log_model_behavior}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['change_attributes'], 'string'],
            [['user', 'created_at'], 'integer'],
            [['event', 'object'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'change_attributes' => 'Attributes',
            'user'              => 'User',
            'event'             => 'Event',
            'object'            => 'Object',
            'created_at'        => 'Object',
        ];
    }

}