<?php

namespace App\Modules\Note\Http\Controllers;

use App\Modules\Note\Models\Note;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function edit(){
        $user_id = Auth::user()->id;

        $note = Note::where('user_id', '=', $user_id)->first();

        if(!$note){
            $note = Note::updateOrCreate(['user_id'=>$user_id], ['text'=>'Текст заметки']);
        }

        $data = [
            'note' => $note
        ];

        return view('note::edit', $data);
    }

    public function post_edit(Request $request){
        $user_id = Auth::user()->id;

        $request_all = $request->all();

        $messages = [
            'required' => 'Поле <b>:attribute</b> должно быть заполнено!',
        ];

        $niceNames = [
            'text' => 'Текст заметки'
        ];

        $this->validate($request, [
            'text' => 'required',
        ], $messages, $niceNames);

        $text = $request_all['text'];

        Note::updateOrCreate(['user_id'=>$user_id], ['text'=>$text]);

        return redirect()->route('admin.notes.edit')->with('message', trans('note::note.message_edit'));
    }
}
