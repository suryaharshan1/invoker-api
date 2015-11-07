<?php

namespace api\versions\v1\controllers;

class BlockTimeController extends \api\common\controllers\BlockTimeController
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
