<?php
namespace src\entities;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $user_id
 * @property string $name
 * @property string $photo
 * @property integer $friends
 * @property integer $groups
 * @property integer $photos
 * @property integer $audios
 * @property integer $followers
 * @property integer $ball
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 10;
    public $user_href;

    public static function create($username, $email, $password) : User
    {
        $user = new static();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->status = self::STATUS_WAIT;
        $user->email_confirm_token = Yii::$app->security->generateRandomString();
        return $user;
    }

    public static function createNetwork($userInfo, $network) : User
    {
        $user = new static();
        $user->username = $network.'_id= '.$userInfo['id'];
        $user->email = $userInfo['email'] ? "from_".$network."=".$userInfo['email'] : $userInfo['id'].'noemail@a.a';
        $user->setPassword($userInfo['id']);
        $user->generateAuthKey();
        $user->friends = $userInfo['friends'];
        $user->status = User::STATUS_ACTIVE;

        if($network == 'fb') {
            $user->name = $userInfo['name'];
            $user->photos = $userInfo['photos'];
            $user->user_id = $network.'id'.$userInfo['id'];
            $user->photo = $userInfo['picture'];
        }

        if($network == 'vk') {
            $user->name=$userInfo['first_name']." ".$userInfo['last_name'];
            $user->groups=$userInfo['groups'];
            $user->followers=$userInfo['followers_count'];
            $user->audios=$userInfo['audios'];
            $user->user_id='id'.$userInfo['uid'];
            $user->photo=$userInfo['photo_200_orig'];
            $user->photos=$userInfo['photos'];
        }

        return $user;
    }

    public function afterFind()
    {
        if($this->user_id{0}=='f' && $this->user_id{1}=="b")
            $this->user_href="https://www.facebook.com/".substr($this->user_id, 4);
        else if($this->user_id{0}=='i' && $this->user_id{1}=="d") $this->user_href="https://vk.com/".$this->user_id;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_WAIT],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_WAIT]],
        ];
    }

    public function resetPassword($password)
    {
        $this->setPassword($password);
        $this->removePasswordResetToken();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
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
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function requestPasswordReset()
    {
        if (self::isPasswordResetTokenValid($this->password_reset_token)) {
            throw new \DomainException('Password reset is already requested');
        }
        $this->password_reset_token = Yii::$app->security->generateRandomString().'_'.time();
    }

    public function confirmSignup()
    {
        $this->status = User::STATUS_ACTIVE;
        $this->email_confirm_token = null;
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
     * @return bool if password provided is valid for current user
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

    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }
}
