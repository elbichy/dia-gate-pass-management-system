<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Visitor;
class PersonnelDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $data = [
            'allVisitors' => $visitors = Visitor::where('user_id', auth()->user()->id)->paginate(6),
            'todaysVisitors' => $visitors = Visitor::where('user_id', auth()->user()->id)
                                ->whereDate('created_at', Carbon::today())->paginate(6)
        ];
        
        // return $visitors;
        return view('auth.personnel.dashboard')->with('data', $data);
    }

    public function submitRequest(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = User::find(auth()->user()->id);
        $data = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        if($user->visitors()->create($data)){
            return back()->with('success', 'Request submitted successfully!');
        }
    }

    public function deleteRequest(Request $request){
        $item = User::find(auth()->user()->id);
        if($item->visitors()->where('id', $request->deleterequestid)->delete()){
            return back()->with('success', 'Request deleted successfully!');
        }
    }
}
