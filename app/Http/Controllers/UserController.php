<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\UserService;
use App\Services\TeamService;

class UserController extends Controller
{
    function __construct(UserService $service, TeamService $teamService)
    {
        $this->service = $service;
        $this->teamService = $teamService;
    }

     /**
     * To create a user
     */
    public function createUser(Request $request)
    {
        // default settings
        $result   = [];
        $response = [];

        // check if team exists or not, if not return failed response
        $is_team_exists = $this->teamService->isTeamExistsById($request->team_id);
        if (!$is_team_exists) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.team_not_exists'),
            ];
            return response()->json($response, 200);
        }

        // check if user with same email already exists or not, if yes return failed response
        $is_email_exists = $this->service->isUserExistsByEmail($request->email);
        if ($is_email_exists) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.email_already_exists'),
            ];
            return response()->json($response, 200);
        }

        // if all good, create user
        $result = $this->service->createUser($request->full_name, $request->email, $request->team_id);

        // create response
        if ($result) {
            $response = [
                'code'    => config('api.code.success'),
                'message' => Lang::get('message.success'),
                'data'    => $result,
            ];
        } else {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.failed'),
            ];
        }

        return response()->json($response, 200);
    }

     /**
     * To update a specific user
     */
    public function updateUser(Request $request)
    {
        // default settings
        $result   = [];
        $response = [];

        // check if user exists or not, if not return failed response
        $is_user_exists = $this->service->isUserExistsById($request->user_id);
        if (!$is_user_exists) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.user_not_exists'),
            ];
            return response()->json($response, 200);
        }

        // check if team exists or not, if not return failed response
        $is_team_exists = $this->teamService->isTeamExistsById($request->team_id);
        if (!$is_team_exists) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.team_not_exists'),
            ];
            return response()->json($response, 200);
        }

        // check if other users with the same email already exists or not, if yes return failed response
        $is_email_exists = $this->service->isOtherUserExistsWithSameEmail($request->email, $request->user_id);
        if ($is_email_exists) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.email_already_exists'),
            ];
            return response()->json($response, 200);
        }

        // if all good, update user
        $result = $this->service->updateUser($request->user_id, $request->full_name, $request->email, $request->team_id);

        // create response
        if ($result) {
            $response = [
                'code'    => config('api.code.success'),
                'message' => Lang::get('message.success'),
            ];
        } else {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.failed'),
            ];
        }

        return response()->json($response, 200);
    }

     /**
     * To delete a specific user
     */
    public function deleteUser(Request $request)
    {
        // default settings
        $result   = [];
        $response = [];

        // check if user exists or not, if not return failed response
        $is_user_exists = $this->service->isUserExistsById($request->user_id);
        if (!$is_user_exists) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.user_not_exists'),
            ];
            return response()->json($response, 200);
        }

        // if all good, delete user
        $result = $this->service->deleteUser($request->user_id);

        // create response
        if ($result) {
            $response = [
                'code'    => config('api.code.success'),
                'message' => Lang::get('message.success'),
            ];
        } else {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.failed'),
            ];
        }

        return response()->json($response, 200);
    }

     /**
     * To get all available users
     */
    public function getAllUsers()
    {
        // default settings
        $result   = [];
        $response = [];

        // get all users
        $result = $this->service->getAllUsers();

        // create response
        if ($result) {
            $response = [
                'code'    => config('api.code.success'),
                'message' => Lang::get('message.success'),
                'data'    => $result,
            ];
        } else {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.failed'),
            ];
        }

        return response()->json($response, 200);
    }
}
