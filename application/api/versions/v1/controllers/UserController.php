<?php

namespace api\versions\v1\controllers;
use \Yii as Yii;


class UserController extends \api\common\controllers\UserController
{

	public $modelClass = '\api\versions\v1\models\User';

	/**
	* @POST params : mobile_id , phone_number
	* create a user and returns it
	**/

	public function actionRegister(){
		$bodyParams = Yii::$app->getRequest()->getBodyParams();

		$mobile_id = $bodyParams['mobile_id'];
		$phone_number = $bodyParams['phone_number'];

		$modelClassUser = '\api\versions\v1\models\User';
		$User = $modelClassUser::find()->where(['mobile_id'=>$mobile_id])->one();

		if($User != NULL){

			$modelClassUserCourses = '\api\versions\v1\models\UserHasCourse';
			$modelClassUserCourses::deleteAll(['user_id' => $User['id']]);
			$User->phone_number = $bodyParams['phone_number'];
			$User->save();
			return $User;
		}

		else{
			$model = new $modelClassUser();
			$model->mobile_id = $mobile_id;
			$model->phone_number = $phone_number;
			$model->save();
			return $model;
		}

	}

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
		$Times = $modelClassTimes::find()->where(['course_id'=>$courses_id])->andWhere(['>=','created_time',$User['access_time']])->asArray()->all();

		$result = array();
		$result["blockTimes"] = $Times;
		$result["access_time"] = date('Y:m:d H:i:s');

		$User->access_time = date('Y:m:d H:i:s');
		$User->save();

		return $result;


	}

	/**
	* @POST method
	* POST Params - new course list , mobile id of user
	* @return the block times (with stattime > currenttime) for new set of courses
	**/
	public function actionSetcourselist(){

		$bodyParams = Yii::$app->getRequest()->getBodyParams();

		$mobile_id = $bodyParams['mobile_id'];
		$courses_id = $bodyParams['courses'];

		$modelClassUser = '\api\versions\v1\models\User';
		$User = $modelClassUser::find()->where(['mobile_id'=>$mobile_id])->one();

		$modelClassUserCourses = '\api\versions\v1\models\UserHasCourse';
		$modelClassUserCourses::deleteAll(['user_id' => $User['id']]);

		foreach ($courses_id as $course_id) {
			$UserHasCourse = new $modelClassUserCourses();
			$UserHasCourse->user_id = $User['id'];
			$UserHasCourse->course_id = $course_id;
			$UserHasCourse->save();
		}

		$modelClassTimes = '\api\versions\v1\models\BlockTime';
		$blockTimes = $modelClassTimes::find()->where(['course_id'=>$courses_id])->andWhere(['>=','starttime',date('Y:m:d H:i:s')])->asArray()->all();

		$result = array();
		$result["blockTimes"] = $blockTimes;
		$result["access_time"] = date('Y:m:d H:i:s');

		$User->access_time = date('Y:m:d H:i:s');
		$User->save();

		return  $result;

	}

	/**
	*	@POST method
	*   @param mobile_id and access_time of user
	*   sets the access_time for the user with given mobile_id
	**/
	public function actionSetaccesstime(){

		$bodyParams = Yii::$app->getRequest()->getBodyParams();
		$mobile_id = $bodyParams['mobile_id'];
		$access_time = $bodyParams['access_time'];

		$modelClassUser = '\api\versions\v1\models\User';
		$User = $modelClassUser::findOne(['mobile_id' => $mobile_id]);
		$User->access_time = $access_time;
		$User->save();

	}

	/**
	*	@POST method
	*   @param mobile_id and access_time of user
	*   sets the access_time for the user with given mobile_id
	**/
	public function actionSetregtoken(){

		$bodyParams = Yii::$app->getRequest()->getBodyParams();
		$mobile_id = $bodyParams['mobile_id'];
		$reg_token = $bodyParams['reg_token'];

		$modelClassUser = '\api\versions\v1\models\User';
		$User = $modelClassUser::findOne(['mobile_id' => $mobile_id]);
		$User->reg_token = $reg_token;
		$User->save();

	}

}
