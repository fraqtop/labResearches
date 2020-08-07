<?php


namespace App\Services;


use App\Http\Resources\UserCollection;
use App\User;

class UserService extends Service
{
    protected string $class = User::class;

    public function getCollectionClass(): string
    {
        return UserCollection::class;
    }

}