<?php

namespace App\Repositories;

use App\Models\NoteUserTag;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class NoteUserTagRepository
{
    public function createTag($tag_details)
    {
    	try {
    		return NoteUserTag::create($tag_details);
        } catch (QueryException $e) {
    		Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
    	}   
    }

    public function getTagByUserIdAndNoteId($user_id, $note_id)
    {
        try {
            return NoteUserTag::where('user_id', $user_id)->where('note_id', $note_id)->first();
        } catch (QueryException $e) {
            Log::channel('note_tag_service')->error($e->getMessage()); // log exception message to custom log
        }
    }

    public function getAll()
    {
        return NoteUserTag::all();
    }
}
