<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Http\Requests\NoteRequests;
use App\Services\NoteService;
use File;

class NotesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NoteService $noteService)
    {
      $notes = $noteService->getAllNotes(); 
        return view('notes.notes')->with('notes',$notes);
    }

    public function getCategory(NoteService $noteService){
        $category = $noteService->getCategory();
        return view('notes.add_notes')->with('category',$category);
    }

    public function addNotePost(NoteService $noteService,NoteRequests $request)
    {
       $notes = $noteService->addNotePost($request); 
       return redirect('/add_notes')
               ->with('message', 'Note Added Successfully');
    }
    public function postNoteEdit(NoteService $noteService,$id,NoteRequests $request){
        $noteService->postNoteEdit($id,$request);
        return redirect()->back();
        
    }

    public function getMyNotes(NoteService $noteService)
    {
       $notes = $noteService->getMyNotes();
       return view('notes.my_notes')->with('notes', $notes);
    }
    public function postGetNote(NoteService $noteService,$id,Request $request){
        
        $data = $noteService->postGetNote($id);
        return json_encode($data);
    }

    public function getNote(NoteService $noteService, $id)
    {
    
       $note = $noteService->getNote($id);
       if(!isset($note))
            return redirect()->back();
           
       return view('notes.edit_note')->with($note);
    }
    public function postNoteDelete(NoteService $noteService,Request $request){
        return $noteService->postNoteDelete($request->id);
    }



}
