<?php

namespace App\Http\Controllers;

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
    public function getContact(){
        //return ("hello");
        return view('pages/contact');
    }
    public function getHome(){
        //return ("hello");
        return view('pages/welcome');
    }
}