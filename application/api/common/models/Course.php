<?php

namespace api\common\models;
use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $name
 * @property integer $institute_id
 *
 * @property BlockTime[] $blockTimes
 * @property Institute $institute
 * @property CourseHasUser[] $courseHasUsers
 * @property UserCourse[] $userMobiles
 */
class Course extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'institute_id'], 'required'],
            [['institute_id'], 'integer'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'institute_id' => 'Institute ID',
            'institute.name' => 'Institute',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockTimes()
    {
        return $this->hasMany(BlockTime::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitute()
    {
        return $this->hasOne(Institute::className(), ['id' => 'institute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseHasUsers()
    {
        return $this->hasMany(CourseHasUser::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserMobiles()
    {
        return $this->hasMany(UserCourse::className(), ['mobile_id' => 'user_mobile_id'])->viaTable('course_has_user', ['course_id' => 'id']);
    }
}
