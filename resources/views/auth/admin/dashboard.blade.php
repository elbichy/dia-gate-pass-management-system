@extends('layout.admin')


{{-- ADMIN CONTENT --}}
@section('adminContent')
    <div class="dashboardWrap row">
        <div class="admins">
            <h5 class="col s12 center white-text" style="margin:0">Super Admin</h5>
        </div>
    </div>
@endsection


{{-- GATE CONTENT --}}
@section('gateContent')
    <div class="dashboardWrap row">
        <div class="admins">
            <h5 class="col s12 center white-text" style="margin:0">Gate Staff</h5>
            <div class="expected col s12 m7 l7">
                <table class="highlight centered  z-depth-2">
                    <thead>
                        <tr>
                            <h6 style="text-align:center; color:white;">Expected Guests Today</h6>
                        </tr>
                        <tr class="blue-text">
                            <th>Staff</th>
                            <th>Building</th>
                            <th>Guest</th>
                            <th>Gender</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
            
                    <tbody id="requestsApproval">
                    @foreach($data['allVisitors'] as $visitor)
                            @if($visitor != NULL && $visitor->status == 0 && $visitor->created_at->format('d-m-Y') == Carbon\Carbon::now()->format('d-m-Y'))
                            <tr>
                                <td>{{$visitor->user->firstname.' '.$visitor->user->lastname}}</td>
                                <td>{{$visitor->user->block}}</td>
                                <td>{{$visitor->fullname}}</td>
                                <td>{{$visitor->gender}}</td>
                                <td><a href="#" data-requestid="{{$visitor->id}}" class="approveRequest btn btn-small waves-effect waves-light green">Approve</a></td>
                                <form action="{{url('admin/approveGate')}}" method="post" name="approveRequestForm" id="approveRequestForm">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="approverequestid" id="approverequestid">
                                </form>
                                <td><a href="#" data-requestid="{{$visitor->id}}" class="declineRequestbtn btn-small waves-effect waves-light  red">Decline</a></td>
                                <form action="{{url('admin/declineGate')}}" method="post" name="declineRequestForm" id="declineRequestForm">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="declinerequestid" id="declinerequestid">
                                </form>
                                {{-- <td><a href="#modal1" class="white-text btn green waves-effect waves-light btn modal-trigger">View</a></td> --}}
                            </tr>
                            @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="authenticated col s12 m5 l5">
                <table class="highlight centered  z-depth-2">
                    <thead>
                        <tr>
                            <h6 style="text-align:center; color:white;">Screened Guests Today</h6>
                        </tr>
                        <tr class="blue-text">
                            <th>Personnel</th>
                            <th>Guest</th>
                            <th>Status</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody id="requestsApprovalHistory">
                        @foreach($data['allVisitors'] as $visitor)
                                @if($visitor->status > 0 && $visitor->created_at->format('d-m-Y') == Carbon\Carbon::now()->format('d-m-Y'))
                                <tr>
                                    <td>{{$visitor->user->firstname.' '.$visitor->user->lastname}}</td>
                                    <td>{{$visitor->fullname}}</td>
                                    <td>
                                        @if($visitor->status == 1)
                                            <span class="orange-text">Cleared @ Gate</span>
                                        @elseif($visitor->status == 2)
                                            <span class="green-text">Cleared!</span>
                                        @elseif($visitor->status == 3)
                                            <span class="red-text">Declined</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($visitor->created_at)->diffForHumans() }}</td>
                                </tr>
                                @endif
                        @endforeach
                    </tbody>
                </table>
                {{$data['allVisitors']->links('vendor.pagination.materializecss')}}
            </div>
        </div>
    </div>
@endsection


{{-- RECEPTION CONTENT --}}
@section('receptionContent')
    <div class="dashboardWrap row">
        <div class="admins">
            <h5 class="col s12 center white-text" style="margin:0">Reception Staff ({{auth()->user()->block}})</h5>
            <div class="expected col s12 m8 l8">
                <table class="striped highlight centered  z-depth-2">
                    <thead>
                        <tr>
                            <h6 style="text-align:center; color:white;">Expected Guests Today</h6>
                        </tr>
                        <tr class="blue-text">
                            <th>Staff</th>
                            <th>Building</th>
                            <th>Guest</th>
                            <th>Gender</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
            
                    <tbody id="requestsApproval">
                    @foreach($data['allVisitors'] as $visitor)
                            @if($visitor != NULL && $visitor->status == 1 && $visitor->created_at->format('d-m-Y') == Carbon\Carbon::now()->format('d-m-Y'))
                            <tr>
                                <td>{{$visitor->user->firstname.' '.$visitor->lastname}}</td>
                                <td>{{$visitor->user->block}}</td>
                                <td>{{$visitor->fullname}}</td>
                                <td>{{$visitor->gender}}</td>
                                <td><a href="#" data-requestid="{{$visitor->id}}" class="approveRequestReception btn btn-small waves-effect waves-light green">Approve</a></td>
                                <form action="{{url('admin/approveReception')}}" method="post" name="approveRequestReceptionForm" id="approveRequestReceptionForm">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="approverequestid" id="approverequestid">
                                </form>
                                <td><a href="#" data-requestid="{{$visitor->id}}" class="declineRequestReceptionbtn btn-small waves-effect waves-light  red">Decline</a></td>
                                <form action="{{url('admin/declineReception')}}" method="post" name="declineRequestReceptionForm" id="declineRequestReceptionForm">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="declinerequestid" id="declinerequestid">
                                </form>
                                {{-- <td><a href="#modal1" class="white-text btn green waves-effect waves-light btn modal-trigger">View</a></td> --}}
                            </tr>
                            @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="authenticated col s12 m4 l4">
                    <table class="striped highlight centered  z-depth-2">
                        <thead>
                            <tr>
                                <h6 style="text-align:center; color:white;">Screened Guests Today</h6>
                            </tr>
                            <tr class="blue-text">
                                <th>Personnel</th>
                                <th>Guest</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="requestsApprovalHistory">
                        @foreach($data['allVisitors'] as $visitor)
                                @if($visitor->status > 1 && $visitor->created_at->format('d-m-Y') == Carbon\Carbon::now()->format('d-m-Y'))
                                <tr>
                                    <td>{{$visitor->user->firstname.' '.$visitor->user->lastname}}</td>
                                    <td>{{$visitor->fullname}}</td>
                                    <td>
                                        @if($visitor->status == 1)
                                            <span class="orange-text">Cleared @ Gate</span>
                                        @elseif($visitor->status == 2)
                                            <span class="green-text">Cleared!</span>
                                        @elseif($visitor->status == 3)
                                            <span class="red-text">Declined</span>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                        @endforeach
                        </tbody>
                    </table>
                    {{ $data['allVisitors']->links('vendor.pagination.materializecss') }}
            </div>
        </div>
    </div>
@endsection


