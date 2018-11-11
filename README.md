# OPTA-Backend
Laravel Backend for OPTA (Online Payment for Transportation)

## API Contract
Endpoint | Request Type | Header | Body | Data Returned
:------------: | :------------: | :------------: | :------------: | :------------:
login/ | POST | NULL | ```` POST_BODY{email: String, password: String} ```` | ```` RETURN{token: String, user_id: Int} ```` 
route/ | GET | NULL | NULL | ```` RETURN{id: Int, start_loc: String, end_loc: String, detail : [{Route}]} ```` 
user/{user_id}/ | GET | NULL | NULL | ```` RETURN{id: Int, email: String, name: String, address: String, balance: BigInt, role: TinyInt, created_at: Date, updated_at: Date } ````
user/register/ | POST | NULL | ```` POST_BODY{id: Int, email: String, name: String, address: String, balance: BigInt, role: TinyInt} ```` | ```` RETURN{status_code} ```` 
user/pay/ | POST | NULL | ```` POST_BODY{user_id: Int, bus_id: Int} ```` | ```` RETURN{} ```` 
user/topup/ | POST | NULL | ```` POST_BODY{user_id: Int, nominal: Int} ```` | ```` RETURN{error: String} ```` 
user/balance/ | POST | NULL | ```` POST_BODY{user_id: Int} ```` | ```` RETURN{balance: BigInt} ````       
bus-admin/bus/ | POST | NULL | ```` POST_BODY{bus_id: Int} ```` | ```` RETURN{id: Int, bus_number: SmallInt, price: BigInt, bus_admin_id: Int,created_at: Date, updated_at: Date} ```` 
bus-admin/all/ | POST | NULL | ```` POST_BODY{bus_admin_id: Int} ```` | ```` RETURN{[{Bus}]} ````       
bus-admin/add/ | POST | NULL | ```` POST_BODY{bus_number: SmallInt, price: BigInt. bus_admin_id: Int} ```` | ```` RETURN{status_code} ````       
bus-admin/delete/ | POST | NULL | ```` POST_BODY{bus_id: Int} ```` | ```` RETURN{status_code} ````       
bus-admin/update/ | POST | NULL | ```` POSYT_BODY{bus_id: Int, bus_number: SmallInt, price: BigInt} ```` | ```` RETURN{status_code} ````       
 <!-- |  |  | ```` ```` | ```` ````        --> 