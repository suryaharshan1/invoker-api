<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "newspaper".
 *
 * @property integer $id
 * @property string $added_on
 * @property string $content
 * @property string $headline
 * @property string $origin
 */
class Newspaper extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newspaper';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['added_on'], 'safe'],
            [['content', 'headline', 'origin'], 'required'],
            [['content'], 'string'],
            [['headline'], 'string', 'max' => 255],
            [['origin'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'added_on' => 'Added On',
            'content' => 'Content',
            'headline' => 'Headline',
            'origin' => 'Origin',
        ];
    }
}

class NewspaperQuery extends \api\components\db\ActiveQuery
{
}