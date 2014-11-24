<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        private $_id;
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
            /*$username=strtolower($this->username);
            $user=User::model()->find('login=?',array($username));
            if($user===null)
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            else if(!$user->validatePassword($this->password))
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else
            {
                $this->_id=$user->id;
                $this->username=$user->username;
                $this->errorCode=self::ERROR_NONE;
            }
            return $this->errorCode==self::ERROR_NONE;*/
            
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;*/

    
       $record=User::model()->findByAttributes(array('login'=>$this->username));
       /*  echo crypt($this->password, $record->password)." === ". $record->password." 5 5 5 5 5 ".$record->password; /*=== $record->password*///  $record->password." ".CPasswordHelper::hashPassword($this->password);//$this->password;

        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;

        else if (crypt($this->password, $record->password)!== $record->password)//($this->password!=$record->password)//(!CPasswordHelper::verifyPassword($this->password,$record->password))//
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->id;
            $this->setState('title', $record->login);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;

	}

	public function getId()
    {
        return $this->_id;
    }
}