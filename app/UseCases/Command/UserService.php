<?php


namespace App\UseCases\Command;


use App\Entity\User\User;

class UserService
{
    public function createAdmin($name, $email, $pass)
    {
        $user = User::register($name, $email, $pass);
        $user->verify();
        $user->changeRole('admin');
    }
}
