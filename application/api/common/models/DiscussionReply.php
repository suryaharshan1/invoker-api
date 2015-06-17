<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "discussion_reply".
 *
 * @property integer $id
 * @property integer $coursediscussion_id
 * @property string $reply
 * @property integer $user_id
 * @property string $create_time
 *
 * @property CourseDiscussion $coursediscussion
 * @property Users $user
 */
class DiscussionReply extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discussion_reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coursediscussion_id', 'reply', 'user_id'], 'required'],
            [['coursediscussion_id', 'user_id'], 'integer'],
            [['reply'], 'string'],
            [['create_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coursediscussion_id' => 'Coursediscussion ID',
            'reply' => 'Reply',
            'user_id' => 'User ID',
            'create_time' => 'Create Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursediscussion()
    {
        return $this->hasOne(CourseDiscussion::className(), ['id' => 'coursediscussion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}

class DiscussionReplyQuery extends \api\components\db\ActiveQuery
{
}