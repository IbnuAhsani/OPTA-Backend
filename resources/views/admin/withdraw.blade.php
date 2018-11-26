{{-- 
Data needed: 
- $withdraw_requests = ['id', 'nominal', 'created_at', 'bus_admin_id']

--}}

@extends('maskapai.template')

@section('style')
<style>
  a {
    text-decoration: unset;
    color: #607d8b;
  }

  .input_add {
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 4px;
  }

  #accept:hover {
    color: #4caf50;
  }
  #decline:hover {
    color: #f44336;
  }
</style>
@endsection

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
@include("maskapai.navbar")
@include("admin.sidebar")
@section('main')
    <main class="mdl-layout__content mdl-color--grey-100">
      <div class="mdl-grid demo-content">

        <div style="padding: 16px; overflow: auto" class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <table style="width: 70%; margin: auto" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
              <thead>
                <tr>
                  <th style="text-align: center;">Withdraw ID</th>
                  <th style="text-align: center">Bus Admin ID</th>
                  <th style="text-align: center">Nominal</th>
                  <th style="text-align: center">Request Time</th>
                  <th style="text-align: center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($withdraw_requests as $withdraw_request)
                <tr>
                  <td style="text-align: center;">{{ $withdraw_request['id'] }}</td>
                  <td style="text-align: center;">{{ $withdraw_request['bus_admin_id'] }}</td>
                  <td style="text-align: center"><small>Rp</small>{{ number_format($withdraw_request['nominal'], 2, ",", ".") }}</td>
                  <td style="text-align: center;">{{ date("d-m-Y", strtotime($withdraw_request['created_at'])) }}</td>
                  <td style="text-align: center">
                    <a href="/admin/withdraw/accept?id={{ $withdraw_request['id'] }}">
                      <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="accept" value={{ $withdraw_request['id'] }}>
                        <i class="material-icons">done</i>
                      </button> 
                    </a> 
                    <a href="/admin/withdraw/decline?id={{ $withdraw_request['id'] }}">
                      <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="decline" value={{ $withdraw_request['id'] }}>
                        <i class="material-icons">delete_forever</i>
                      </button>
                    </a>         
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>

      </div>
    </main>
</div>
@endsection