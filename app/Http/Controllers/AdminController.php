<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Question; 
use App\User;
use App\Answer; 

class AdminController extends Controller
{
    //
	public function Dashboard() {
		$question = Question::orderBy('id','DESC')->paginate(12);
		return view("Admin.dashboard")->with(["questions"=> $question]);
	}

	//================= postAnswer ===================
	public function postAnswer(Request $rq) {
		$answer = new Answer;
		$answer->answer = $rq->answer;
		$answer->question_id = $rq->questionId;
		$answer->save();
		echo $answer->answer;
	}

	// ===================== change pass
	function getChangePassword() {
        return view('admin.changePassword');
    }

    function postChangePassword(request $rq) {
        $user = User::find(1);

        if($rq->newPassword == $rq->retype) {
            $user->password = bcrypt($rq->newPassword);
            $user->save();
            return redirect('admin/dashboard')->with(['thongbao'=> 'Đổi mật khẩu thành công']);
        } else {
            return back()->with(['thongbao' => 'Bạn nhập không đúng']);
        }
    }
	// ===================== post type (all below code is not use, but it don't remove, you will need them in the future)======================
	public function PostTypes() {
		$postType = Post_Type::orderBy('id','desc')->paginate(8) ;
		return view("Admin.postType.post_type")->with(["postType" => $postType]);
	}

	public function getAddPostType() {
		return view('Admin.postType.post_type_add');
	}


	public function postAddPostType(Request $rq) {
		$type = new Post_Type;
		if($rq->type_name == null || $rq->description == null) {
			return redirect("admin/post-types")->with(["message" => "Add new Post Type failed!"]);
		}
		$type->type_name = $rq->type_name;
		$type->description = $rq->description;
		$type->save();
		return redirect("admin/post-types")->with(["message" => "Add new Post Type successfully!"]);
	}

	public function getEditPostType($id) {
		$type = Post_Type::find($id);
		return view('Admin.postType.post_type_edit')->with(['type' => $type]);
	}

	public function postEditPostType(Request $rq, $id) {
		$type = Post_Type::find($id);
		if($rq->type_name == null || $rq->description == null) {
			return redirect("admin/post-types")->with(["message" => "Edit Post Type failed!"]);
		}
		$type->type_name = $rq->type_name;
		$type->description = $rq->description;
		$type->save();
		return redirect("admin/post-types")->with(["message" => "Edit Post Type successfully!"]);
	}

	// ======================= post
	


	public function postAddPost(Request $rq) {
		$post = new Post;
		if($rq->type_id == null || $rq->title == null || $rq->sub_content == null || $rq->content == null) {
			return redirect("admin/posts")->with(["message" => "Add Post failed!"]);
		}
		$post->type_id = $rq->type_id;
		$post->title = $rq->title;
		$post->sub_content = $rq->sub_content;
		$post->content = $rq->content;

		$image = null;
		if($rq->file('img') != null) {
		$image = "data:image/png;base64, " . base64_encode(file_get_contents($rq->file('img')));
			}
	    $post->img = $image;
		$post->save();
		return redirect("admin/posts")->with(["message" => "Add new Post Type successfully!"]);
	}

	public function getEditPost($id) {
		$post = Post::find($id);
		$types = Post_Type::all();
		return view('Admin.post.post_edit')->with(['type' => $types,'post' => $post]);
	}

	public function postEditPost(Request $rq, $id) {
		$post = Post::find($id);
		if($rq->type_id == null || $rq->title == null || $rq->sub_content == null || $rq->content == null) {
			return redirect("admin/posts")->with(["message" => "Add Post failed!"]);
		}
		$post->type_id = $rq->type_id;
		$post->title = $rq->title;
		$post->sub_content = $rq->sub_content;
		$post->content = $rq->content;

		if($rq->file('img') != null) {
			$image = "data:image/png;base64, " . base64_encode(file_get_contents($rq->file('img')));
			$post->img = $image;
		}
	    
		$post->save();
		return redirect("admin/posts")->with(["message" => "Edit Post successfully!"]);
	}

	public function getLogout()
    {
        Auth::logout();
        return redirect("login");
    }
}
