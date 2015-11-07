<?php

namespace api\common\controllers;
use \Yii as Yii;


class InstituteController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\Institute';

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
