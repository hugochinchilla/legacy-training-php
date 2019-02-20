<?php

namespace App\Repository;

use App\Model\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;

    public function save(User $user): void;
}