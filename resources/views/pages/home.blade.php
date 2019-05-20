@extends('layout.app')

@section('content')
  <main>

    <img class="responsive-img" src="{{asset('storage/site/logo120.png')}}" />

      <h5 class="white-text">Please, login into your account</h5>

      <div class="box">
        <div class="z-depth-1 grey lighten-4 row formWrap">
          <form class="col s12" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <i class="material-icons prefix">account_circle</i>
                <input class='validate' type='email' name='email' id='email' />
                <label for='email'>Enter your email</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <i class="material-icons prefix">lock</i>
                <input class='validate' type='password' name='password' id='password' />
                <label for='password'>Enter your password</label>
              </div>
              <label style='float: right;'>
                <a class='pink-text' href='#!'><b>Forgot Password?</b></a>
              </label>

              <p>
                <label>
                  <input type="checkbox" checked="checked" />
                  <span>Remember Me?</span>
                </label>
              </p>
            </div>

          
            <div class='row'>
              <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect green darken-1'>Login</button>
            </div>
          </form>
        </div>
      </div>
      <a href="#!" class="btn blue">Create account</a>
  </main>
@endsection