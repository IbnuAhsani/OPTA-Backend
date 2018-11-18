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
        <div style="padding: 16px;" class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
            <form class="mdl-grid" method="POST" action="/maskapai/save_edit">
                {{ csrf_field() }}
                <div class="mdl-cell--6-col">
                    <div>
                        <label for="bus_number">No. Bus</label> <br>
                        <input type="number" name="bus_number" id="bus-number" value="{{ $bus['bus_number'] }}">
                    </div>

                    <div>
                        <label for="price">Harga</label> <br>
                        <input type="number" name="price" id="bus-price" value="{{ $bus['price'] }}">                
                    </div>

                    <input type="hidden" name="bus_id" id="bus-id" value="{{ $bus['id'] }}">

                </div>
                <div class="mdl-cell--6-col">
                    <label for="route">Rute yang dilewati</label> <br>
                    <ol id="route-list" value=""></ol>
                    <input id="route" type="text"> 
                    <button type="button" id="add-new-route">+</button>
                </div>

                <input type="hidden" name="bus_id" value={{ $bus->id }}>
                <!-- <input type="hidden" name="csrf" id="csrf-token" value{{ csrf_token() }}> -->

                <div id="route-field"></div>

                <div class="mdl-cell--12-col">
                    <button id="save-changes" type="submit">Save</button>
                </div>
            </form>
        </div>
      </div>
    </main>
</div>
<script type="module" src="{{ asset('js/edit_maskapai.js') }}"></script>
@endsection