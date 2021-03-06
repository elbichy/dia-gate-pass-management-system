@extends('layout.personnel')

@section('content')

<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">

    <div class="progress">
        <div class="indeterminate"></div>
    </div>
    <form action="{{route('submitRequest')}}" method="post" id="newVisitorForm">
        @csrf
        <div class="modal-content" style="margin-top:0px;">
            <h4>Gate pass request</h4>
            <fieldset style="margin-top:40px;">
                <legend><h6>VISITOR DETAILS</h6></legend>
                <div class="row">
                    <div class="col s12 m8 l8">
                        <div class="input-field">
                            <input type="text" name="fullname" id="fullname" required>
                            @if ($errors->has('fullname'))
                                <span class="helper-text red-text" >
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </span>
                            @endif
                            <label for="fullname">Fullname</label>
                        </div>
                    </div>
                    <div class="col s12 m4 l4">
                        <label>Gender</label>
                        <select class="browser-default" name="gender" id="gender" required>
                            <option value="" disabled selected>Choose your option</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        @if ($errors->has('gender'))
                            <span class="helper-text red-text" >
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="modal-footer">
            <li class="right">
                <button class="newVisitorSubmit btn waves-effect waves-light green" type="submit">Submit</button>
                <button class="btn waves-effect waves-light red modal-close" type="button">close</button>
            </li>
        </div>
    </form>
</div>


<div class="dashboardWrap row">
    <div class="personnel">

        {{-- NEW REQUEST TRIGGER --}}
        <a href="#modal1" class="modal-trigger btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>

        <h5 class="col s12 center white-text" style="margin:0">Staff Dashboard</h5>
        <div class="expected col s12 m6 l6">
            <table class="highlight centered z-depth-2">
                <thead>
                    <tr>
                        <h6 style="text-align:center; color:white;">My Guest Request Today</h6>
                    </tr>
                    <tr class="blue-text">
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
        
                <tbody id="myRequests">
                @if(count($data['todaysVisitors']) > 0)
                    @foreach($data['todaysVisitors'] as $visitor)
                        @if($visitor->status < 2)
                            <tr>
                                <td>{{$visitor->fullname}}</td>
                                <td>{{$visitor->gender}}</td>
                                <td>
                                    {!! $visitor->status == 0 ? '<span class="orange-text">Pending</span>' : '' !!}
                                    {!! $visitor->status == 1 ? '<span class="orange-text">Cleared @ Gate</span>' : '' !!}
                                    {!! $visitor->status == 2 ? '<span class="green-text">Cleared!</span>' : '' !!}
                                    {!! $visitor->status == 3 ? '<span class="red-text">Declined</span>' : '' !!}
                                </td>
                                <td><a href="#" data-requestid="{{$visitor->id}}" class="deleteRequest btn btn-small waves-effect waves-light red">Delete</a></td>
                                <form action="{{url('personnel/deleteRequest')}}" method="post" name="deleteRequestForm" id="deleteRequestForm">
                                    @method('delete')
                                        <input type="hidden" name="deleterequestid" id="deleterequestid">
                                    @csrf
                                </form>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="padding:10px 0;">No request today</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="authenticated col s12 m6 l6">
            <table class="highlight centered z-depth-2">
                <thead>
                    <tr>
                        <h6 style="text-align:center; color:white;">My Requests History</h6>
                    </tr>
                    <tr class="blue-text">
                        <th>Fullname</th>
                        <th>Gender</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
        
                <tbody id="myRequests">
                @if(count($data['allVisitors']) > 0)
                    @foreach($data['allVisitors'] as $visitor)
                        @if($visitor->status > 1)
                        <tr>
                            <td>{{  $visitor->fullname }}</td>
                            <td>{{  $visitor->gender }}</td>
                            <td>{{  \Carbon\Carbon::parse($visitor->verifiedAtGate)->diffForHumans() }}</td>
                            <td>
                                {!! $visitor->status == 0 ? '<span class="orange-text">Pending</span>' : '' !!}
                                {!! $visitor->status == 1 ? '<span class="orange-text">Cleared @ Gate</span>' : '' !!}
                                {!! $visitor->status == 2 ? '<span class="green-text">Cleared!</span>' : '' !!}
                                {!! $visitor->status == 3 ? '<span class="red-text">Declined</span>' : '' !!}
                            </td>
                        </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="padding:10px 0;">No request  at all</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $data['allVisitors']->links('vendor.pagination.materializecss') }}
        </div>
    </div>
</div>
@endsection
