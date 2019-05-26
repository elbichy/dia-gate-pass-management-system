@extends('layout.app')

@section('content')
  <main>

    <img class="responsive-img" src="{{asset('storage/site/logo100.png')}}" />

      <div class="box">
        <div class="z-depth-1 grey lighten-4 formWrap">
          
          <form class="col s12" method="POST" action="{{ route('login') }}">
            @csrf
            <h6 class="blue darken-2 white-text">General staff login</h6>

            <div class='row'>
              <div class='input-field col s12'>
                <i class="material-icons prefix">account_circle</i>
                <input class='validate' type='email' name='email' id='email' />
                @if ($errors->has('email'))
                    <span class="helper-text red-text">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <label for='email'>Enter username</label>
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
              <button type='submit' name='btn_login' class='col s12 btn waves-effect waves-light green darken-2'>Login</button>
            </div>
          </form>

        </div>
      </div>
      <a href="{{route('showAdminLoginForm')}}" class="btn blue waves-effect waves-light darken-2">Login as gate/reception admin</a>
  </main>
@endsection