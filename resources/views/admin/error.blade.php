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
              <h4 style="text-align: center">Mohon maaf, telah terjadi error pada sistem</h4>
            </div>
            <div style="margin: auto" class="mdl-cell--12-col">
              <h4 style="text-align: center">Mohon dicoba lagi</h4>
            </div>
        </div>
      </div>
    </main>
</div>
@endsection