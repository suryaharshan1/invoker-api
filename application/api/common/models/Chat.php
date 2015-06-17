<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property integer $id
 * @property string $message
 * @property integer $from
 * @property integer $to
 * @property string $sent_time
 *
 * @property Users $from0
 * @property Users $to0
 */
class Chat extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'from', 'to'], 'required'],
            [['message'], 'string'],
            [['from', 'to'], 'integer'],
            [['sent_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'from' => 'From',
            'to' => 'To',
            'sent_time' => 'Sent Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom0()
    {
        return $this->hasOne(Users::className(), ['id' => 'from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTo0()
    {
        return $this->hasOne(Users::className(), ['id' => 'to']);
    }
}

class ChatQuery extends \api\components\db\ActiveQuery
{
}