{{-- 
Data needed: 
- $top_up_requests = ['id', 'unique_code', 'nominal', 'request_time', 'expire_time']

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

  #edit:hover {
    color: #4caf50;
  }
  #download_qr:hover {
    color: #03a9f4;
  }
  #delete:hover {
    color: #f44336;
  }
  #add:hover {
    color: #2196f3;
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
                  <th style="text-align: left;">ID</th>
                  <th style="text-align: left">Unique Code</th>
                  <th style="text-align: left">Nominal</th>
                  <th style="text-align: left">Request Time</th>
                  <th style="text-align: left">Expire Time</th>
                  <th style="text-align: center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($top_up_requests as $top_up_request)
                <tr>
                  <td style="text-align: left;">{{ $top_up_request['id'] }}</td>
                  <td style="text-align: left;">{{ $top_up_request['unique_code'] }}</td>
                  <td style="text-align: left"><small>Rp</small>{{ number_format($top_up_request['nominal'], 2, ",", ".") }}</td>
                  <td style="text-align: left;">{{ date("d-m-Y", $top_up_request['request_time']) }}</td>
                  <td style="text-align: left;">{{ date("d-m-Y", $top_up_request['expire_time']) }}</td>
                  <td style="text-align: center">
                    <a href="/admin/accept?id={{ $top_up_request['id'] }}">
                      <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="accept" value={{ $top_up_request['id'] }}>
                        <i class="material-icons">accept</i>
                      </button> 
                    </a> 
                    <a href="/admin/decline?id={{ $top_up_request['id'] }}">
                      <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="decline" value={{ $top_up_request['id'] }}>
                        <i class="material-icons">decline_forever</i>
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