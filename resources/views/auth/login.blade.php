@extends('master')

@section('content')

<div class="ui one column center aligned stackable page grid">
   <div class="column eight wide">
         <div class="ui center aligned header">
           Login
         </div>
         <div class="ui clearing divider"></div>
                       <form class="ui form" method="POST" action="{{ route('login') }}">
                           @csrf

                           <div class="field">
                             <label for="email">{{ __('E-Mail Address') }}</label>
                             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                             @error('email')
                               <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                               </span>
                             @enderror
                           </div>

                           <div class="field">
                             <label for="password">{{ __('Password') }}</label>
                             <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                             @error('password')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                           </div>

                           <div class="inline field">
                             <div class="ui checkbox">
                                 <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                 <label for="remember">
                                           {{ __('Remember Me') }}
                                 </label>
                             </div>
                           </div>

                           <div>
                             <button class="fluid ui blue button" type="submit" name="button">{{ __('Login') }}</button>
                           </div>

                           <br>
                           @if (Route::has('password.request'))
                               <a class="fluid ui red button" href="{{ route('password.request') }}">
                                   {{ __('Forgot Your Password?') }}
                               </a>
                           @endif

                       </form>

   </div>
</div>
  <!-- <div class="ui center aligned card">

    <div class="content">
      <div class="ui center aligned header">
        Login
      </div>
      <div class="ui clearing divider"></div>
                    <form class="ui form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="field">
                          <label for="email">{{ __('E-Mail Address') }}</label>
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                          @error('email')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>

                        <div class="field">
                          <label for="password">{{ __('Password') }}</label>
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        <div class="inline field">
                          <div class="ui checkbox">
                              <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                              <label for="remember">
                                        {{ __('Remember Me') }}
                              </label>
                          </div>
                        </div>

                        <div>
                          <button class="fluid ui blue button" type="submit" name="button">{{ __('Login') }}</button>
                        </div>

                        <br>
                        @if (Route::has('password.request'))
                            <a class="fluid ui red button" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                    </form>
    </div>
  </div> -->


@endsection
