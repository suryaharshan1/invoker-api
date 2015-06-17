<?php
/**
 * Controller for manage users
 *
 * @author suryaharshan1
 * Date: 16.06.15
 * Time: 23:40
 */

namespace api\common\controllers;
use \Yii as Yii;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\ConflictHttpException;

class UserController extends \api\components\ActiveController
{
	public $modelClass = '\api\models\User';

	public function accessRules()
	{
		return [
			[
				'allow' => true,
				'roles' => ['?'],
			],
			[
				'allow' => true,
				'actions' => [
					'index',
					'view',
					'change'
				],
				'roles' => ['@'],
			]
		];
	}

	public function actionRegister(){
		$model = new $this->modelClass([
			'scenario' => yii\base\Model::SCENARIO_DEFAULT,
			]);

		$bodyParams =  Yii::$app->getRequest()->getBodyParams();
		if(isset($bodyParams["email"])){
			if(null !== $model->findByEmail($bodyParams["email"])){
				throw new ConflictHttpException("User already exists. ");				
			}
		}
		else {
			throw new BadRequestHttpException("Invalid fields in the data. ");
		}
		$model->load($bodyParams, '');
		if(isset($bodyParams["password_hash"])){
			$model->setPassword($bodyParams["password_hash"]);
		}
		else{
			throw new BadRequestHttpException("Invalid fields in the data. ");
		}
        $model->generateAuthKey();
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
	}

	public function actionChange(){    
		/* @var $model ActiveRecord */
		$bodyParams = Yii::$app->getRequest()->getBodyParams();
        $model = new $this->modelClass([
			'scenario' => yii\base\Model::SCENARIO_DEFAULT,
			]);
        $model = $model->findIdentity($bodyParams["id"]);
        if(isset($bodyParams["auth_key"]) || isset($bodyParams["password_reset_token"]) || isset($bodyParams["created_at"]) || isset($bodyParams["updated_at"]) || isset($bodyParams["mobile_regid"])){
        	throw new BadRequestHttpException('Invalid fields in the data.');
        }
        if(isset($bodyParams["email"])){
        	throw new NotAcceptableHttpException('Username cannot be changed. ');
        	
        }
        if(isset($bodyParams["password_hash"])){
        	$model->setPassword($bodyParams["password_hash"]);
        }
        
        $model->scenario = yii\base\Model::SCENARIO_DEFAULT;
        $model->load($bodyParams, '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }

        return $model;
	}
}