@extends('maskapai.template')

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
@include("maskapai.header")
@include("maskapai.sidebar")
@section('main')
    <main class="mdl-layout__content mdl-color--grey-100">
      <div class="mdl-grid demo-content">
        <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <!-- empty icons -->
            <div style="margin: auto" class="mdl-cell--12-col">
              <h4 style="text-align: center"><i>Belum ada bus</i></h4>
            </div>
            <table style="width: 70%; margin: auto" class="mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--2dp">
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
              </tbody>
            </table>
        </div>
      </div>
    </main>
</div>
@endsection