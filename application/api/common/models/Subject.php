<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $name
 * @property integer $course_id
 * @property string $syllabus
 *
 * @property Course $course
 * @property SubjectTopic[] $subjectTopics
 */
class Subject extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'course_id'], 'required'],
            [['course_id'], 'integer'],
            [['syllabus'], 'string'],
            [['name'], 'string', 'max' => 60]
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
            'course_id' => 'Course ID',
            'syllabus' => 'Syllabus',
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
    public function getSubjectTopics()
    {
        return $this->hasMany(SubjectTopic::className(), ['subject_id' => 'id']);
    }
}

class SubjectQuery extends \api\components\db\ActiveQuery
{
}