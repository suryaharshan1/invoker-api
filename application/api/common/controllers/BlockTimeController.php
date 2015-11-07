<?php

namespace api\common\controllers;
use \Yii as Yii;

class BlockTimeController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\BlockTime';

    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['?'],
            ]
        ];
    }    
}
