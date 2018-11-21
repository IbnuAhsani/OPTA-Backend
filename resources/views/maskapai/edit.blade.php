{{-- 
Data needed: 
- $buses = ['id', 'price', 'bus_number']

--}}

@extends('maskapai.template')

@section("style")
<style>
    .edit-button:hover {
        cursor: pointer;
        opacity: 0.5;
    }
    .input-field {
        border: 1px solid #ccc;
        padding: 8px;
        border-radius: 5px;
    }
    .container {
        padding: 8px;
    }

    #save-changes {
        background: #03a9f4;
        color: #fff;
        border: 1px solid #03a9f4;
        border-radius: 5px;
    }
</style>
@endsection

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
@include("maskapai.navbar")
@include("maskapai.sidebar")
@section('main')
    <main class="mdl-layout__content mdl-color--grey-100">
      <div class="mdl-grid demo-content">
        <div style="padding: 16px;" class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
            <form class="mdl-grid" method="POST" action="/maskapai/save_edit">
                {{ csrf_field() }}

                <div class="mdl-cell--5-col mdl-grid container">
                    <div class="mdl-cell--12-col">
                        <h4 for="route">Rute yang dilewati</h4>

                        <label for="route">Tambah Rute</label> <br>
                        <input class="input-field" id="route" type="text"> 
                        
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" type="button" id="add-new-route">
                            <i class="material-icons">add</i>
                        </button>
                    </div>

                    <div class="mdl-cell--12-col">
                        <ol id="route-list" class="mdl-list"></ol>
                    </div>

                </div>

                <div class="mdl-layout-spacer"></div>

                <div class="mdl-cell--6-col container">
                    <h4>Bus</h4>
                    <div>
                        <label for="bus_number">No. Bus</label> <br>
                        <input class="input-field" type="number" name="bus_number" id="bus-number" value="{{ $bus['bus_number'] }}">
                    </div>
                    
                    <br>

                    <div>
                        <label for="price">Harga</label> <br>
                        <input class="input-field" type="number" name="price" id="bus-price" value="{{ $bus['price'] }}">                
                    </div>

                    <br>

                    <button id="save-changes" type="submit" class="mdl-button mmdl-js-ripple-effect">
                        <span>simpan</span>
                        <i class="material-icons">save</i>
                    </button>

                    <input type="hidden" name="bus_id" id="bus-id" value="{{ $bus['id'] }}">
                </div>

                <input type="hidden" name="bus_id" value={{ $bus->id }}>
            </form>
        </div>
      </div>
    </main>
</div>
<script type="module" src="{{ asset('js/edit_maskapai.js') }}"></script>
@endsection