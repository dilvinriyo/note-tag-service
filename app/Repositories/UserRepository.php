<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class UserRepository
{
    public function createUser($user_details)
    {
    	try {
            return User::create($user_details);
        } catch (QueryException $e) {
    		Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
    	}   
    }

    public function updateUser($user_id, $user_details)
    {
        try {
            return User::where('id', $user_id)->update($user_details);
        } catch (QueryException $e) {
            Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
        }
    }

    public function getUserByEmail($email)
    {
        try {
            return User::where('email', $email)->first();
        } catch (QueryException $e) {
            Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
        }
    }

    public function getUserById($user_id)
    {
        try {
            return User::where('id', $user_id)->first();
        } catch (QueryException $e) {
            Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
        }
    }

    public function getUserByEmailExcludingSingleUser($email, $user_id)
    {
        try {
            return User::where('id', '!=' , $user_id)->where('email', $email)->first();
        } catch (QueryException $e) {
            Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
        }
    }

    public function deleteUser($user_id)
    {
        try {
            return User::destroy($user_id);
        } catch (QueryException $e) {
            Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
        }
    }

    public function getAll()
    {
        return User::all();
    }
}
