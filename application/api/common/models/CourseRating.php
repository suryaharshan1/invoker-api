<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "course_rating".
 *
 * @property integer $id
 * @property integer $rating
 * @property string $review
 * @property integer $course_id
 * @property integer $user_id
 * @property string $rating_time
 *
 * @property Course $course
 * @property Users $user
 */
class CourseRating extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rating', 'course_id', 'user_id'], 'required'],
            [['rating', 'course_id', 'user_id'], 'integer'],
            [['rating_time'], 'safe'],
            [['review'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rating' => 'Rating',
            'review' => 'Review',
            'course_id' => 'Course ID',
            'user_id' => 'User ID',
            'rating_time' => 'Rating Time',
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
}

class CourseRatingQuery extends \api\components\db\ActiveQuery
{
}