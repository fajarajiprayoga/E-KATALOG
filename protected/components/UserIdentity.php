<?php



class UserIdentity extends CUserIdentity

{

    private $_id;

    /**

     * Authenticates a user.

     * @return boolean whether authentication succeeds.

     */

    public function authenticate()

    {

        $username = strtolower($this->username);

        // from database... change to suit your authentication criteria

        // -- Nope, I wont include mine --

        $user = User::model()->find('LOWER(username)=?', array($username));

        if($user===null)

            $this->errorCode=self::ERROR_USERNAME_INVALID;

        else if($user->password !== $user->encrypt($this->password))

            $this->errorCode = self::ERROR_PASSWORD_INVALID;

        else{

            // successful login

            $this->_id = $user->id;

            $this->username = $user->username;

            $this->errorCode = self::ERROR_NONE;

        }

        return $this->errorCode == self::ERROR_NONE;

    }

    public function getId()

    {

        return $this->_id;

    }

}

