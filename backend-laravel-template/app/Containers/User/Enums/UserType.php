<?php

namespace App\Containers\User\Enums;

enum UserType: string
{
    case TYPE_ADMIN = 'admin';
    case TYPE_USER = 'user';
}
