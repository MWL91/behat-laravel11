<?php

namespace App\Services;

use App\Models\Car;
use App\Models\User;

interface RentService
{
    public function rentCarAsUser(User $user, Car $car): void;
}