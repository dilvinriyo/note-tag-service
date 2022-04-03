<?php

namespace App\Services;

use App\Repositories\NoteRepository;

class NoteService
{
    public function __construct(NoteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createNote($title, $description, $created_user_id)
    {
        $note_details = ['title'=> $title,'description' => $description, 'created_user_id' => $created_user_id];
        $result = $this->repository->createNote($note_details);

        return $result;
    }

    public function isNoteExistsById($note_id)
    {
        $result = $this->repository->getNotebyId($note_id);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteNote($note_id)
    {
        $result = $this->repository->deleteNote($note_id);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getNoteById($note_id)
    {
        $result = $this->repository->getNotebyId($note_id);

        return $result;
    }

    public function getAllNotes()
    {
        return $this->repository->getAll();
    }
}
