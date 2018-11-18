const state = {
    route: [],
    busPrice: null,
    busNumber: null,
    busId: null,
    csrfToken: null,
}

const getRoutes = async () => {
    try {
        const req = await fetch(`/maskapai/routes?bus_id=${state.busId}`, {
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
    const routeField = document.getElementById("route-field")
    const currentRoute = document.getElementById("route")

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
        window.location.reload(true); 
    } catch (error) {
        console.log("error", error)
        window.location.reload(true);             
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
    const busId = document.getElementById("bus-id")
    const routeList = document.getElementById("route-list")
    const currentRoute = document.getElementById("route")
    const addNewRoute = document.getElementById("add-new-route")
    const routeField = document.getElementById("route-field")
    const saveChange = document.getElementById("save-changes")
    const busNumber = document.getElementById("bus-number")
    const busPrice = document.getElementById("bus-price")
    const meta = document.getElementsByTagName("meta")

    addNewRoute.onclick = addInputRoute
    saveChange.onclick = handleSave
    busNumber.onkeyup = handleBusNumber
    busPrice.onkeyup = handleBusPrice
    
    state.busNumber = parseInt(busNumber.value)
    state.busPrice = parseFloat(busPrice.value)
    state.busId = parseInt(busId.value, 10)
    // csrfToken.onchage = handleCrsfToken
    state.csrfToken = meta[3].content

    getRoutes()
}