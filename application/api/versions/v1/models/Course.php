<?php

namespace api\versions\v1\models;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $name
 * @property integer $institute_id
 *
 * @property BlockTime[] $blockTimes
 * @property Institute $institute
 * @property CourseHasUser[] $courseHasUsers
 * @property UserCourse[] $userMobiles
 */
class Course extends \api\common\models\Course
{

}
