<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "subject_topic".
 *
 * @property integer $id
 * @property string $topic_name
 * @property string $topic_description
 * @property integer $subject_id
 *
 * @property Subject $subject
 * @property UserHasSubjectTopic[] $userHasSubjectTopics
 */
class SubjectTopic extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject_topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_name', 'subject_id'], 'required'],
            [['topic_description'], 'string'],
            [['subject_id'], 'integer'],
            [['topic_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic_name' => 'Topic Name',
            'topic_description' => 'Topic Description',
            'subject_id' => 'Subject ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasSubjectTopics()
    {
        return $this->hasMany(UserHasSubjectTopic::className(), ['subject_topics_id' => 'id']);
    }
}

class SubjectTopicQuery extends \api\components\db\ActiveQuery
{
}