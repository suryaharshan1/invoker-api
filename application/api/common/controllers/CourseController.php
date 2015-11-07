<?php

namespace api\common\controllers;
use \Yii as Yii;


class CourseController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\Course';

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
