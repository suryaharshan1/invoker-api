<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "institute".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $contact_no
 * @property string $registered_date
 * @property integer $manager_id
 *
 * @property Course[] $courses
 * @property Users $manager
 * @property InstituteRating[] $instituteRatings
 * @property Notification[] $notifications
 */
class Institute extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'institute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'contact_no', 'manager_id'], 'required'],
            [['address'], 'string'],
            [['registered_date'], 'safe'],
            [['manager_id'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
            [['contact_no'], 'string', 'max' => 15]
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
            'address' => 'Address',
            'email' => 'Email',
            'contact_no' => 'Contact No',
            'registered_date' => 'Registered Date',
            'manager_id' => 'Manager ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['institute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Users::className(), ['id' => 'manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstituteRatings()
    {
        return $this->hasMany(InstituteRating::className(), ['institute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['institute_id' => 'id']);
    }
}

class InstituteQuery extends \api\components\db\ActiveQuery
{
}