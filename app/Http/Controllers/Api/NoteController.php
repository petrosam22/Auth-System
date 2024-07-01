<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Note;
class NoteController extends Controller
{
   public function index(){
    $user =Auth::user();
    return response()->json([
            
        'data'=>$user->notes,
        'message'=>'All Notes'
     ]);

    
   }
   public function store(Request $request){

    $note = Note::create([
        'title'=>$request->title,
        'description'=>$request->description,
        'user_id'=>Auth::user()->id

    ]);

    return response()->json([
            
        'data'=>$note,
        'message'=>'Note Created Successfully'
     ]);

   }


   public function showByID($id){

    $note = Note::where('id', $id)
    ->where('user_id', auth()->user()->id)
    ->firstOrFail();

// Update the note using the request data

// Return a response indicating the update was successful
return response()->json([
'note' => $note
]);

   }


   public function update(Request $request ,$id){

    $note = Note::where('id', $id)
    ->where('user_id', auth()->user()->id)
    ->firstOrFail();

// Update the note using the request data
    $note->update($request->all());

// Return a response indicating the update was successful
return response()->json([
'message' => 'Note updated successfully.',
'note' => $note
]);

   }
   public function delete($id){
    $note = Note::where('id', $id)
    ->where('user_id', auth()->user()->id)
    ->first();

if (!$note) {
return response()->json([
'message' => 'You are not authorized to delete this note or the note does not exist.',
], 403);
}

$note->delete();

return response()->json([
'message' => 'Note deleted successfully.',
]);

}
}
