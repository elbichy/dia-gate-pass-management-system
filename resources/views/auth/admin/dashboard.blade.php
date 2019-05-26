@extends('layout.admin')

@section('content')

<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
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
</div>

<div class="dashboardWrap row">
    <div class="admins">
        <div class="expected col s12 m8 l8">
            <table class="striped highlight centered responsive-table z-depth-2">
                <thead>
                    <tr>
                        <h5 style="text-align:center; color:white;">Expected Guests Today</h5>
                    </tr>
                    <tr>
                        <th>Fullname</th>
                        <th>Building</th>
                        <th>Office</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                </thead>
        
                <tbody>
                    <tr>
                        <td>Alvin</td>
                        <td>Eclair</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td><a href="#modal1" class="white-text btn green waves-effect waves-light btn modal-trigger">View</a></td>
                    </tr>
                    <tr>
                        <td>Alvin</td>
                        <td>Eclair</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td><a href="#modal1" class="white-text btn green waves-effect waves-light btn modal-trigger">View</a></td>
                    </tr>
                    <tr>
                        <td>Alvin</td>
                        <td>Eclair</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td><a href="#modal1" class="white-text btn green waves-effect waves-light btn modal-trigger">View</a></td>
                    </tr>
                    <tr>
                        <td>Alvin</td>
                        <td>Eclair</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td><a href="#modal1" class="white-text btn green waves-effect waves-light btn modal-trigger">View</a></td>
                    </tr>
                    <tr>
                        <td>Alvin</td>
                        <td>Eclair</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td><a href="#modal1" class="white-text btn green waves-effect waves-light btn modal-trigger">View</a></td>
                    </tr>
                    <tr>
                        <td>Alvin</td>
                        <td>Eclair</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td>$0.87</td>
                        <td><a href="#modal1" class="white-text btn green waves-effect waves-light btn modal-trigger">View</a></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        <div class="authenticated col s12 m4 l4">
                <table class="striped highlight centered responsive-table z-depth-2">
                    <thead>
                        <tr>
                            <h5 style="text-align:center; color:white;">Screened Today</h5>
                        </tr>
                        <tr>
                            <th>Fullname</th>
                            <th>Fullname</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <tr>
                            <td>Alvin</td>
                            <td>Eclair</td>
                            <td><i class="material-icons">done</i></td>
                            <td><a class="white-text btn green">View</a></td>
                        </tr>
                        <tr>
                            <td>Alvin</td>
                            <td>Eclair</td>
                            <td><i class="material-icons">done_all</i></td>
                            <td><a class="white-text btn green">View</a></td>
                        </tr>
                        <tr>
                            <td>Alvin</td>
                            <td>Eclair</td>
                            <td><i class="material-icons">close</i></td>
                            <td><a class="white-text btn green">View</a></td>
                        </tr>
                        
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
