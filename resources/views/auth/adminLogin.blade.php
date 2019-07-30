@extends('layout.app')

@section('content')
  <main>

    <img class="responsive-img" src="{{asset('storage/site/logo100.png')}}" />

      <div class="box">
        <div class="z-depth-1 grey lighten-4 formWrap">
          
          <form class="col s12" method="POST" action="{{ route('adminLogin') }}" id="regForm" onsubmit="submitForm(event)">
            @csrf
            <h6 class="blue darken-2 white-text">Admin staff login</h6>

            <div class='row'>
                @if ($errors->login->has('details'))
                    <span class="helper-text red-text">
                        <strong>{{ $errors->login->first('details') }}</strong>
                    </span>
                @endif
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
          <a href="{{  route('login') }}" class="col s6 skyblue-text">Login as Staff</a>
          <a class='col s6  skyblue-text' href='#!'>Forgot Password?</a>
      </div>
  </main>
@endsection