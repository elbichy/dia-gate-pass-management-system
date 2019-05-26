@extends('layout.admin')

@section('content')

<!-- Modal Structure -->
{{-- <div id="modal1" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4>Gate pass request</h4>
    <div class="row">
        <fieldset>
            <legend><h6>PERSONNEL</h6></legend>
            <div class="col s12 m4 l4">
                <div class="input-field">
                    <div class="label">Fullname</div>
                    <div class="data">Suleiman Abdulrazaq</div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="input-field">
                    <div class="label">Gender</div>
                    <div class="data">Male</div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="input-field">
                    <div class="label">Rank</div>
                    <div class="data">Director</div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="input-field">
                    <div class="label">Block</div>
                    <div class="data">Annex Building</div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="input-field">
                    <div class="label">Office</div>
                    <div class="data">Technical Service</div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="input-field">
                    <div class="label">Label</div>
                    <div class="data">Director</div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="row">
        <fieldset>
            <legend><h6>VISITOR</h6></legend>
            <div class="col s12 m4 l4">
                <div class="input-field">
                    <div class="label">Fullname</div>
                    <div class="data">Suleiman Abdulrazaq</div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="input-field">
                    <div class="label">Gender</div>
                    <div class="data">Male</div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="input-field">
                    <div class="label">Phone</div>
                    <div class="data">08050811702</div>
                </div>
            </div>
        </fieldset>
    </div>
  </div>
  <div class="modal-footer">
    <li class="left">
        <button class="btn waves-effect waves-light green">Approve</button>
        <button class="btn waves-effect waves-light red">Decline</button>
    </li>
    <a href="#!" class="modal-close waves-effect btn-flat waves-green right">Close</a>
  </div>
</div> --}}

<div class="dashboardWrap row">
    <div class="admins">
        <div class="expected col s12 m8 l8">
            <table class="striped highlight centered responsive-table z-depth-2">
                <thead>
                    <tr>
                        <h5 style="text-align:center; color:white;">Expected Guests Today</h5>
                    </tr>
                    <tr class="blue-text" style="border-bottom:4px solid #2196f3">
                        <th>Staff</th>
                        <th>Building</th>
                        <th>Guest</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                </thead>
        
                <tbody>
                @foreach($data['allVisitors'] as $visitors)
                    @foreach($visitors->visitors as $visitor)
                        @if($visitor->status == 0 && $visitor->created_at->format('d-m-Y') == Carbon\Carbon::now()->format('d-m-Y'))
                        <tr>
                            <td>{{$visitors->firstname.' '.$visitors->lastname}}</td>
                            <td>{{$visitors->block}}</td>
                            <td>{{$visitor->firstname.' '.$visitor->lastname}}</td>
                            <td>{{$visitor->gender}}</td>
                            <td>{{$visitor->phone}}</td>
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
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="authenticated col s12 m4 l4">
                <table class="striped highlight centered responsive-table z-depth-2">
                    <thead>
                        <tr>
                            <h5 style="text-align:center; color:white;">Screened Today</h5>
                        </tr>
                        <tr class="blue-text" style="border-bottom:4px solid #2196f3">
                            <th>Personnel</th>
                            <th>Guest</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach($data['allVisitors'] as $visitors)
                    @foreach($visitors->visitors as $visitor)
                        @if($visitor->status > 0 && $visitor->created_at->format('d-m-Y') == Carbon\Carbon::now()->format('d-m-Y'))
                        <tr>
                            <td>{{$visitors->firstname.' '.$visitors->lastname}}</td>
                            <td>{{$visitor->firstname.' '.$visitor->lastname}}</td>
                            <td>
                                @if($visitor->status == 1)
                                    Cleared Gate
                                @elseif($visitor->status == 2)
                                    Cleared Reception
                                @elseif($visitor->status == 3)
                                    Declined
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
