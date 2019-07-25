<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\User;
use App\Admin;
use App\Visitor;
use App\Notifications\GuestRequest;

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
            'fullname' => 'required',
            'gender' => 'required',
        ]);

        $user = User::find(auth()->user()->id);
        $data = [
            'fullname' => $request->fullname,
            'gender' => $request->gender,
        ];
        $refNumber = Str::random(12);
        if($user->visitors()->create($data)){
            
            $admins = Admin::where('role', 2)->get();
            $data = [
                'type' => 'request',
                'msg' => 'Guest request',
                'staff' => auth()->user()->firstname.' '.auth()->user()->firstname,
                'office' => auth()->user()->office,
                'staff_id' => auth()->user()->id,
                'refNumber' => $refNumber
            ];

            foreach ($admins as $admin) {
                $admin->notify(new GuestRequest($data));
            }

            return back()->with('success', 'Request submitted successfully!');

        }
    }

    public function deleteRequest(Request $request){
        $item = User::find(auth()->user()->id);
        if($item->visitors()->where('id', $request->deleterequestid)->delete()){
            return back()->with('success', 'Request deleted successfully!');
        }
    }

    // LOAD NOTIFICATION
    public function loadNotification($count){
        if(auth()->user()->unreadNotifications->count() > 0){
            if(auth()->user()->unreadNotifications->count() > $count){
                return Response()->json(['newCount' => auth()->user()->unreadNotifications->count(), 'data' => auth()->user()->unreadNotifications->first(), 'greater' => true, 'less' => false]);
            }elseif(auth()->user()->notifications->count() < $count){
                return Response()->json(['newCount' => auth()->user()->unreadNotifications->count(), 'data' => auth()->user()->unreadNotifications->first(), 'greater' => false, 'less' => true]);
            }else{
                return Response()->json(['newCount' => auth()->user()->unreadNotifications->count(), 'data' => auth()->user()->unreadNotifications->first(), 'greater' => false, 'less' => false]);
            }
        }else{
            return Response()->json(['newCount' => 0, 'greater' => false, 'less' => false]);
        }
    }
}
