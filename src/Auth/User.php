<?php
namespace App\Auth;

class User implements \Framework\Auth\User
{
    public $id;

    public $email;

    public $password;

    public $role;

    public $passwordReset;

    public $passwordResetAt;

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @override
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getPasswordReset()
    {
        return $this->passwordReset;
    }

    /**
     * @param mixed $passwordReset
     */
    public function setPasswordReset($passwordReset)
    {
        $this->passwordReset = $passwordReset;
    }

    public function setPasswordResetAt($date)
    {
        if (is_string($date)) {
            $this->passwordResetAt = new \DateTime($date);
        } else {
            $this->passwordResetAt = $date;
        }
    }

    /**
     * @return mixed
     */
    public function getPasswordResetAt(): ?\DateTime
    {
        return $this->passwordResetAt;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
