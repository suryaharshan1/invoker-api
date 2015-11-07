<?php

namespace api\versions\v1\controllers;

class InstituteController extends \api\common\controllers\InstituteController
{
    public $modelClass = '\api\versions\v1\models\Institute';

    public function actionCourses($id){
        $model = $this->loadModel($id);
        return $model->getCourses();
    }
}
