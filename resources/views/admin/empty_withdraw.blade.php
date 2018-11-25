@extends('maskapai.template')

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
@include("maskapai.navbar")
@include("admin.sidebar")
@section('main')
    <main class="mdl-layout__content mdl-color--grey-100">
      <div class="mdl-grid demo-content">
        <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <!-- empty icons -->
            <div style="margin: auto" class="mdl-cell--12-col">
              <h4 style="text-align: center"><i>Belum ada Withdraw Request</i></h4>
            </div>
            <table style="width: 70%; margin: auto; overflow: auto" class="mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--2dp">
              <thead>
                <tr>
                  <th style="text-align: center;">Withdraw ID</th>
                  <th style="text-align: center">Bus Admin ID</th>
                  <th style="text-align: center">Nominal</th>
                  <th style="text-align: center">Request Time</th>
                  <th style="text-align: center">Action</th>
                </tr>
              </thead>
            </table>
        </div>
      </div>
    </main>
</div>
@endsection