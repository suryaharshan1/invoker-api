<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property string $notified_time
 * @property integer $institute_id
 * @property string $description
 * @property integer $course_id
 * @property integer $type
 *
 * @property Course $course
 * @property Institute $institute
 */
class Notification extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notified_time'], 'safe'],
            [['institute_id', 'course_id', 'type'], 'integer'],
            [['description', 'type'], 'required'],
            [['description'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notified_time' => 'Notified Time',
            'institute_id' => 'Institute ID',
            'description' => 'Description',
            'course_id' => 'Course ID',
            'type' => 'Type',
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
    public function getInstitute()
    {
        return $this->hasOne(Institute::className(), ['id' => 'institute_id']);
    }
}

class NotificationQuery extends \api\components\db\ActiveQuery
{
}