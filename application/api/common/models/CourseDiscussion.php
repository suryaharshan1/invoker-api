<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "course_discussion".
 *
 * @property integer $id
 * @property integer $course_id
 * @property integer $user_id
 * @property string $discussion
 * @property string $create_time
 *
 * @property Course $course
 * @property Users $user
 * @property DiscussionReply[] $discussionReplies
 */
class CourseDiscussion extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_discussion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'user_id', 'discussion'], 'required'],
            [['course_id', 'user_id'], 'integer'],
            [['discussion'], 'string'],
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
            'course_id' => 'Course ID',
            'user_id' => 'User ID',
            'discussion' => 'Discussion',
            'create_time' => 'Create Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussionReplies()
    {
        return $this->hasMany(DiscussionReply::className(), ['coursediscussion_id' => 'id']);
    }
}

class CourseDiscussionQuery extends \api\components\db\ActiveQuery
{
}