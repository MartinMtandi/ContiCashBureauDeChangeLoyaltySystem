
@extends('layouts.app')

@section('content')

<div class="app-title">

    <div>
      <h1><i class="fa fa-dashboard"></i> Welcome to Conticash</h1>
      @if(count($cash) > 0)
        <p>Gain <strong style="color: #a40b0b;">{{$cash[0]->remainingPoints}}</strong> points to go to the next membership level.</p>
      @endif
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    </ul>
  </div>
  @if(session()->has('success'))
    <div class="alert alert-info" role="alert">
        {{ session()->get('success') }}
    </div>
  @endif
  <div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states greencon-b">
            <div class="pull-right state-icon">
                <i class="fa fa-university white"></i>
            </div>
            <div class="panel-body">
                <h1 class="light-txt "><?php 
                  $balance = 0;
                  foreach ($cash as $key) {
                    $balance += (int)$key->credits;
                  }
                ?>
                
                <!---Start dropdown--->
          <div class="dropdown">
            <button class="dropbtn">
           <?php echo $cash[0]->currency . ' ' . number_format((float)$balance, 2, '.', ''); ?>
            </button>
            <div class="dropdown-content">
              @if(count($cash) > 0)
                @foreach($cash as $item)
                  <a class="key">{{ucfirst($item->walletType)}}  <span>{{$item->currency . ' ' . number_format((float)$item->credits, 2, '.', '')}}</span></a>
                @endforeach
                <a class="divider key">Total <span><strong><?php echo $item->currency . ' ' .  number_format((float)$balance, 2, '.', ''); ?></strong></span></a>
              @endif  
              </h1>
                <strong class="text-uppercase white">Bonus Balance</strong>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-info-b">
            <div class="pull-right state-icon">
                <i class="fa fa-star white"></i>
            </div>
            <div class="panel-body">
                <h1 class="light-txt">{{ $cash[0]->points }}</h1>
                <strong class="text-uppercase white">LOYALTY POINTS</strong>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-warning-b">
            <div class="pull-right state-icon">
                <i class="fa fa-trophy white"></i>
            </div>
            <div class="panel-body">
                <h1 class="light-txt">{{$member_status[0]}}</h1>
                <strong class="text-uppercase white">MEMBERSHIP LEVEL</strong>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-primary-b">
            <div class="pull-right state-icon">
                <i class="fa fa-users white"></i>
            </div>
            <div class="panel-body">
                @if(count($promotion) > 0)
                <h1 class="light-txt">{{$promotion[0]->name}}</h1>
                @endif
                <strong class="text-uppercase white">GROUP</strong>
            </div>
        </div>
    </div>
</div>

 <div class="row">
  <div class="col-md-12">
      <div class="">
      <h3 class="tile tile-title custom-heading heading-background" style="margin-bottom: 3px;">Account Report</h3>
      <form method="post" class="tile" style="margin-bottom: 3px;">
      <div class="form-row">
      <div class="form-group col-md-3" style="margin-bottom: 0rem;"></div>
        <div class="form-group col-md-2" style="margin-bottom: 0rem;">
          <input type="number" class="form-control" id="count_rows_transactions" value="7">
        </div>
        <div class="form-group col-md-4" style="margin-bottom: 0rem;">
          <select id="range_transactions" class="form-control">
            <option value="Daily">Daily</option>
            <option value="Weekly">Weekly</option>
            <option value="Monthly">Monthly</option>
            <option value="Yearly">Yearly</option>
          </select>
        </div>
        <div class="form-group col-md-2" style="margin-bottom: 0rem;">
          <input type="button" class="btn green" id="search_transactions" value="Filter">
        </div>
      </div>
      </form>
        <div class="tile tile-body" style="min-height:400px" id="display_results_transactions">
          
        </div>
      </div>
  </div>
  
<script>  $(function(){  $("#display_results_transactions").load("transFcnSections.php").show("slow");
    $("#search_transactions").click(function(){
      var range = $("#range_transactions").val(); 
      var seven = $("#count_rows_transactions").val(); 
      $("#display_results_transactions").load("transFcnSections.php?range="+range+"&seven="+seven).show("slow");
    }); 
  }); 
 </script>
 </div>
  <div class="row">
    <div class="col-md-6">
      <div class="">
        <h4 class="tile tile-title custom-heading heading-background">
          Recent Transactions</h4>
            <div class="tile tile-body" style="min-height:380px">
              <table class="table table-hover table-bordered" >
                  <thead>
                    <tr style="background-color: #fff !important;color: #333 !important;">
                      <th>Reference</th>
                      <th>Amount</th>
                      <th>Description</th>
                      <th>Bonus Earned</th>
                      <th>Points Earned</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($logs) > 0)
                    @foreach($logs as $log)
                    <tr>
                      <td>{{$log->Reference}}</td>
                      <td>{{$log->Currency . ' ' . number_format((float)$log->Amount, 2, '.', '')}}</td>
                      <td>{{$log->Description}}</td>
                      <td>{{number_format((float)$log->BonusEarned, 2, '.', '')}}</td>
                      <td>{{$log->PointsEarned}} Points</td>
                      <td>{{$log->Date}}</td>
                    </tr>
                    @endforeach
                  @endif
                  </tbody>
                </table>
              </div>
        </div>
    </div>
    <div class="col-md-6">
      <div class="">
        <h4 class="tile tile-title custom-heading heading-background">Recently Redeemed Products</h4>
        <div class="tile tile-body" style="min-height:380px">
        <table class="table table-hover table-bordered" >
            <thead>
              <tr style="background-color: #fff !important;color: #333 !important;">
                <th>Reference</th>
                <th>Amount</th>
                <th>Points Earned</th>
                <th>Bonus Earned</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
            @if(count($results) > 0)
              @foreach($results as $log)
              <tr>
                <td>{{$log->Reference}}</td>
                <td>{{$log->Currency . ' ' . number_format((float)$log->Amount, 2, '.', '')}}</td>
                <td>{{$log->PointsEarned}}</td>
                <td>{{$log->BonusEarned}}</td>
                @if($log->Status == 0)
                  <td>Failed</td>
                @endif
                @if($log->Status == 1)
                  <td>Collected</td>
                @endif
                @if($log->Status == 2)
                  <td>Pending Collection</td>
                @endif
                <td>{{$log->Date}}</td>
              </tr>
              @endforeach
            @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
