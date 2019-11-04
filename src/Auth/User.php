<?php
namespace App\Auth;

class User implements \Framework\Auth\User
{
    public $id;

    public $email;

    public $password;

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return [];
    }
}
