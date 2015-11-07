<?php

namespace api\versions\v1\models;

/**
 * This is the model class for table "user_has_course".
 *
 * @property integer $user_id
 * @property integer $course_id
 *
 * @property Course $course
 * @property User $user
 */
class UserHasCourse extends \api\common\models\UserHasCourse
{

}
