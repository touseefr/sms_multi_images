<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\file;
//use UxWeb\SweetAlert\Facades\Alert;
use Alert;

class SmsController extends Controller
{
    public function sms(Request $request)
    {
        if ($request->isMethod("post")) {
            //alert()->success('asdsad')->persistent('Close')->autoclose(2000);
            //  Alert::success('this is success alert');
            //  return back();
            $active = $request->checkbox == 'on' ? 1 : 0;


            dd($active);
            //return $request;
            //twilio start here....
            $to = $request->phone;
            $from = getenv("TWILIO_FROM");
            $message = $request->msg;
            //open connection

            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERPWD, getenv("TWILIO_SID") . ':' . getenv("TWILIO_TOKEN"));
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_URL, sprintf('https://api.twilio.com/2010-04-01/Accounts/' . getenv("TWILIO_SID") . '/Messages.json', getenv("TWILIO_SID")));
            curl_setopt($ch, CURLOPT_POST, 3);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'To=' . $to . '&From=' . $from . '&Body=' . $message);

            // execute post
            $result = curl_exec($ch);
            $result = json_decode($result);

            // close connection
            curl_close($ch);
            //Sending message ends here
            return [$result];
        }
        return view('sms');
    }

    public function create()
    {
        return view('imageUpload');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'filenames' => 'required',
            'filenames.*' => 'image'
        ]);

        $files = [];
        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }

        $file = new File();
        $file->filenames = $files;
        $file->save();

        return back()->with('success', 'Your images has been successfully added');
    }
}
