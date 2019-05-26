@extends('layout.personnel')

@section('content')

<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <form action="{{route('submitRequest')}}" method="post" id="newVisitorForm">
        @csrf
        <div class="modal-content" style="margin-top:0px;">
            <h4>Gate pass request</h4>
            <fieldset style="margin-top:40px;">
                <legend><h6>VISITOR DETAILS</h6></legend>
                <div class="row">
                    <div class="col s12 m4 l4">
                        <div class="input-field">
                            <input type="text" name="firstname" id="firstname">
                            @if ($errors->has('firstname'))
                                <span class="helper-text red-text" >
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                            @endif
                            <label for="firstname">Firstname</label>
                        </div>
                    </div>
                    <div class="col s12 m4 l4">
                        <div class="input-field">
                            <input type="text" name="lastname" id="lastname">
                            @if ($errors->has('gender'))
                                <span class="helper-text red-text" >
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                            <label for="lastname">Lastname</label>
                        </div>
                    </div>
                    <div class="col s12 m4 l4 input-field">
                        <select name="gender" id="gender">
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
                        <label>Gender</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m4 l4">
                        <div class="input-field">
                            <input type="text" name="phone" id="phone">
                            @if ($errors->has('phone'))
                                <span class="helper-text red-text" >
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                            <label for="phone">Phone No.</label>
                        </div>
                    </div>
                    <div class="col s12 m8 l8">
                        <div class="input-field">
                            <input type="text" name="address" id="address">
                            @if ($errors->has('address'))
                                <span class="helper-text red-text" >
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                            <label for="address">From (Address)</label>
                        </div>
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

        <div class="expected col s12 m6 l6">
            <table class="striped highlight centered responsive-table z-depth-2">
                <thead>
                    <tr>
                        <h5 style="text-align:center; color:white;">My Requests Today</h5>
                    </tr>
                    <tr class="blue-text" style="border-bottom:4px solid #2196f3">
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
        
                <tbody>
                @if(count($data['todaysVisitors']) > 0)
                    @foreach($data['todaysVisitors'] as $visitor)
                            <tr>
                                <td>{{$visitor->firstname.' '.$visitor->lastname}}</td>
                                <td>{{$visitor->gender}}</td>
                                <td>{{$visitor->phone}}</td>
                                <td>
                                    {!! $visitor->status == 0 ? '<i class="material-icons orange-text">loop</i>' : '' !!}
                                    {!! $visitor->status == 1 ? '<i class="material-icons green-text">done</i>' : '' !!}
                                    {!! $visitor->status == 2 ? '<i class="material-icons green-text">done_all</i>' : '' !!}
                                </td>
                                <td><a href="#" data-requestid="{{$visitor->id}}" class="deleteRequest"><i class="material-icons red-text">close</i></a></td>
                                <form action="{{url('dashboard/deleteRequest').'/'.$visitor->id}}" method="post" name="deleteRequestForm" id="deleteRequestForm">
                                    @method('delete')
                                    @csrf
                                </form>
                                <td><i class="material-icons">comment</i></td>
                            </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="padding:10px 0;">No request today</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{$data['todaysVisitors']->links('vendor.pagination.materializecss')}}
        </div>
        <div class="authenticated col s12 m6 l6">
            <table class="striped highlight centered responsive-table z-depth-2">
                <thead>
                    <tr>
                        <h5 style="text-align:center; color:white;">Requests History</h5>
                    </tr>
                    <tr class="blue-text" style="border-bottom:4px solid #2196f3">
                        <th>Fullname</th>
                        <th>Gender</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
        
                <tbody>
                @if(count($data['allVisitors']) > 0)
                    @foreach($data['allVisitors'] as $visitor)
                        <tr>
                            <td>{{$visitor->firstname.' '.$visitor->lastname}}</td>
                            <td>{{$visitor->gender}}</td>
                            <td>{{$visitor->created_at->format('d/m/Y')}}</td>
                            <td>
                                {!! $visitor->status == 0 ? '<i class="material-icons orange-text">loop</i>' : '' !!}
                                {!! $visitor->status == 1 ? '<i class="material-icons green-text">done</i>' : '' !!}
                                {!! $visitor->status == 2 ? '<i class="material-icons green-text">done_all</i>' : '' !!}
                            </td>
                            <td><a class="white-text btn green">View</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="padding:10px 0;">No request  at all</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{$data['allVisitors']->links('vendor.pagination.materializecss')}}
        </div>
    </div>
</div>
@endsection
