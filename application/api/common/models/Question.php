<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property string $question_description
 * @property integer $daily_test_id
 *
 * @property DailyTest $dailyTest
 * @property QuestionAnswer[] $questionAnswers
 * @property QuestionChoice[] $questionChoices
 */
class Question extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_description', 'daily_test_id'], 'required'],
            [['daily_test_id'], 'integer'],
            [['question_description'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_description' => 'Question Description',
            'daily_test_id' => 'Daily Test ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDailyTest()
    {
        return $this->hasOne(DailyTest::className(), ['id' => 'daily_test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionAnswers()
    {
        return $this->hasMany(QuestionAnswer::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionChoices()
    {
        return $this->hasMany(QuestionChoice::className(), ['question_id' => 'id']);
    }
}

class QuestionQuery extends \api\components\db\ActiveQuery
{
}