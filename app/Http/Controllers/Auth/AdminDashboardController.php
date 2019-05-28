<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Visitor;
use Hash;
use Carbon\Carbon;
class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $data = [
            'allVisitors' => $visitors = User::with('visitors')->paginate(6),
            'allReceptionVisitors' => $visitors = User::where(['block' => auth()->user()->block])->with('visitors')->paginate(6)
        ];
        // return $data['allVisitors'];
        return view('auth.admin.dashboard')->with('data', $data);
    }

    // APPROVE AT GATE
    public function approveGate(Request $request){
        if($request->isMethod('put')){
            $visitor = Visitor::find($request->approverequestid);
            $visitor->status = 1;
            $visitor->processedBy = auth()->user()->id;
            $visitor->verifiedAtGate = Carbon::now();
            if($visitor->save()){
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
            if($visitor->save()){
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
            if($visitor->save()){
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
            if($visitor->save()){
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
            'allAdmins' => Admin::paginate(6)
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
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'block' => 'required'
        ]);

        $staff = User::create([
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
            'block' => $request->block,
            'office' => $request->office
        ]);

        if($staff){
            return back()->with('success', 'Admin added successfully');
        }
    }




    public function manageGeneralStaff(){
        $data = [
            'allStaffs' => User::paginate(6)
        ];
        return view('auth.admin.manageGeneralStaff')->with('data', $data);
    }

}
