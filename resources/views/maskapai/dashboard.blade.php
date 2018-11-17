{{-- 
Data needed: 
- $buses = ['id', 'price', 'bus_number']

--}}

@extends('maskapai.template')

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
@include("maskapai.header")
@include("maskapai.sidebar")
@section('main')
    <main class="mdl-layout__content mdl-color--grey-100">
      <div class="mdl-grid demo-content">

        <div style="padding: 16px;" class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <table style="width: 70%; margin: auto" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
              <thead>
                <tr>
                  <th style="text-align: left;">No. Bus</th>
                  <th style="text-align: left">Price</th>
                  <th style="text-align: center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr style="background: #ccc">
                  <form id="add_bus" method="POST" action="/maskapai/add_bus">
                    {{ csrf_field() }}
                    <td style="text-align: left">
                      <input style="width: 50px" type="number" name="bus_number" id="bus_number">
                    </td>
                    <td style="text-align: left">
                      <small>Rp</small> <input type="number" name="price" id="price">
                    </td>
                    <td style="text-align: center">
                      <button id="btn_add">+</button>
                    </td>
                  </form>
                </tr>
                @foreach($busses as $bus)
                <tr>
                  <td style="text-align: left">{{ $bus['bus_number'] }}</td>
                  <td style="text-align: left"><small>Rp</small>{{ number_format($bus['price'], 2, ",", ".") }}</td>
                  <td style="text-align: center">
                    <a href="/maskapai/edit?id={{ $bus['id'] }}">
                      <button id="edit" value={{ $bus['id'] }}>
                        edit
                      </button> 
                    </a> 
                    <a href="/maskapai/delete?id={{ $bus['id'] }}">
                      <button id="delete" value={{ $bus['id'] }}>
                        -
                      </button>
                    </a>
                    <a href="/maskapai/download_qr?bus_id={{ $bus['id'] }}">
                      <button id="download_qr" value={{ $bus['id'] }}>
                        QR
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