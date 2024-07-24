<?php

namespace App\Services;

use App\Models\User;

class UsersService
{
   public function getAllUsers(){
      return User::all();
   }
}

