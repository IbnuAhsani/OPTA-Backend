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
                  <th style="text-align: left;">No. <br> Bus</th>
                  <th style="text-align: left">Price</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <form id="add_bus" method="POST" action="/maskapai/add_bus">
                    {{ csrf_field() }}
                    <td style="text-align: left">
                      <input style="width: 50px" type="number" name="bus_number" id="bus_number">
                    </td>
                    <td style="text-align: left">
                      <small>Rp</small> <input type="number" name="price" id="price">
                    </td>
                    <td>
                      <button id="btn_add">+</button>
                    </td>
                  </form>
                </tr>
                @foreach($busses as $bus)
                <tr>
                  <td style="text-align: left">{{ $bus['bus_number'] }}</td>
                  <td style="text-align: left"><small>Rp</small>{{ number_format($bus['price'], 2, ",", ".") }}</td>
                  <td>
                    <button id="edit" value={{ $bus['id'] }}>edit</button> 
                    <button id="delete" value={{ $bus['id'] }}>-</button>
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