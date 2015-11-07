<?php
namespace api\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface, \OAuth2\Storage\UserCredentialsInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const ROLE_USER = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
				'class' => TimestampBehavior::className(),
				'value' => new Expression('NOW()'),
			]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'auth_key', 'password_hash', 'mobile_number', 'first_name', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['usertype'], 'integer'],
            [['image'], 'string'],
            [['email', 'password_hash', 'password_reset_token', 'first_name', 'father_name', 'mobile_regid'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['mobile_number'], 'string', 'max' => 12],
            [['ambition'], 'string', 'max' => 511],
            [['last_name'], 'string', 'max' => 60],
            [['address'], 'string', 'max' => 2000]
        ];
    }

        /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'mobile_number' => 'Mobile Number',
            'usertype' => 'Usertype',
            'ambition' => 'Ambition',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'father_name' => 'Father Name',
            'address' => 'Address',
            'image' => 'Image',
            'mobile_regid' => 'Mobile Regid',
        ];
    }

    public function fields(){
        $fields = parent::fields();
        unset($fields['auth_key'],$fields['password_hash'],$fields['password_reset_token'],$fields['mobile_regid']);
        return $fields;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertisements()
    {
        return $this->hasMany(Advertisement::className(), ['advertisedby' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats0()
    {
        return $this->hasMany(Chat::className(), ['to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['instructor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseDiscussions()
    {
        return $this->hasMany(CourseDiscussion::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseRatings()
    {
        return $this->hasMany(CourseRating::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussionReplies()
    {
        return $this->hasMany(DiscussionReply::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitutes()
    {
        return $this->hasMany(Institute::className(), ['manager_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstituteRatings()
    {
        return $this->hasMany(InstituteRating::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanners()
    {
        return $this->hasMany(Planner::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestPerformances()
    {
        return $this->hasMany(TestPerformance::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasCourses()
    {
        return $this->hasMany(UserHasCourse::className(), ['userId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasSubjectTopics()
    {
        return $this->hasMany(UserHasSubjectTopic::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
		/** @var \filsh\yii2\oauth2server\Module $module */
		$module = Yii::$app->getModule('oauth2');
		$token = $module->getServer()->getResourceController()->getToken();

		return !empty($token['user_id'])
					? static::findIdentity($token['user_id'])
					: null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

	public function checkUserCredentials($username, $password)
	{
		$user = static::findByEmail($username);
		if (empty($user)) {
			return false;
		}
		return $user->validatePassword($password);
	}

	public function getUserDetails($username)
	{
		$user = static::findByEmail($username);
		return ['user_id' => $user->getId()];
	}
}
