<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class MailSettingController extends Controller
{
    public function index(){
        return view('backend.mail_settings.index');
    }


    public function update(Request $request){
        try {

            saveRuntimeConfig('mail_mailer', $request->mail_mailer);
            saveRuntimeConfig('mail_host', $request->mail_host);
            saveRuntimeConfig('mail_port', $request->mail_port);
            saveRuntimeConfig('mail_username', $request->mail_username);
            saveRuntimeConfig('mail_password', $request->mail_password);
            saveRuntimeConfig('mail_encryption', $request->mail_encryption);
            saveRuntimeConfig('mail_from_address', $request->mail_from_address);
            saveRuntimeConfig('mail_from_name', $request->mail_from_name);
            Artisan::call('optimize:clear');
           
            Toastr::success('Saved successfully.',__('message.success'));
            return redirect()->back();
            
        } catch (\Throwable $th) {
            Toastr::error(__('income.error_msg'),__('message.error'));
            return redirect()->back();
        }
    }

    public function sendTestMail(Request $request){
        $request->validate([
            'email'  =>['required','email']
        ]);
       
        try {      
            Mail::to($request->email)->send(new TestMail());
            Toastr::success('Sended successfully.',__('message.success'));
            return redirect()->back();
        } catch (\Throwable $th) {
        
            Toastr::error('Invalid mail configuration','Error');
            return redirect()->back();
        }
    }
}
