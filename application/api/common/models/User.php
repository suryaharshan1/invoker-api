<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $mobile_id
 * @property string $phone_number
 * @property string $access_time
 *
 * @property UserHasCourse[] $userHasCourses
 * @property Course[] $courses
 */
class User extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile_id', 'phone_number'], 'required'],
            [['access_time'], 'safe'],
            [['mobile_id'], 'string', 'max' => 60],
            [['phone_number'], 'string', 'max' => 12],
            [['mobile_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mobile_id' => 'Mobile ID',
            'phone_number' => 'Phone Number',
            'access_time' => 'Access Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasCourses()
    {
        return $this->hasMany(UserHasCourse::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['id' => 'course_id'])->viaTable('user_has_course', ['user_id' => 'id']);
    }
}
