{{-- 
Data: 
    - withdraw_history: float
    - money_to_withdraw: float
--}}

@extends('maskapai.template')

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
@include("maskapai.navbar")
@include("maskapai.sidebar")
@section('main')
    <main class="mdl-layout__content mdl-color--grey-100">
      <div class="mdl-grid demo-content">

        <div style="padding: 16px; overflow: auto" class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <div class="mdl-cell--12-col">
                <h4>Withdraw History</h4>
            </div>
            <div class="mdl-cell--12-col">
                <table style="width: 100%; margin: auto" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                <thead>
                    <tr>
                        <th style="text-align: left">Date</th>
                        <th style="text-align: center">Money</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                </table>
            </div>
        </div>

        <!-- money to withdraw -->
        <div style="padding: 16px; overflow: auto" class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <div class="mdl-cell--12-col">
                <h4>Money to Withdraw</h4>
            </div>
            <div class="mdl-cell--4-col">
                <h5>{{ $money_to_withdraw }}</h5>
            </div>
        </div>

      </div>
    </main>
</div>
@endsection