<?php
return [
    'id' => 'app-api',
	'name' => 'guru',

    'controllerNamespace' => 'api\controllers',
	'defaultRoute' => 'user',

    'components' => [
		'urlManager' => [
			'enablePrettyUrl' => true,
			'rules' => [
				'POST /oauth2/<action:\w+>' => 'oauth2/default/<action>',
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/advertisement',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/chat',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/course',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/course-discussion',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/course-rating',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/course-type',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/daily-test',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/discussion-reply',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/institute',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/institute-rating',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/newspaper',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/notification',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/planner',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/question-answer',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/question-choice',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/question',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/subject',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/subject-topic',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/test-performance',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/user',
					'except' => ['delete', 'create', 'update'],
					'extraPatterns' => [
						'POST register' => 'register',
						'PUT update' => 'change'
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/user-has-course',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/user-has-subject-topic',
					'extraPatterns' => [
						'GET custom' => 'custom',
						'GET protected' => 'protected',
					],
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
