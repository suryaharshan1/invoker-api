<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "user_has_course".
 *
 * @property integer $userId
 * @property integer $courseId
 * @property string $joiningTime
 * @property string $expirytime
 *
 * @property Users $user
 * @property Course $course
 */
class UserHasCourse extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_has_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'courseId'], 'required'],
            [['userId', 'courseId'], 'integer'],
            [['joiningTime', 'expirytime'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'courseId' => 'Course ID',
            'joiningTime' => 'Joining Time',
            'expirytime' => 'Expirytime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'courseId']);
    }
}

class UserHasCourseQuery extends \api\components\db\ActiveQuery
{
}