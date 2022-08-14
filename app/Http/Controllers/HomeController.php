<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function contact_form_submit(Request $request)
    {

        try {
            $mail_data['name'] = $request->name;
            $mail_data['email_user'] = $request->usermail;
            $mail_data['msg'] = $request->message;
            $mail_data['email'] = "waheedbajeed@gmail.com";
            Mail::send('mail.send_email', $mail_data, function ($message) use ($mail_data) {
                $message->to($mail_data['email'])->subject('Portfolio Contact Us Form Submission');
            });
            Session::flash('msg4', "Your request has been sent successfully! You will be contacted soon. Thanks");
            return redirect()->back();
        } catch (\Exception $e) {
            //             dd($e->getMessage());
            Session::flash('msg3', "Your  request cannot sent. Please try again");
            return redirect()->back();
        }
    }
}
