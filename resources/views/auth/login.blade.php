<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('build/css/intlTelInput.css')}}">
    <link href="{{asset('img/icon_logo.jpg')}}" rel="icon" type="image/ico">
    <style>
      .iti {
          width: 100%;
        }
    </style>
    <title>Login - Conticash Client-Loyalty System</title>
  </head>
  <body>
    <section class="material-half-bg" style="">
      <div class="cover" style="height: 100vh;opacity: 0.94"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1><img src="img/logo_large.png" style="max-height: 120px;"/></h1>
      </div>
      <div class="login-box" style="min-height: 480px !important;">
        <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf
          @if(session()->has('warning'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('warning') }}
            </div>
          @endif
          @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
          @endif
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
          @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            @endforeach
          @endif
          <div class="form-group">
            <label class="control-label">MOBILE NUMBER</label><br />
            <input type="tel" class="form-control" id="cell" name="cell" value="{{ old('cell') }}" autocomplete="on" autofocus>
            @error('cell')
                <span class="invalid-feedback" role="alert">
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="on" placeholder="Enter Password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                </span>
            @enderror
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="{{URL::to('/')}}/register" class="link-underline">Don't have account ?</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
             <button type="submit" class="btn bluebutton btn-block" >
                {{ __('SIGN IN') }}
            </button>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('js/plugins/pace.min.js')}}"></script>
    <script src="{{asset('build/js/intlTelInput.js')}}"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });

      //cell validator
      var input = document.querySelector("#cell");
        var iti = window.intlTelInput(input, {
            // allowDropdown: false,
            autoHideDialCode: false,
            // autoPlaceholder: "off",
            // dropdownContainer: document.body,
            // excludeCountries: ["us"],
            formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //     var countryCode = (resp && resp.country) ? resp.country : "";
            //     callback(countryCode);
            //   });
            // },
            // hiddenInput: "full_number",
            initialCountry: "zw",
            // localizedCountries: { 'de': 'Deutschland' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            separateDialCode: true,
            utilsScript: "build/js/utils.js",
          });
    </script>
    
  </body>
</html>
