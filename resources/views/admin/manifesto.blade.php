{{-- 
Data needed: 
- $manifesto_datas = ['id', 'unique_code', 'nominal', 'request_time', 'expire_time']

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

  #accept:hover {
    color: #4caf50;
  }
  #decline:hover {
    color: #f44336;
  }
</style>
@endsection

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
@include("admin.navbar")
@include("admin.sidebar")
@section('main')
    <main class="mdl-layout__content mdl-color--grey-100">
      <div class="mdl-grid demo-content">

        <div style="padding: 16px; overflow: auto" class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <table style="width: 70%; margin: auto" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
              <thead>
                <tr>
                  <th class="align-center">Trip History ID</th>
                  <th class="align-center">User ID</th>
                  <th class="align-center">Bus ID</th>
                  <th class="align-center">Ticket Price</th>
                  <th class="align-center">On-board Time</th>
                </tr>
              </thead>
              <tbody>
                @foreach($manifesto_datas as $manifesto_data)
                <tr>
                  <td class="align-center">{{ $manifesto_data['id'] }}</td>
                  <td class="align-center">{{ $manifesto_data['user_id'] }}</td>
                  <td class="align-center">{{ $manifesto_data['bus_id'] }}</td>
                  <td class="align-center">{{ $manifesto_data['ticket_price'] }}</td>
                  <td class="align-center">{{ date("d-m-Y H:i:s", $manifesto_data['on_board_time']) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>

      </div>
    </main>
</div>
@endsection