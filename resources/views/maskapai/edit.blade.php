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
            <form action="/maskapai/save_edit">
                <div>
                    <label for="bus_number">No. Bus</label>
                    <input type="number" name="bus_number" id="bus_number" value="{{ $bus['bus_number'] }}">
                </div>

                <div>
                    <label for="price">Harga</label>
                    <input type="number" name="price" id="price" value="{{ $bus['price'] }}">                
                </div>

                <input type="hidden" name="bus_id" value="{{ $bus['id'] }}">

                <button type="submit">Save</button>
            </form>
        </div>
      </div>
    </main>
</div>
@endsection