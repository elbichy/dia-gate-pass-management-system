@extends('layout.admin')

@section('adminContent')
    <div class="dashboardWrap row">
        <div class="admins col s12">
            <h5 class="col s12 center white-text" style="margin:0px 0 20px 0">Manage General Staff</h5>
            <div class="formWrap col s12 m6 l6">
                <form action="{{route('addNewStaff')}}" method="POST" id="addNewStaffForm">
                    @csrf
                    <h6>REGISTER NEW STAFF</h6>
                    <div class="row">
                        <div class="input-field col s12 m4 l4">
                            <input type="text" name="firstname" id="firstname" required>
                            <label for="firstname">Firstname *</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="text" name="lastname" id="lastname" required>
                            <label for="lastname">Lastname *</label>
                        </div>
                        <div class="col s12 m4 l4">
                            <label for="gender">Gender *</label>
                            <select class="browser-default" name="gender" id="gender" required>
                                <option value="" disabled selected>Choose your option</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m4 l4">
                            <input type="text" name="username" id="username" required>
                            <label for="username">Username *</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="password" name="password" id="password" required>
                            <label for="password">Password *</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="email" name="email" id="email" required>
                            <label for="email">Email *</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m4 l4">
                            <input type="number" name="phone" id="phone">
                            <label for="phone">Phone</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="number" name="gl" id="gl">
                            <label for="gl">Grade Level</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="number" name="step" id="step">
                            <label for="step">Step</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m4 l4">
                            <input type="text" name="position" id="position">
                            <label for="position">Position</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="text" name="designation" id="designation">
                            <label for="designation">Designation</label>
                        </div>
                        <div class="col s12 m4 l4">
                            <label for="block">Block *</label>
                            <select class="browser-default" name="block" id="block" required>
                                <option value="" disabled selected>Choose your option</option>
                                <option value="hq">HQ</option>
                                <option value="oldhq">Old HQ</option>
                                <option value="annex">Annex</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m8 l8">
                            <input type="text" name="office" id="office" required>
                            <label for="office">Office *</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <button class="btn waves-effect waves-light green darken-1 right" type="submit">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="listWrap col s12 m6 l6">
                <div class="tableWrap">
                    <h6>LIST OF STAFFS</h6>
                    <table class="centered responsive-table striped highlight">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Block</th>
                                <th>Office</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                
                        <tbody>
                        @if($data['allStaffs'] != NULL)
                            @foreach ($data['allStaffs'] as $staff)
                            <tr>
                                <td>{{$staff->firstname.' '.$staff->lastname}}</td>
                                <td>{{$staff->gender}}</td>
                                <td>{{$staff->block}}</td>
                                <td>{{$staff->office}}</td>
                                <td><a class="waves-effect waves-light btn-small btn-flat">view</a></td>
                                <td><a href="#"><i class="material-icons red-text">close</i></a></td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                        No Data to display
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="page col s12" style="padding:0 0 0 0;">
                        {{$data['allStaffs']->links('vendor.pagination.materializecss')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
