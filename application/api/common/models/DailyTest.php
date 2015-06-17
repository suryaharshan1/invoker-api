<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "daily_test".
 *
 * @property integer $id
 * @property integer $course_id
 * @property string $available_from
 * @property string $expiry_time
 *
 * @property Course $course
 * @property Question[] $questions
 * @property TestPerformance[] $testPerformances
 */
class DailyTest extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daily_test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id'], 'required'],
            [['course_id'], 'integer'],
            [['available_from', 'expiry_time'], 'safe']
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
            'available_from' => 'Available From',
            'expiry_time' => 'Expiry Time',
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
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['daily_test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestPerformances()
    {
        return $this->hasMany(TestPerformance::className(), ['test_id' => 'id']);
    }
}

class DailyTestQuery extends \api\components\db\ActiveQuery
{
}