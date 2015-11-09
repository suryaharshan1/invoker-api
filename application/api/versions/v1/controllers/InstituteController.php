<?php

namespace api\versions\v1\controllers;

class InstituteController extends \api\common\controllers\InstituteController
{
    public $modelClass = '\api\versions\v1\models\Institute';

    //with url of type institute/courses?id=0
    public function actionCourses($id){
    	$modelClass = $this->modelClass; 
        $model = $modelClass::find()->where(['id' => $id])->one();
        if($model !== null)
        	$data = $model->getCourses()->asArray()->all();
        else
        	$data = array();
        return $data;
    }
}
