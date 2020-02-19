@extends('layouts.app')
@section('content')
     <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Account Logs</h1>
          <p>All your account logs in one place</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Account</li>
          <li class="breadcrumb-item active"><a href="#">Logs</a></li>
        </ul>
      </div>
        @if(session()->has('success'))
          <div class="alert alert-info" role="alert">
              {{ session()->get('success') }}
          </div>
        @endif
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th>Provider</th>
                    <th>Description</th>
                    <th>Customer Level</th>
                    <th>Points Earned</th>
                    <th>Discount Earned</th>
                    <th>Bonus Earned</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                @if(count($logs) > 0)
                  @foreach($logs as $log)
                  <tr>
                    <td>{{$log->Reference}}</td>
                    <td>{{$log->Currency . ' ' . number_format((float)$log->Amount, 2, '.', '')}}</td>
                    <td>{{$log->Provider}}</td>
                    <td>{{$log->Description}}</td>
                    <td>{{$log->CustomerLevel}}</td>
                    <td>{{$log->PointsEarned}} Points</td>
                    <td>{{$log->DiscountEarned}}</td>
                    <td>{{$log->BonusEarned}}</td>
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