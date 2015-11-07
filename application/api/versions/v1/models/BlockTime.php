<?php

namespace api\versions\v1\models;

/**
 * This is the model class for table "block_time".
 *
 * @property integer $id
 * @property string $starttime
 * @property string $endtime
 * @property string $created_time
 * @property integer $course_id
 *
 * @property Course $course
 */
class BlockTime extends \api\common\models\BlockTime
{

}
