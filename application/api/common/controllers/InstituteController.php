<?php
/**
 * Controller for manage products
 *
 * @author ihor@karas.in.ua
 * Date: 03.04.15
 * Time: 00:35
 */

namespace api\common\controllers;
use \Yii as Yii;


class InstituteController extends \api\components\ActiveController
{
	public $modelClass = '\api\common\models\Institute';

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
					'view',
					'create',
					'update',
					'delete'
				],
				'roles' => ['@'],
			]
		];
	}
}