<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "block_time".
 *
 * @property integer $id
 * @property string $starttime
 * @property string $endtime
 * @property string $created_time
 * @property integer $course_id
 *
 * @property Course $course
 */
class BlockTime extends \api\components\db\ActiveRecord
{
    public $institute;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['starttime', 'endtime', 'course_id'], 'required'],
            [['starttime', 'endtime', 'created_time','institute'], 'safe'],
            [['course_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'starttime' => 'Starttime',
            'endtime' => 'Endtime',
            'created_time' => 'Created Time',
            'course_id' => 'Course ID',
            'course.name' => 'Course',
            'course.institute.name' => 'Institute',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    public function getInstitute(){
        if($this->course_id != NULL){
            $institute_id = Course::find()->select(['institute_id'])->where([
                    'id' => $this->course_id,
                ])->one()->institute_id;

            $institute = Institute::findOne(['id'=>$institute_id]);
            return $institute;
        }
    }
}
