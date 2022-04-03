<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\NoteService;
use App\Services\UserService;
use App\Services\NoteUserTagService;

class NoteController extends Controller
{
    function __construct(NoteService $service, UserService $userService, NoteUserTagService $tagService)
    {
        $this->service      = $service;
        $this->userService  = $userService;
        $this->tagService   = $tagService;
    }
    /**
     * To create a note
     */
    public function createNote(Request $request)
    {
        // default settings
        $result   = [];
        $response = [];

        // check if user exists or not, if not return failed response
        $is_user_exists = $this->userService->isUserExistsById($request->created_user_id);
        if (!$is_user_exists) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.user_not_exists'),
            ];
            return response()->json($response, 200);
        }

        // if all good, create note
        $result = $this->service->createNote($request->title, $request->description, $request->created_user_id);

        // create response
        if ($result) {
            $response = [
                'code'    => config('api.code.success'),
                'message' => Lang::get('message.success'),
                'data'    => $result,
            ];
        } else {
            $result = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.failed'),
            ];
        }

        return response()->json($response, 200);
    }

    /**
     * To delete a specific note
     */
    public function deleteNote(Request $request)
    {
        // default settings
        $result   = [];
        $response = [];

        // check if note exists or not, if not return failed response
        $is_note_exists = $this->service->isNoteExistsById($request->note_id);
        if (!$is_note_exists) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.note_not_exists'),
            ];
            return response()->json($response, 200);
        }

        // if all good, delete note
        $result = $this->service->deleteNote($request->note_id);

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
     * To tag or assign a specic note to a user
     */
    public function tagNoteToUser(Request $request)
    {
        // default settings
        $result   = [];
        $response = [];

        // check if note exists or not, if not return failed response
        $note = $this->service->getNoteById($request->note_id);
        if (!$note) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.note_not_exists'),
            ];
            return response()->json($response, 200);
        }

        // check if tagged user exists or not, if not return failed response
        $tagged_user = $this->userService->getUserById($request->user_id);
        if (!$tagged_user) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.user_not_exists'),
            ];
            return response()->json($response, 200);
        }

        // check if user assigning note to the same team member user or not, if not send failed response
        $created_user = $this->userService->getUserById($note->created_user_id);
        if ($created_user->team_id != $tagged_user->team_id) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.cross_team_tag_not_allowed'),
            ];
            return response()->json($response, 200);
        }

        // check if note is already assigned to the user, if yes send failed response
        $is_tag_exists = $this->tagService->isTagExistsByUserIdAndNoteId($request->user_id, $request->note_id);
        if ($is_tag_exists) {
            $response = [
                'code'    => config('api.code.failed'),
                'message' => Lang::get('message.tag_already_exists'),
            ];
            return response()->json($response, 200);
        }

        // if all good, create note user tag
        $result = $this->tagService->createTag($request->user_id, $request->note_id);

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
     * To get all available notes
     */
    public function getAllNotes()
    {
        // default settings
        $result   = [];
        $response = [];

        // get all users
        $result = $this->service->getAllNotes();

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
     * To get all available note user tags
     */
    public function getAllTags()
    {
        // default settings
        $result   = [];
        $response = [];

        // get all users
        $result = $this->tagService->getAllTags();

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
