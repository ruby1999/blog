<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Post;
use Session;

/*use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;*/

class PagesController extends Controller
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getAbout(){
        //return ("hello");
        $first = 'Lin';
        $last = 'YiJin';
        //$fullname = $first . $last ;
        $fullname = $last ;
        $birthday = '88/02/20';
        $age = '21';

        $data = [] ;
        $data['birthday'] = $birthday ;
        $data['age'] = $age;

        return view('pages/about')->withFullName($fullname)->withData($data);
    }

    public function getHome(){
        //return ("hello");
        $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
        return view('pages/welcome')->withPosts($posts);
    }

    public function getContact() {
		return view('pages/contact');
    }
    
    //--傳送聯絡我的mail
	public function postContact(Request $request) {
		$this->validate($request, [
			'email' => 'required|min:3',
			'subject' => 'required|min:3',
			'message' => 'required|min:10']);

		$data = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message
			);

        //--讀取emails/contact
        //--把上面$data塞入function($message)
		Mail::send('emails.contact', $data, function($message) use ($data){
			$message->from($data['email']);
			$message->to('hello@devmarketer.io');
			$message->subject($data['subject']);
		});

		Session::flash('success', 'Your Email was Sent!');

		return redirect('/');
	}
}