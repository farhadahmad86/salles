<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function _construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('pages.chats');
    }
    public function fetchMessages(){
        return Message::with('user')->get();
    }
    public function sendMessage(Request $request){
        $message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);
        broadcast(new MessageSent($message->load('user')))->toOthers();
        return ['status' => 'Success'];
    }
}
