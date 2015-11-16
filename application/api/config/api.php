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
                        'GET courses' => 'courses',
                    ],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'v1/user',
					'except' => ['delete', 'update'],
					'extraPatterns' => [
                        'POST times' => 'times',
                        'POST setcourselist' => 'setcourselist',
                        'POST setaccesstime' => 'setaccesstime',
                        'POST setregtoken' => 'setregtoken',
                        'POST register' => 'register'
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
		'user' => [
			'identityClass' => 'api\models\User',
			'loginUrl' => null,
        ],
    ],
    'params' => [],
];
