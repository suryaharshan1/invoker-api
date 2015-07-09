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
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/chat',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/course',
					'except' => ['create','delete'],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/course-discussion',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/course-rating',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/course-type',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/daily-test',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/discussion-reply',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/institute',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/institute-rating',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/newspaper',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/notification',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/planner',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/question-answer',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/question-choice',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/question',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/subject',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/subject-topic',
					
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/test-performance',
					
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
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/user-has-subject-topic',
					
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
