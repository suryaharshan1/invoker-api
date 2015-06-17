<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "institute_rating".
 *
 * @property integer $id
 * @property integer $rating
 * @property string $review
 * @property integer $institute_id
 * @property integer $user_id
 * @property string $rating_time
 *
 * @property Institute $institute
 * @property Users $user
 */
class InstituteRating extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'institute_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rating', 'institute_id', 'user_id'], 'required'],
            [['rating', 'institute_id', 'user_id'], 'integer'],
            [['review'], 'string'],
            [['rating_time'], 'safe']
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
            'institute_id' => 'Institute ID',
            'user_id' => 'User ID',
            'rating_time' => 'Rating Time',
        ];
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
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}

class InstituteRatingQuery extends \api\components\db\ActiveQuery
{
}