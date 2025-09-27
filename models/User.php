<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    public $password;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username'], 'required'],
            [['password'], 'required', 'on' => self::SCENARIO_CREATE], // senha obrigatória só no cadastro
            [['password'], 'safe', 'on' => self::SCENARIO_UPDATE], // senha opcional no update
            [['username'], 'string', 'max' => 255],
            [['password'], 'string', 'min' => 6],
        ];
    }

     public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['username', 'password'];
        $scenarios[self::SCENARIO_UPDATE] = ['username', 'password'];
        return $scenarios;
    }


    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // Se o campo password foi preenchido, gera o hash
        if (!empty($this->password)) {
            $this->setPassword($this->password);
        }

        return true;
    }

    // ========================
    // Métodos de autenticação
    // ========================

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
