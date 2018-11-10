# OPTA-Backend
Laravel Backend for OPTA (Online Payment for Transportation)

## API Contract
Endpoint | Request Type | Header | Body | Data Returned
:------------: | :------------: | :------------: | :------------: | :------------:
login/ | POST | NULL | ```` POST_BODY{email: String, password: String} ```` | ```` RETURN{token: String, user_id: Int} ```` 
user/{user_id} | GET | NULL | NULL | ```` RETURN{id: Int, email: String, name: String, address: String, balance: BigInt, role: TinyInt, created_at: Date, updated_at: Date } ````
route/ | GET | NULL | NULL | ```` RETURN{id: Int, start_loc: String, end_loc: String, detail : [{route_data}]} ```` 
user/register | POST | NULL | ```` POST_BODY{id: Int, email: String, name: String, address: String, balance: BigInt, role: TinyInt} ```` | ```` RETURN{status_code} ```` 
user/pay | POST | NULL | ```` POST_BODY{user_id: Int, bus_id: Int} ```` | ```` RETURN{} ```` 
user/topup | POST | NULL | ```` POST_BODY{user_id: Int, nominal: Int} ```` | ```` RETURN{error: String} ```` 
bus{bus_id} | POST | NULL | NULL | ```` RETURN{id: Int, bus_number: SmallInt, price: BigInt, bus_admin_id: Int,created_at: Date, updated_at: Date} ```` 
 |  | | ```` ```` | ```` ````       