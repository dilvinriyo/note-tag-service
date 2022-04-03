<?php

namespace App\Repositories;

use App\Models\Team;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class TeamRepository
{
    public function createTeam($team_details)
    {
    	try {
            return Team::create($team_details);
        } catch (QueryException $e) {
    		Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
    	}   
    }

    public function getTeamByName($team_name)
    {
    	try {
            return Team::where('name', $team_name)->first();
        } catch (QueryException $e) {
    		Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
    	}
    }

    public function getTeamById($team_id)
    {
        try {
            return Team::where('id', $team_id)->first();
        } catch (QueryException $e) {
            Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
        }
    }

    public function getAll()
    {
        return Team::all();
    }
}
