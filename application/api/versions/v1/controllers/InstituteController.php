<?php

namespace api\versions\v1\controllers;

class InstituteController extends \api\common\controllers\InstituteController
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
