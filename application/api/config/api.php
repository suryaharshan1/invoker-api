<?php
return [
    'id' => 'app-api',
	'name' => 'invoker',

    'controllerNamespace' => 'api\controllers',
	'defaultRoute' => 'user',

    'components' => [
		'urlManager' => [
			'enablePrettyUrl' => true,
            'rules' => [
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/course',
					'except' => ['create','delete','update'],
                    'pluralize' => false,
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/institute',
                    'except' => ['create','delete','update'],
                    'extraPatterns' => [
                        'GET Courses' => 'courses',
                    ],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/user',
					'except' => ['delete', 'create', 'update'],
					'extraPatterns' => [
						'POST register' => 'register',
						'PATCH update' => 'change',
						'GET profile' => 'profile'
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/user-has-course',
				],
			]
		],
		'request' => [
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			]
		],
		'response' => [
			'class' => 'yii\web\Response',
			'formatters' => [
				yii\web\Response::FORMAT_HTML => '\api\components\HtmlResponseFormatter',
			],
			'on beforeSend' => function (\yii\base\Event $event) {
				/** @var \yii\web\Response $response */
				$response = $event->sender;
				// catch situation, when no controller hasn't been loaded
				// so no filter wasn't loaded too. Need to understand in which format return result
				if(empty(Yii::$app->controller)) {
					$content_neg = new \yii\filters\ContentNegotiator();
					$content_neg->response = $response;
					$content_neg->formats = Yii::$app->params['formats'];
					$content_neg->negotiate();
				}
				if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
					$response->data = [
						'success' => $response->isSuccessful,
						'data' => $response->data,
					];
					$response->statusCode = 200;
				}
			},
		],
		'user' => [
			'identityClass' => 'api\models\User',
			'loginUrl' => null,
        ],
    ],
    'params' => [],
];
