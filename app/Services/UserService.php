<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser($full_name, $email, $team_id)
    {
        $user_details = ['full_name' => $full_name,'email' => $email,'team_id' => $team_id];
        $result = $this->repository->createUser($user_details);

        return $result;
    }

    public function updateUser($user_id, $full_name, $email, $team_id)
    {
        $user_details = ['full_name' => $full_name,'email' => $email,'team_id' => $team_id];
        $result = $this->repository->updateUser($user_id, $user_details);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function isUserExistsByEmail($email)
    {
        $result = $this->repository->getUserByEmail($email);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function isUserExistsById($user_id)
    {
        $result = $this->repository->getUserbyId($user_id);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function isOtherUserExistsWithSameEmail($email, $user_id)
    {
        $result = $this->repository->getUserByEmailExcludingSingleUser($email, $user_id);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($user_id)
    {
        $result = $this->repository->deleteUser($user_id);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserById($user_id)
    {
        $result = $this->repository->getUserById($user_id);

        return $result;
    }

    public function getAllUsers()
    {
        return $this->repository->getAll();
    }
}
