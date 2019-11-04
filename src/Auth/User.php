<?php
namespace App\Auth;

class User implements \Framework\Auth\User
{
    public $id;

    public $email;

    public $password;

    public $role;

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
}
