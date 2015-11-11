<?php

namespace api\versions\v1\controllers;
use \Yii as Yii;


class UserController extends \api\common\controllers\UserController
{

	public $modelClass = '\api\versions\v1\models\User';

	/**
	*	@POST method
	*   POST Parameters - mobile_id of the requesting user
	*   @return the block times added after the user's last access time
	**/
	public function actionTimes(){

		$bodyParams = Yii::$app->getRequest()->getBodyParams();

		$mobile_id = $bodyParams['mobile_id'];

		$modelClassUser = '\api\versions\v1\models\User';
		$User = $modelClassUser::find()->where(['mobile_id'=>$mobile_id])->one();

		$modelClassUserCourses = '\api\versions\v1\models\UserHasCourse';
		$courses_id = $modelClassUserCourses::find()->where(['user_id'=>$User['id']])->asArray()->all();

		$modelClassTimes = '\api\versions\v1\models\BlockTime';
		$Times = $modelClassTimes::find()->where(['course_id'=>$courses_id])->andWhere(['between','created_time',$User['access_time'],date('Y:m:d H:i:s')])->asArray()->all();

		return $Times;

	}


}
