<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "test_performance".
 *
 * @property integer $user_id
 * @property integer $test_id
 * @property integer $correct_count
 * @property integer $answer_count
 * @property string $feedback
 * @property string $completion_time
 *
 * @property Users $user
 * @property DailyTest $test
 */
class TestPerformance extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_performance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id', 'correct_count', 'answer_count'], 'required'],
            [['user_id', 'test_id', 'correct_count', 'answer_count'], 'integer'],
            [['completion_time'], 'safe'],
            [['feedback'], 'string', 'max' => 511]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'test_id' => 'Test ID',
            'correct_count' => 'Correct Count',
            'answer_count' => 'Answer Count',
            'feedback' => 'Feedback',
            'completion_time' => 'Completion Time',
        ];
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
    public function getTest()
    {
        return $this->hasOne(DailyTest::className(), ['id' => 'test_id']);
    }
}

class TestPerformanceQuery extends \api\components\db\ActiveQuery
{
}