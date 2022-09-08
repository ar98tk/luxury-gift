<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Alert;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        if ($message->status == 'Unread') {
            $message->status = 'Read';
            $message->update();
        }
        return view('admin.messages.show', compact('message'));
    }

    public function store(Request $request)
    {
        $emails = explode(',', $request->emails);
        $validate = Validator::make($request->all(), [
            'emails' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors( $validate->messages());
        }
        foreach ($emails as $e) {
            $email['subject'] = $request->subject;
            $email['message'] = $request->message;
            Mail::to($e)
                ->send(new SendEmail($email));
        }
        Alert::success('Message Sent Successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        Alert::success('Message Deleted Successfully.');
        return redirect()->back();
    }
}
