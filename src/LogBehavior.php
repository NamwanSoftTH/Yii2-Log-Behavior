<?php

namespace namwansoftth\ModelLog;

use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\helpers\Json;

class LogBehavior extends Behavior
{

    public $excludedAttributes = [];

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT  => 'AddLog',
            ActiveRecord::EVENT_AFTER_UPDATE  => 'AddLog',
            ActiveRecord::EVENT_BEFORE_DELETE => 'DeleteLog',
        ];
    }

    /**
     * @param array $diff
     *
     * @return array
     */
    public function setChangelogLabels(array $diff)
    {
        return $diff;
    }

    /**
     * @param array $diff
     *
     * @return array
     */
    private function applyExclude(array $diff)
    {
        foreach ($this->excludedAttributes as $attr) {
            unset($diff[$attr]);
        }

        return $diff;
    }

    /**
     * @param \yii\base\Event $event
     */
    public function AddLog(Event $event)
    {
        $owner = $this->owner;
        $changedAttributes = $event->changedAttributes;

        $diff = [];

        foreach ($changedAttributes as $attrName => $attrVal) {
            $newAttrVal = $owner->getAttribute($attrName);

            if ($newAttrVal != $attrVal) {
                $diff[$attrName] = [$attrVal, $newAttrVal];
            }
        }
        $diff = $this->applyExclude($diff);

        if ($diff) {
            $modelL = $event->sender;

            $model = new Log();
            $model->change_attributes = Json::encode($diff);
            $model->event = $event->name;
            $model->object = $modelL::className();
            $model->user = Yii::$app->user->id ?? null;
            $model->created_at = time();
            $model->save();
        }
    }

    public function DeleteLog()
    {
        $logEvent = new Log();
        $logEvent->relatedObject = $this->owner;
        $logEvent->data = '';
        $logEvent->type = self::DELETED;
        $logEvent->save();
    }
}