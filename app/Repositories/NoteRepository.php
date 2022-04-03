<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class NoteRepository
{
    public function createNote($note_details)
    {
        try {
            return Note::create($note_details);
        } catch (QueryException $e) {
            Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
        }
    }

    public function getNotebyId($note_id)
    {
        try {
            return Note::where('id', $note_id)->first();
        } catch (QueryException $e) {
            Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
        }
    }

    public function deleteNote($note_id)
    {
        try {
            return Note::destroy($note_id);
        } catch (QueryException $e) {
            Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
        }
    }

    public function getAll()
    {
        return Note::all();
    }
}
