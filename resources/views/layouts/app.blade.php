<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Conticash Client-Loyalty System</title>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Main CSS-->
    {!! Charts::assets() !!}
    <link rel="stylesheet" href="{{asset('css/morris.css')}}">
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/echarts.js')}}"></script>
    <script src="{{asset('js/raphael-min.js')}}"></script>
    <script src="{{asset('js/morris.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('img/icon_logo.jpg')}}" rel="icon" type="image/ico">
    <style>
      .fa-university{
        color: #fff;
      }

      .bank:hover{
        cursor: pointer;
      }

      .products{
        padding-bottom: 22px;
        
      }

      .product-wrapper{
        position: relative;
        background: #f6f2f1;
        height: 300px;
        padding-top: 16px;
        margin-bottom: 6px;
      }

      .product-wrapper img{
        max-width: 70%;
        max-height: 190px;
        display: block;
        margin: 0 auto;
      }

      .product-wrapper h1{
        position: absolute;
        width:100%;
        bottom:0;
        text-align:center;
        color: #40C559;
        font-size: 18px;
        margin: 8px 0;
      }

      .description{
        color: #373536;
        font-size: 16px;
        margin-bottom: 8px;
      }

      .value{
        background: #FFC300;
        padding: 2px 5px;
        border-radius: 4px;
        color: #fff !important;
        font-size: 18px;
        color: #373536;
        font-weight: 800;
      }

      .wallet-form{
        padding-bottom: 5px;
      }

      .helpme:hover{
        cursor: pointer;
      }


      /* Dropdown Button */
      .dropbtn {
        background-color: #fff0;
        font-size: 17px;
        border: none;
        font-weight: 600;
        color: #ffffff;
      }

      /* The container <div> - needed to position the dropdown content */
      .dropdown {
        position: relative;
        display: inline-block;
      }

      /* Dropdown Content (Hidden by Default) */
      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #0284be;
        min-width: 230px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
      }

      /* Links inside the dropdown */
      .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
      }

      .divider{
        border-top: 1px solid #ccc;
      }

      .key{
        display: block;
      }

      .key span {
        float: right;
      }

      /* Change color of dropdown links on hover */
      .dropdown-content a:hover {background-color: #02b1e0;}

      /* Show the dropdown menu on hover */
      .dropdown:hover .dropdown-content {display: block;}

     
    </style>

  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header" style="background: url('/img/bgtop.jpg');"><a class="app-header__logo" style="background: #fff;" href="{{URL::to('/')}}/home"><img src="img/logo_large.png" height="56px"/></a>
   
      <!-- Navbar Right Menu-->
      <ul class="app-nav" >
      <li><a class="app-nav__item" href="{{URL::to('/')}}/newsletter"><sup><i class="fa fa-bell fa-lg"></i></sup><sub> <span class="badge badge-light"  id="unread_status"></span></sub></a></li>


      <?php
      $user_id = Auth::user()->id;
      $vas_centre_id = Auth::user()->vas_centre_id;

      ?>
      <script> 

      $(function(){
     
         var user_id = "<?php echo $user_id; ?>";
         var vas_centre_id="<?php echo $vas_centre_id; ?>";
        
         refreshme();
              function refreshme(){
                setTimeout(function(){
                  $("#unread_status").load("jquery/refresh.php?vas_centre_id="+vas_centre_id+"&user_id="+user_id).show();
                  
                  refreshme();
                }, 3000);
              }
          
         });
      </script>

        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>

          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{{URL::to('/')}}/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a class="dropdown-item" href="{{URL::to('/')}}/account"><i class="fa fa-cog fa-lg"></i>Transaction Logs</a></li>
            <li><a class="dropdown-item" href="{{URL::to('/')}}/redeem"><i class="fa fa-edit"></i>Redeem Points</a></li>
            <li><a class="dropdown-item" href="{{URL::to('/')}}/redeemedProductsLogs"><i class="fa fa-star"></i>Redeemed Prod...</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> {{ __('Logout') }}
            </a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php
    session_start();
    $_SESSION['logged_in_user_id'] = Auth::user()->id;
    ?>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><i class="fa fa-user-circle-o fa-3x" style="margin-right: 10px;"></i>
        <div>
          <p class="app-sidebar__user-name">{{ Auth::user()->first_name.' '.substr(Auth::user()->last_name,0,1).'.' }}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="{{URL::to('/')}}/home"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="{{URL::to('/')}}/redeem"><i class="app-menu__icon fa fa-clipboard"></i><span class="app-menu__label">Redeem Points</span></a></li>  
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Transactions</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{URL::to('/')}}/account"><i class="icon fa fa-circle-o"></i>Transaction Logs</a></li>
            <li><a class="treeview-item" href="{{URL::to('/')}}/redeemedProductsLogs"><i class="icon fa fa-circle-o"></i> Redeemed Points</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i></i><span class="app-menu__label">Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{URL::to('/')}}/password"><i class="icon fa fa-circle-o"></i>Change Password</a></li>
            <li><a class="treeview-item" href="{{URL::to('/')}}/client_centre"><i class="icon fa fa-circle-o"></i>Client Centre</a></li>
          </ul>
        </li>
        <li><a class="app-menu__item" href="{{URL::to('/')}}/newsletter"><i class="app-menu__icon fa fa-clipboard"></i><span class="app-menu__label">Newsletter</span></a></li> 
      </ul>
    </aside>
    <main class="app-content">
      @yield('content')
    </main>
    <!-- Essential javascripts for application to work-->
  
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('js/plugins/pace.min.js')}}"></script>
    {{-- <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script> --}}
    <script type="text/javascript" src="{{asset('js/plugins/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{asset('js/plugins/chart.js')}}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    
  
  </body>
</html>