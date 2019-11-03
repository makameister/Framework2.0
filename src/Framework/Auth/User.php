<?php

namespace Framework\Auth;

interface User
{

    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return string[]
     */
    public function getRoles(): array;
}
