<?php

namespace Framework\Auth;

interface User
{
    /**
     * @return string
     */
    public function getEmail(): string;
    /**
     * @return string[]
     */
    public function getRole(): string;
}
