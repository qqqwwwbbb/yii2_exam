<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property int|null $role
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $check;
    public $password_repeat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'username', 'password', 'password_repeat', 'email', 'phone'], 'required'],
            [['role'], 'integer'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['firstname', 'match', 'pattern' => '/^[а-яА-Я -]*$/u'],
            ['lastname', 'match', 'pattern' => '/^[а-яА-Я -]*$/u'],
            ['check', 'compare', 'compareValue' => 1, 'message' => 'Примите согласие на обработку данных'],
            [['firstname', 'lastname', 'password'], 'string', 'max' => 32],
            [['username'], 'string', 'max' => 25],
            ['email', 'email'],
            [['email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 12],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'username' => 'Username',
            'password' => 'Password',
            'password_repeat' => 'Повтор пароля',
            'email' => 'Email',
            'phone' => 'Phone',
            'check' => 'Согласие на обработку данных',
            'role' => 'Role',
        ];
    }

    public function isAdmin()
    {
        return $this->role == 1;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
