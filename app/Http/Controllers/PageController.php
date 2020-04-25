<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\Answer;

class PageController extends BaseController
{
    //
    public function honePage() {
        $questions = Question::orderBy('id', 'DESC')->paginate(12);
    	return view("front.home-page")->with(['questions' => $questions]);
    }

    public function login() {
        return view('front.login')->with(['page' => 'Đăng nhập','id'=> 'non-id']);
    }

    public function postLogin(Request $rq) {
        $login = [
            'name' => $rq->username,
            'password' => $rq->password,
        ];
        if (Auth::attempt($login)) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with('status', 'Username hoặc Password không chính xác');
        }
    }


    public function addQuestion(Request $rq) {
        $question = new Question;
        $question->gender = $rq->gender;
        $question->question = $rq->question;

        $image = null;
        if($rq->file('img') != null) {
            $image = "data:image/png;base64, " . base64_encode(file_get_contents($rq->file('img')));
        }
        $question->img = $image;
        $question->save();
        return redirect("/")->with(["message" => "Đã hỏi Biên rồi, theo dõi để nhận được câu trả lời từ Biên nha ^^"]);
    }

    
}
