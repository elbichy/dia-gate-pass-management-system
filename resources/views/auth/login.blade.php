@extends('layout.app')

@section('content')
  <main>

    <img class="responsive-img" src="{{asset('storage/site/logo100.png')}}" />

      <div class="box">
        <div class="z-depth-1 grey lighten-4 formWrap">
          
          <form class="col s12" method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <h6 class="blue darken-2 white-text">General staff login</h6>

            <div class='row'>
              <div class='input-field col s12'>
                <i class="material-icons prefix">account_circle</i>
                <input class='validate' type='text' name='username' id='username' />
                @if ($errors->has('username'))
                    <span class="helper-text red-text">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
                <label for='username'>Enter username</label>
              </div>
              <div class='input-field col s12'>
                <i class="material-icons prefix">lock</i>
                <input class='validate' type='password' name='password' id='password' />
                @if ($errors->has('password'))
                    <span class="helper-text red-text">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <label for='password'>Enter password</label>
              </div>
            </div>
            <div class="row">
              <label style='float: right;'>
                <a class='pink-text' href='#!'><b>Forgot Password?</b></a>
              </label>
              <p>
                <label>
                  <input type="checkbox" name="remember" />
                  <span>Remember Me?</span>
                </label>
              </p>
            </div>
            <div class='row'>
              <button type='submit' name='btn_login' class='btn_login col s12 btn waves-effect waves-light green darken-2'>Login</button>
            </div>
          </form>

        </div>
      </div>
      <a href="{{route('showAdminLoginForm')}}" class="btn blue waves-effect waves-light darken-2">Login as Admin</a>
  </main>
@endsection