<?php

namespace api\common\models;

use Yii;

/**
 * This is the model class for table "advertisement".
 *
 * @property integer $id
 * @property string $publish_time
 * @property string $head
 * @property string $description
 * @property string $expiry_time
 * @property integer $advertisedby
 *
 * @property Users $advertisedby0
 */
class Advertisement extends \api\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advertisement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publish_time', 'expiry_time'], 'safe'],
            [['head', 'description', 'advertisedby'], 'required'],
            [['description'], 'string'],
            [['advertisedby'], 'integer'],
            [['head'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publish_time' => 'Publish Time',
            'head' => 'Head',
            'description' => 'Description',
            'expiry_time' => 'Expiry Time',
            'advertisedby' => 'Advertisedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertisedby0()
    {
        return $this->hasOne(Users::className(), ['id' => 'advertisedby']);
    }
}

class AdvertisementQuery extends \api\components\db\ActiveQuery
{
}