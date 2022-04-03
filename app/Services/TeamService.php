<?php

namespace App\Services;

use App\Repositories\TeamRepository;

class TeamService
{
    public function __construct(TeamRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createTeam($name, $description)
    {
        $team_details = ['name' => $name, 'description' => $description];
        $result = $this->repository->createTeam($team_details);

    	return $result;
    }

    public function isTeamExistsByName($team_name)
    {
        $result = $this->repository->getTeamByName($team_name);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function isTeamExistsById($team_id)
    {
        $result = $this->repository->getTeamById($team_id);
    	
    	if ($result) {
    		return true;
    	} else {
    		return false;
    	}
    }

    public function getAllTeams()
    {
        return $this->repository->getAll();
    }
}
