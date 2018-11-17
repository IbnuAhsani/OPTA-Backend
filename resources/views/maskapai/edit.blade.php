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
                        <input type="number" name="bus_number" id="bus_number" value="{{ $bus['bus_number'] }}">
                    </div>

                    <div>
                        <label for="price">Harga</label> <br>
                        <input type="number" name="price" id="price" value="{{ $bus['price'] }}">                
                    </div>

                    <input type="hidden" name="bus_id" value="{{ $bus['id'] }}">

                </div>
                <div class="mdl-cell--6-col">
                    <label for="route">Rute yang dilewati</label> <br>
                    <ol id="route-list" value="">
                        @foreach($routes as $route)
                            <li value="{{ $route->queue }}">{{ $route->location_name }}</li>
                        @endforeach
                    </ol>
                    <input id="route" type="text"> 
                    <button type="button" id="add-new-route">+</button>
                </div>

                <input type="hidden" name="bus_id" value={{ $bus->id }}>

                <div id="route-field"></div>

                <div class="mdl-cell--12-col">
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
      </div>
    </main>
</div>
<script type="module">
    const routeList = document.getElementById("route-list")
    const currentRoute = document.getElementById("route")
    const addNewRoute = document.getElementById("add-new-route")
    const routeField = document.getElementById("route-field")

    const state = {
        route: []
    }

    const addInputRoute = (event) => {
        event.preventDefault();

        // mutate state
        state.route.push(route.value)
        
        // show the current list
        const itemList = document.createElement("li")
        const itemContent = document.createTextNode(currentRoute.value)
        const routeList = document.getElementById("route-list")
        itemList.appendChild(itemContent)
        routeList.appendChild(itemList)

        console.log("currentRoute", currentRoute.value)

        // empty routeField
        while(routeField.firstChild) {
            routeField.removeChild(routeField.firstChild)
        }

        // create new input element
        // and append it to the route filed
        state.route.forEach(el => {
            const newRoute = document.createElement("input")
            newRoute.value = el
            newRoute.name = "routes[]"
            newRoute.type = "hidden"

            routeField.appendChild(newRoute)
            routeField
        });

        currentRoute.value = ""
        console.log("state", state)
    }

    window.onload = () => {
        addNewRoute.onclick = addInputRoute
    }
</script>
@endsection