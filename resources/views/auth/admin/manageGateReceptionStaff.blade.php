@extends('layout.admin')

@section('adminContent')
    <div class="dashboardWrap row">
        <div class="admins col s12">
            <h5 class="col s12 center white-text" style="margin:0px 0 20px 0">Manage Admin Staff</h5>
            <div class="formWrap col s12 m6 l6">
                <form action="{{route('addNewAdmin')}}" method="POST" id="addNewAdminForm">
                    @csrf
                    <h6>REGISTER NEW ADMIN</h6>
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
                            <label for="gender">Gender</label>
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
                            <input type="text" name="username" id="username">
                            <label for="username">Username *</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="password" name="password" id="password" required>
                            <label for="password">Password *</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="number" name="phone" id="phone">
                            <label for="phone">Phone</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m4 l4">
                            <input type="email" name="email" id="email" required>
                            <label for="email">Email *</label>
                        </div>
                        <div class="input-field col s12 m3 l4">
                            <input type="number" name="gl" id="gl">
                            <label for="gl">Grade Level</label>
                        </div>
                        <div class="input-field col s12 m3 l4">
                            <input type="number" name="step" id="step">
                            <label for="step">Step</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m4 l4">
                            <input type="text" name="designation" id="designation">
                            <label for="designation">Designation</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="text" name="position" id="position">
                            <label for="position">Position</label>
                        </div>
                        <div class="col s12 m4 l4">
                            <label for="role">Role *</label>
                            <select class="browser-default" name="role" id="role" required>
                                <option value="" disabled selected>Choose your option</option>
                                <option value="1">Admin</option>
                                <option value="2">Gate Staff</option>
                                <option value="3">Reception Staff</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 m4 l4">
                            <label for="block">Block *</label>
                            <select class="browser-default" name="block" id="block" required>
                                <option value="" disabled selected>Choose your option</option>
                                <option value="hq">HQ</option>
                                <option value="oldhq">Old HQ</option>
                                <option value="annex">Annex</option>
                            </select>
                        </div>
                        <div class="input-field col s12 m4 l4">
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
                    <h6>LIST OF ADMINS</h6>
                    <table class="centered responsive-table striped highlight">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Block</th>
                                <th>Office</th>
                                <th>Role</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                
                        <tbody>
                        @if($data['allAdmins'] != NULL)
                            @foreach ($data['allAdmins'] as $admin)
                            <tr>
                                <td>{{$admin->firstname.' '.$admin->lastname}}</td>
                                <td>{{$admin->gender}}</td>
                                <td>{{$admin->block}}</td>
                                <td>{{$admin->office}}</td>
                                {!! $admin->role == 1 ? '<td>Admin</td>' : '' !!}
                                {!! $admin->role == 2 ? '<td>Gate Admin</td>' : '' !!}
                                {!! $admin->role == 3 ? '<td>Reception Admin</td>' : '' !!}
                                <td><a class="waves-effect waves-light btn-small btn-flat">view</a></td>
                                <td><a href="#"><i class="material-icons red-text">close</i></a></td>
                            </tr>
                            @endforeach
                        @else
                            <tr>No Data</tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
