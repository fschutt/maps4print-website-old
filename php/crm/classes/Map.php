<?
require_once __DIR__ .'/../core/init.php';

/**
* 	Class for getting storing map-related orders and
*/
class Map
{
	public static function getAllMapsAndServices($shoppingCartID){

	}

	//Return: array of maps with services as array (elements may be empty)
	public static function getAllMapsAndServicesFromHash($userHash){
		$_user = new User();

		//select only necessary rows and columns
		//Step 1: Get the user id from the hash
		//Step 2: Get all shopping_carts of the user
		//Step 3: Get all maps of attached to this shopping cart
		//Step 4: Get all service ids attached to the maps

		$sql = "SELECT 
					shopping_carts.id 				AS shp_id,
					map_orders.id 					AS map_id,
					service_orders.id 				AS srv_id,

					map_orders.name 				AS map_name,
					map_orders.date_finished 		AS map_finished,
					map_orders.status 				AS map_status,
					map_orders.width_mm				AS map_width,
					map_orders.height_mm			AS map_height,
					map_orders.scale 				AS map_scale,
					map_orders.north 				AS map_north,
					map_orders.south 				AS map_south,
					map_orders.east 				AS map_east,
					map_orders.west 				AS map_west,

					service_orders.comments 		AS srv_name,
					service_orders.type 			AS srv_type,
					service_orders.date_finished 	AS srv_finished,
					service_orders.status 			AS srv_status,
					service_orders.minutes_billed	AS srv_time


					FROM service_orders
						RIGHT JOIN key_map_to_service ON service_orders.id = key_map_to_service.service_id_once
						RIGHT JOIN map_orders ON key_map_to_service.map_id_many = map_orders.id
						RIGHT JOIN key_shopping_carts_to_maps ON key_shopping_carts_to_maps.map_id_once = map_orders.id 
						RIGHT JOIN shopping_carts ON shopping_carts.id = key_shopping_carts_to_maps.shopping_carts_many
						RIGHT JOIN logged_in_users ON logged_in_users.user_id = shopping_carts.user_id
				WHERE logged_in_users.hash = ?";

		$res = $_user->db->query($sql, array($userHash));

		if($res->error || $res->results == NULL){
			return NULL;
		}else{
			$res = $res->results;
		}

		$data = array(); //array of shopping carts

		//TODO: test this: 2 users, 2 shopping carts with no, one and more orders and 0, 1 and more services
		foreach ($res as $key => $value) {
			if(isset($value->shp_id)){ //shopping cart id must be present
				if(isset($value->map_id)){ //map id must be present
					//check if there is already a map with the same id, don' override it
					if(!isset($data[$value->shp_id][$value->map_id])) {
						$data[$value->shp_id][$value->map_id] = 
						array(
							"map_name" => utf8_encode($value->map_name),
							"map_finished" => $value->map_finished,
							"map_status" => $value->map_status,
							"map_width" => $value->map_width,
							"map_height" => $value->map_height,
							"map_scale" => $value->map_scale,
							"map_north" => $value->map_north,
							"map_south" => $value->map_south,
							"map_east" => $value->map_east,
							"map_west" => $value->map_west
							);
					}

					if(isset($value->srv_id)){ //if there are services, service id is required
						//check if there is already a service (shouldn't happen)
						if(!isset($data[$value->shp_id][$value->map_id]["map_services"][$value->srv_id])) {
							$data[$value->shp_id][$value->map_id]["map_services"][$value->srv_id] = 
							array(
								"srv_name" => utf8_encode($value->srv_name),
								"srv_type" => $value->srv_type,
								"srv_finished" => $value->srv_finished,
								"srv_status" => $value->srv_status,
								"srv_time" => $value->srv_time
								);
						}
					}
				}
			}

			//Shopping cart exists, but has no maps
			$_user->db->query("DELETE * FROM shopping_carts WHERE id = ?", array($value->shp_id));
		}

		$json = json_encode($data);

		if($json){
			return $json;
		}
		
		return NULL;
	}

	public static function getAllMapsFromShoppingCart($id){
		$_db = DB::getInstance();

		$data = $_db->query("SELECT name, status, date_finished, service_ids FROM shopping_carts 
                               INNER JOIN map_orders ON shopping_carts.product_ids = map_orders.id 
                               WHERE shopping_carts.id = ?", array($id));

		if($data->error){
			return NULL;
		}

		$data = $data->results;
		print_r($data);

		return $data;	
	}
}