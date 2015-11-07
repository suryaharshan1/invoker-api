<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "institute".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Course[] $courses
 */
class Institute extends \api\components\db\ActiveRecord
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
            [['name'], 'required'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['institute_id' => 'id']);
    }
}
