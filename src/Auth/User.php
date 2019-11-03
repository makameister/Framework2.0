<?php
namespace App\Auth;

class User implements \Framework\Auth\User
{
    public $id;

    public $firstname;

    public $lastname;

    public $email;

    public $password;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return [];
    }
}
