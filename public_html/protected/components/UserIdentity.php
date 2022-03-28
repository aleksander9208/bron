<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    const ERROR_EMAIL_INVALID = 3;
    const ERROR_STATUS_NOTACTIV = 4;
    const ERROR_STATUS_BAN = 5;

    protected $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {

        $user = User::model()->findByAttributes(
            array(
                'login' => $this->username,
                'code'  => $this->code,
            )
        );
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ((self::encrypting($this->password) !== $user->password) && ($user->password !== self::encrypting(str_replace(array(' ', '-', '(', ')'), '', $this->password))))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else  {
            $this->_id = $user->id;
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function authenticateById($id) {
        $user = User::model()->findByPk($id);
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            $this->_id = $user->id;
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public static function encrypting($string = "", $hash = 'md5')
    {
        if ($hash == "md5")
            return md5($string);
        if ($hash == "sha1")
            return sha1($string);
        else
            return hash($hash, $string);
    }
}