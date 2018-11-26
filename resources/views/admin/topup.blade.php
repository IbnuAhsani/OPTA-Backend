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

  .align-center {
    text-align: center !important;
  }

  .align-left {
    text-align: left !important;
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
                  <th class="align-center">Top Up ID</th>
                  <th class="align-center">User ID</th>
                  <th class="align-center">Unique Code</th>
                  <th class="align-center">Nominal</th>
                  <th class="align-center">Transfer Nominal</th>
                  <th class="align-center">Request Time</th>
                  <th class="align-center">Expire Time</th>
                  <th class="align-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($top_up_requests as $top_up_request)
                <tr>
                  <td class="align-center">{{ $top_up_request['id'] }}</td>
                  <td class="align-center">{{ $top_up_request['user_id'] }}</td>
                  <td class="align-center">{{ $top_up_request['unique_code'] }}</td>
                  <td class="align-left"><small>Rp</small>{{ number_format($top_up_request['nominal'], 2, ",", ".") }}</td>
                  <td class="align-left"><small>Rp</small>{{ number_format($top_up_request['nominal'] + $top_up_request['unique_code'] , 2, ",", ".") }}</td>
                  <td class="align-center">{{ date("d-m-Y", $top_up_request['request_time']) }}</td>
                  <td class="align-center">{{ date("d-m-Y", $top_up_request['expire_time']) }}</td>
                  <td class="align-center">
                    @if($top_up_request['accepted_status'] == 0)
                    <a href="/admin/top_up/accept?id={{ $top_up_request['id'] }}">
                      <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="accept" value={{ $top_up_request['id'] }}>
                        <i class="material-icons">done</i>
                      </button> 
                    </a> 
                    @else
                    <a href="/admin/top_up/accept?id={{ $top_up_request['id'] }}">
                      <button disabled class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="accept" value={{ $top_up_request['id'] }}>
                        <i class="material-icons">check_circle</i>
                      </button> 
                    </a> 
                    @endif

                    <a href="/admin/top_up/decline?id={{ $top_up_request['id'] }}">
                      <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="decline" value={{ $top_up_request['id'] }}>
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