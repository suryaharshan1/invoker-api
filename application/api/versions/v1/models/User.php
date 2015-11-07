<?php

namespace api\versions\v1\models;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $mobile_id
 * @property string $phone_number
 * @property string $access_time
 *
 * @property UserHasCourse[] $userHasCourses
 * @property Course[] $courses
 */
class User extends \api\common\models\User
{
 
}
