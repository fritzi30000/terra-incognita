<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Background;
use App\Content;
use App\Mail;

class ContentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function we()
    {
        $content = Content::getByType('ABOUT');
        $background = Background::findOrFail(5);
        return view('frontend.content.we', ['content' => $content, 'background' => $background]);
    }

    public function support()
    {
        $content = Content::getByType('SUPPORT');
        $background = Background::findOrFail(4);
        return view('frontend.content.support', ['content' => $content, 'background' => $background]);
    }

    public function contact()
    {
        $content = Content::getByType('CONTACT');
        $background = Background::findOrFail(6);
        if (request()->get('send')) {
            if (request()->get('send') == 1) {
                $form = 'sent';
            } else {
                $form = 'error';
            }
        } else {
            $form = 'no';
        }
        return view('frontend.content.contact', ['content' => $content, 'background' => $background, 'form' => $form]);
    }

    public function contactSend()
    {
        $mail = new Mail;
        $mail->fill(request()->all());
        if ($mail->save()) {
            //wyslij mail
            return redirect('/kontakt?send=1');
        } else {
            return redirect('/kontakt?send=-1');
        }

    }

    public function media()
    {
        $content = Content::getByType('MEDIA');
        return view('frontend.content.media', ['content' => $content]);
    }

}
