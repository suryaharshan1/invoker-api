<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "course_type".
 *
 * @property integer $id
 * @property string $description
 *
 * @property Course[] $courses
 */
class CourseType extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['coursetype_id' => 'id']);
    }
}


class CourseTypeQuery extends \api\components\db\ActiveQuery
{
}