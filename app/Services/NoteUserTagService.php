<?php

namespace App\Services;

use App\Repositories\NoteUserTagRepository;

class NoteUserTagService
{
    public function __construct(NoteUserTagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createTag($user_id, $note_id)
    {
        $tag_details = ['user_id' => $user_id,'note_id' => $note_id];
        $result = $this->repository->createTag($tag_details);

        return $result;
    }

    public function isTagExistsByUserIdAndNoteId($user_id, $note_id)
    {
        $result = $this->repository->getTagByUseridAndNoteId($user_id, $note_id);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllTags()
    {
        return $this->repository->getAll();
    }
}
