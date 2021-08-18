<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Forms;
use App\Jobs\MailJob;

class ContactFormController extends Controller
{

    function showAll($key=null){

        if($key != null){

            $data =Forms::where('message','LIKE','%'.$key.'%')->paginate(10);
            return $data;

        }else {

            $data = Forms::paginate(10);
            return $data;
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $form = new Forms;
        $form->name = $request->name;
        $form->email = $request->email;
        $form->message = $request->message;
        $form->save();

        dispatch(new \App\Jobs\MailJob($form));

        return ["RESULT " =>"SAVED"];
    }

    public function showMessage($id)
    {

        $data = Forms::find($id);

        return $data;

    }

    public function deleteMessage($id)
    {

        $data = Forms::find($id);
        $data->delete();

        return ["RESULT " =>"DELETED"];

    }
}
