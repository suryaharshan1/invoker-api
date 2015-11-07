<?php

namespace api\versions\v1\controllers;


class CourseController extends \api\common\controllers\CourseController
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
