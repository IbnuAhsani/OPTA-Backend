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

  #add:hover {
    color: #2196f3;
  }

</style>
@endsection

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
            <table style="width: 70%; margin: auto" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
              <thead>
                <tr>
                  <th style="text-align: left;">No. Bus</th>
                  <th style="text-align: left">Price</th>
                  <th style="text-align: center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr style="background: #f5f5f5">
                  <form id="add_bus" method="POST" action="/maskapai/add_bus">
                    {{ csrf_field() }}
                    <td style="text-align: left">
                      <input class="input_add" style="width: 50px" type="number" name="bus_number" id="bus_number">
                    </td>
                    <td style="text-align: left">
                      <small>Rp</small> <input class="input_add" type="number" name="price" id="price">
                    </td>
                    <td style="text-align: center">
                      <a>
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="add">
                          <i class="material-icons">add</i>
                        </button>
                      </a>
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