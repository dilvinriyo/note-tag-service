<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\TeamService;

class TeamController extends Controller
{
    function __construct(TeamService $service)
    {
        $this->service = $service;
    }

    /**
     * To create a time
     */
    public function createTeam(Request $request)
    {
        // default settings
        $result   = [];
        $response = [];

        // check if team already exists, if yes return failed response
        $is_exists = $this->service->isTeamExistsByName($request->name);
        if ($is_exists) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.team_already_exists'),
            ];
            return response()->json($response, 200);
        }

        // if all good, create team
        $result = $this->service->createTeam($request->name, $request->description);

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
     * To get all available teams
     */
    public function getAllTeams()
    {
        // default settings
        $result   = [];
        $response = [];

        // get all teams
        $result = $this->service->getAllTeams();

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
