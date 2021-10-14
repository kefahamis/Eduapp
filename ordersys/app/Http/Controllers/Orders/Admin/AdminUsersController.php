<?php

namespace App\Http\Controllers\Orders\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Writer;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    //
	public function __construct()
	{
		$this->folder = 'orders.main.';
	}

	public function myUsers(){
		$users = User::where('level','customer')->paginate(10);
		return view($this->folder.'client-details',[
			'users' => $users
		]);
	}

	public function clientDetails(){
		$users = User::where('level','customer')->paginate(10);
		return view($this->folder.'client-details',[
			'users' => $users
		]);
	}

	public function writerDetails(){
		$users = User::where('level','writer')->paginate(10);
		return view($this->folder.'writer-details',[
			'users' => $users
		]);
	}

    public function createWriter(Request $request){
        \request()->validate([
            'full_name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required',
            'profile_summary' => 'required',
            'skills' => 'required',
            'rating' => 'required',
            'finished_papers' => 'required'
        ]);
        $validate = User::where('email',$request->email)->first();
        if($validate){
            return redirect()->back()->with('error','User with this email already exists');
        }
        $user = new User;
        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = 'writer';
        $user->url_prefix = 'writer';
        $user->save();

        $writer = new Writer;
        $writer->user_id = $user->id;

        $track = Writer::max('writer_code');
        $writer_code = 3001;
        if ($track) {
            $writer_code = $track + 1;
            $track_check = Writer::where('writer_code',$writer_code)->first();
            if ($track_check) {
                do{
                    $writer_code = $track + 1;
                    $track_check = Writer::where('writer_code',$writer_code)->first();
                }while(!$track_check);
            }
        }else{
            $writer_code = 3001;
        }
        $writer->writer_code = $writer_code;
        $writer->rating = $request->rating;
        $writer->profile_summary = $request->profile_summary;
        $writer->skills = $request->skills;
        $writer->finished_papers = $request->finished_papers;
        $writer->save();

        return redirect()->back()->with('success', 'Writer created successfuly');
    }

    public function editWriter(Request $request){
        $writer = Writer::where('writer_code',$request->writer_code)->first();
        if (!$writer) {
            return redirect(url_prefix().'/');
        }
        return view($this->folder.'edit-writer',[
            'writer' => $writer
        ]);
    }

    public function saveWriter(Request $request){
     \request()->validate([
        'full_name' => 'required|string',
        'email' => 'required|string',
        'profile_summary' => 'required',
        'skills' => 'required',
        'rating' => 'required',
        'finished_papers' => 'required'
    ]);

     $writer = Writer::where('writer_code',$request->writer_code)->first();
     if(!$writer){
        return redirect()->back()->with('error','Writer does not exist.');
    }
    $user = $writer->user;
    $user->name = $request->full_name;
    $user->email = $request->email;
    if ($request->password != '') {
        $user->password = Hash::make($request->password);
    }
    $user->save();

    $writer->rating = $request->rating;
    $writer->profile_summary = $request->profile_summary;
    $writer->skills = $request->skills;
    $writer->finished_papers = $request->finished_papers;
    $writer->save();
    return redirect()->back()->with('success','Writer updated successfuly.');
}

}
