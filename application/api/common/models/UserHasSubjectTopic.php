<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "user_has_subject_topic".
 *
 * @property integer $user_id
 * @property integer $subject_topics_id
 * @property integer $checked
 *
 * @property Users $user
 * @property SubjectTopic $subjectTopics
 */
class UserHasSubjectTopic extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_has_subject_topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'subject_topics_id'], 'required'],
            [['user_id', 'subject_topics_id', 'checked'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'subject_topics_id' => 'Subject Topics ID',
            'checked' => 'Checked',
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
    public function getSubjectTopics()
    {
        return $this->hasOne(SubjectTopic::className(), ['id' => 'subject_topics_id']);
    }
}

class UserhasSubjectTopicQuery extends \api\components\db\ActiveQuery
{
}