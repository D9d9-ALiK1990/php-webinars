<?php


namespace App\Data\User;


class UserService
{
    private static $salt = 'ebd*K8frS!7w';

    public function  passwordEncoder(string $password)
    {
        return $this->passwordHash($password);
    }

    public function passwordVerify(string $password, string $hash)
    {
        return password_verify($password, $hash);
    }

    protected function encodeByMd5(string $encodedString)
    {
        return md5(md5($encodedString . static::$salt) . static::$salt);
    }

    protected function passwordHash(string $encodedString)
    {
        return password_hash($encodedString, PASSWORD_DEFAULT);
    }



}