<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Visitor;
use Carbon\Carbon;
class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $data = [
            'allVisitors' => $visitors = User::where(['block' => auth()->user()->block])->with('visitors')->paginate(6)
        ];

        return view('auth.admin.dashboard')->with('data', $data);
    }

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

}
