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
<script type="module">
    const routeList = document.getElementById("route-list")
    const currentRoute = document.getElementById("route")
    const addNewRoute = document.getElementById("add-new-route")
    const routeField = document.getElementById("route-field")
    const saveChange = document.getElementById("save-changes")
    const busNumber = document.getElementById("bus-number")
    const busPrice = document.getElementById("bus-price")
    const meta = document.getElementsByTagName("meta")

    const busId = document.getElementById("bus-id")

    const BUS_ID = {{ $bus->id }}

    const state = {
        route: [],
        busPrice: null,
        busNumber: null,
        busId: null,
        csrfToken: null,
    }

    const getRoutes = async () => {
        try {
            const req = await fetch(`/maskapai/routes?bus_id=${BUS_ID}`, {
                method: "GET"
            })
            const res = await req.json()
            console.log(res)
            // state.route = res.map(el => el.location_name)
            state.route = [...res]
            console.log("state", state)

            setRouteList(state.route)

        } catch (error) {
            console.log("error", error)
        }
    }

    const setRouteList = (routes) => {
        // show the current list
        const routeList = document.getElementById("route-list")
        while(routeList.firstChild) {
            routeList.removeChild(routeList.firstChild)
        }

        routes.forEach(el => {
            const itemList = document.createElement("li")
            const itemContent = document.createTextNode(el.location_name)
            itemList.appendChild(itemContent)
            routeList.appendChild(itemList)
        })

    }

    const setRouteField = (routes) => {
        const routeField = document.getElementById("route-field")

        while(routeField.firstChild) {
            routeField.removeChild(routeField.firstChild)
        }

        // create new input element
        // and append it to the route filed
        routes.forEach(el => {
            const newRoute = document.createElement("input")
            newRoute.value = el
            newRoute.name = "routes[]"
            newRoute.type = "hidden"

            routeField.appendChild(newRoute)
            routeField
        });
    }

    const addInputRoute = (event) => {
        event.preventDefault();

        let lastQueue = 0
        if(state.route.length > 0) {
            console.log("state.route.length", state.route.length)
            lastQueue = state.route[state.route.length-1].queue
        }
        // mutate state
        state.route.push({
            id: null,
            queue: (lastQueue + 1),
            location_name: currentRoute.value
        })

        // show the current list
        setRouteList(state.route)
        console.log("currentRoute", currentRoute.value)
        
        // empty routeField
        while(routeField.firstChild) {
            routeField.removeChild(routeField.firstChild)
        }
        setRouteField(state.route)

        console.log("state", state)
        currentRoute.value = ""
    }

    const handleSave = async (event) => {
        event.preventDefault()
        console.log("handleEvent; state: ", state)
        // sent ajax request
        try {
            const req = await fetch("/maskapai/save_edit", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': state.csrfToken,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    "bus_number": state.busNumber,
                    "price": state.busPrice,
                    "routes": state.route,
                    "bus_id": state.busId,
                })
            })

            const res = await req.json()
            console.log("save res", res)             
            Location.reload(true); 
        } catch (error) {
            console.log("error", error)
            Location.reload(true);             
        }

    }

    const handleBusNumber = (event) => {
        console.log("busNumber", event.target.value)
        state.busNumber = event.target.value
    }

    const handleBusPrice = (event) => {
        console.log("busPrice", event.target.value)
        state.busPrice = event.target.value
    }

    const handleBusId = (event) => {
        console.log("busId", event.target.value)
        state.busId = event.target.value
    }

    const handleCrsfToken = (event) => {
        console.log("csrfToken", event.target.value)
        state.csrfToken = event.target.value
    }

    window.onload = () => {
        getRoutes()
        addNewRoute.onclick = addInputRoute
        saveChange.onclick = handleSave
        busNumber.onkeyup = handleBusNumber
        busPrice.onkeyup = handleBusPrice
        
        state.busNumber = parseInt(busNumber.value)
        state.busPrice = parseFloat(busPrice.value)
        state.busId = parseInt(busId.value, 10)
        // csrfToken.onchage = handleCrsfToken
        state.csrfToken = meta[3].content
    }
</script>
@endsection