<?php

namespace App\Contracts;

interface NoteInterface
{
    public function getAllNotes( );

    public function getCategory();
    
    public function postNoteEdit($id,$data);
}