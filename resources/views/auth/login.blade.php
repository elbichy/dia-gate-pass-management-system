@extends('layout.app')

@section('content')
  <main>

    <img class="responsive-img" src="{{asset('storage/site/logo100.png')}}" />

      <div class="box">
        <div class="z-depth-1 grey lighten-4 formWrap">
          
          <form class="col s12" method="POST" action="{{ route('login') }}" id="loginForm" onsubmit="submitForm(event)">
            @csrf
            <h6 class="white-text">General staff login</h6>

            <div class='row'>
              <div class='input-field col s12'>
                <i class="material-icons prefix">account_circle</i>
                <input type='text' name='username' id='username'  value="{{ old('username') }}" required/>
                @if ($errors->has('username'))
                    <span class="helper-text red-text">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
                <label for='username'>Enter username</label>
              </div>
              <div class='input-field col s12'>
                <i class="material-icons prefix">lock</i>
                <input type='password' name='password' id='password' required/>
                @if ($errors->has('password'))
                    <span class="helper-text red-text">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <label for='password'>Enter password</label>
              </div>
              <div class='input-field col s12' style="margin: 0;">
                <p>
                  <label>
                    <input type="checkbox" name="remember" class="filled-in" />
                    <span>Remember Me?</span>
                  </label>
                </p>
              </div>
            </div>
            <div class='row'>
              <button type='submit' name='btn_login' class='btn_login col s12 btn'>
                  Login<i class="material-icons" style="margin-left:4px;">lock_open</i>
              </button>
            </div>
          </form>

        </div>
      </div>
      <div class="links row">
          <a href="{{route('showAdminLoginForm')}}" class="col s6 skyblue-text">Login as Admin</a>
          <a class='col s6  skyblue-text' href='#!'>Forgot Password?</a>
      </div>
  </main>
@endsection