<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Admin;
use App\Visitor;
use Hash;
use Carbon\Carbon;
use App\Notifications\GateApproval;
use App\Notifications\ReceptionApproval;
use Yajra\Datatables\Datatables;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $data = [
            'allVisitors' => User::with('visitors')->orderBy('id', 'DESC')->paginate(7),
            'allReceptionVisitors' => User::where(['block' => auth()->user()->block])->with('visitors')->get()
        ];
        // dd($data['allReceptionVisitors']);
        return view('auth.admin.dashboard')->with('data', $data);
    }
    
    
    public function printGateGuestList(){
        return view('auth.admin.printGuestList');
    }
    public function getGateGuestList()
    {
        $visitors = Visitor::with('user')
            ->where('status', '>', 0)
            ->whereDate('verifiedAtGate', '=', Carbon::today()->toDateString())
            ->get();
        return Datatables::of($visitors)
        ->editColumn('created_at', function ($visitor) {
            return $visitor->created_at->toDayDateTimeString();
        })
        ->editColumn('userFullname', function ($visitor) {
            return $visitor->user->firstname.' '.$visitor->user->lastname;
        })
        ->make();
    }

    // APPROVE AT GATE
    public function approveGate(Request $request){
        if($request->isMethod('put')){
            $visitor = Visitor::find($request->approverequestid);
            $visitor->status = 1;
            $visitor->processedBy = auth()->user()->id;
            $visitor->verifiedAtGate = Carbon::now();

            $refNumber = Str::random(12);
            if($visitor->save()){

                $staff = User::find($visitor->user_id);
                $data = [
                    'type' => 'approval',
                    'status' => true,
                    'msg' => $visitor->fullname.' has been approved at gate',
                    'admin' => auth()->user()->firstname.' '.auth()->user()->lastname,
                    'staff' => auth()->user()->firstname.' '.auth()->user()->lastname,
                    'office' => auth()->user()->office,
                    'admin_id' => auth()->user()->id,
                    'refNumber' => $refNumber
                ];
                $staff->notify(new GateApproval($data));

                $admin = Admin::where(['block' => $staff->block, 'role' => 3])->first();
                $admin->notify(new GateApproval($data));
    
                return back()->with('success', 'Request approved!');
            }
        }
        else{
            return back();
        }
    }
    // DECLINE AT GATE
    public function declineGate(Request $request){
        if($request->isMethod('put')){
            $visitor = Visitor::find($request->declinerequestid);
            $visitor->status = 3;
            $visitor->processedBy = auth()->user()->id;
            $visitor->verifiedAtGate = Carbon::now();

            $refNumber = Str::random(12);
            if($visitor->save()){

                $staff = User::find($visitor->user_id);
                $data = [
                    'type' => 'decline',
                    'status' => false,
                    'msg' => $visitor->fullname.' has been declined at gate',
                    'admin' => auth()->user()->firstname.' '.auth()->user()->firstname,
                    'admin_id' => auth()->user()->id,
                    'refNumber' => $refNumber
                ];
                $staff->notify(new GateApproval($data));

                return back()->with('success', 'Request Cancelled!');
            }
        }
        else{
            return back();
        }
    }


    // APPROVE AT RECEPTION
    public function approveReception(Request $request){
        if($request->isMethod('put')){
            $visitor = Visitor::find($request->approverequestid);
            $visitor->status = 2;
            $visitor->processedBy = auth()->user()->id;
            $visitor->verifiedAtReception = Carbon::now();

            $refNumber = Str::random(12);
            if($visitor->save()){

                $staff = User::find($visitor->user_id);
                $data = [
                    'type' => 'approval',
                    'status' => true,
                    'msg' => $visitor->fullname.' has been approved at reception',
                    'admin' => auth()->user()->firstname.' '.auth()->user()->firstname,
                    'admin_id' => auth()->user()->id,
                    'refNumber' => $refNumber
                ];
                $staff->notify(new ReceptionApproval($data));
                return back()->with('success', 'Request approved!');
            }
        }
        else{
            return back();
        }
    }
    // DECLINE AT RECEPTION
    public function declineReception(Request $request){
        if($request->isMethod('put')){
            $visitor = Visitor::find($request->declinerequestid);
            $visitor->status = 3;
            $visitor->processedBy = auth()->user()->id;
            $visitor->verifiedAtReception = Carbon::now();

            $refNumber = Str::random(12);
            if($visitor->save()){

                $staff = User::find($visitor->user_id);
                $data = [
                    'type' => 'decline',
                    'status' => false,
                    'msg' => $visitor->fullname.' has been declined at reception',
                    'admin' => auth()->user()->firstname.' '.auth()->user()->firstname,
                    'admin_id' => auth()->user()->id,
                    'refNumber' => $refNumber
                ];
                $staff->notify(new ReceptionApproval($data));

                return back()->with('success', 'Request Cancelled!');
            }
        }
        else{
            return back();
        }
    }


    // MANAGE ADMIN STAFFS
    public function manageGateReceptionStaff(){
        $data = [
            'allAdmins' => Admin::orderBy('id', 'DESC')->paginate(7)
        ];
        return view('auth.admin.manageGateReceptionStaff')->with('data', $data);
    }
    // ADD NEW ADMIN STAFF
    public function addNewAdmin(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required',
            'role' => 'required',
            'block' => 'required'
        ]);

        $admin = Admin::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gl' => $request->gl,
            'step' => $request->step,
            'rank' => $request->rank,
            'position' => $request->position,
            'designation' => $request->designation,
            'role' => $request->role,
            'block' => $request->block,
            'office' => $request->office
        ]);

        if($admin){
            return back()->with('success', 'Staff added successfully');
        }
    }
    // ADD NEW GENERAL STAFF
    public function addNewStaff(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'block' => 'required'
        ]);

        $staff = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gl' => $request->gl,
            'step' => $request->step,
            'rank' => $request->rank,
            'position' => $request->position,
            'designation' => $request->designation,
            'block' => $request->block,
            'office' => $request->office
        ]);

        if($staff){
            return back()->with('success', 'Admin added successfully');
        }
    }


    public function manageGeneralStaff(){
        $data = [
            'allStaffs' => User::orderBy('id', 'DESC')->paginate(7)
        ];
        return view('auth.admin.manageGeneralStaff')->with('data', $data);
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
    
    // CLEAR NOTIFICATION
    public function clearNotification(){

        $admin = Admin::find(auth()->user()->id);
        foreach ($admin->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return response()->json(['status' => true]);
    }

}
