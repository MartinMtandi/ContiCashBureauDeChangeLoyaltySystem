@extends('layouts.app')

@section('content')

<div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Redeemed Products Logs</h1>
          <p>All your redeemed products logs in one place</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Redeemed Products</li>
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
                    <th>Provider</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Customer Level</th>
                    <th>Points Earned</th>
                    <th>Discount Earned</th>
                    <th>Bonus Earned</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                @if(count($results) > 0)
                @foreach($results as $res)
                  <tr>
                    <td>{{$res->Reference}}</td>
                    <td>{{$res->Provider}}</td>
                    <td>{{$res->Currency . ' ' . number_format((float)$res->Amount, 2, '.', '')}}</td>
                    <td>{{$res->Description}}</td>
                    <td>{{$res->CustomerLevel}}</td>
                    <td>{{$res->PointsEarned}}</td>
                    <td>{{$res->DiscountEarned}}</td>
                    <td>{{$res->BonusEarned}}</td>
                    @if($res->Status == 0)
                      <td>Failed</td>
                    @endif
                    @if($res->Status == 1)
                      <td>Collected</td>
                    @endif
                    @if($res->Status == 2)
                      <td>Pending Collection</td>
                    @endif
                    <td>{{$res->Date}}</td>
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