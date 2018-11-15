{{-- 
Data neede: 
- $buses = ['id', 'price', 'bus_number']

--}}

@extends('maskapai.template')

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
@include("maskapai.header")
@include("maskapai.sidebar")
@section('main')
    <main class="mdl-layout__content mdl-color--grey-100">
      <div class="mdl-grid demo-content">
        <div style="padding: 16px;" class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <table style="width: 70%; margin: auto" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
              <thead>
                <tr>
                  <th style="text-align: left; width: 24px">No. Bus</th>
                  <th style="text-align: left">Price</th>
                </tr>
              </thead>
              <tbody>
                @foreach($buses as $bus)
                <tr>
                  <td style="text-align: right">{{ $bus['bus_number'] }}</td>
                  <td style="text-align: left"><small>Rp</small>{{ number_format($bus['price'], 2, ",", ".") }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </main>
</div>
@endsection