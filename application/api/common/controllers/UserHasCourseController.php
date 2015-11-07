<?php

namespace api\common\controllers;
use \Yii as Yii;

class UserHasCourseController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\UserHasCourse';

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
