<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;
	private $currentUserId;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		
			extract($_POST);		
			$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}

				if($_SESSION['login_type'] == 3){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
					$this->currentUserId = $_SESSION['login_id'];					
					return 1;
			}else{
				return 3;
			}
	}
	function login2(){
		
			extract($_POST);		
			$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
				if($_SESSION['login_type'] == 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
					return 1;
			}else{
				return 3;
			}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$data = " last_name = '$last_name' ";
		$data .= ", first_name = '$first_name' ";
		$data .= ", mobile = '$mobile' ";
		$data .= ", address1 = '$address1' ";
		$data .= ", address2 = '$address2' ";
		$data .= ", email = '$email' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";		
		$chk = $this->db->query("Select * from user_info where email = '$email' and user_id !='$user_id' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
		if(empty($user_id)){
			$save = $this->db->query("INSERT INTO user_info set ".$data);
		}else{
			$save = $this->db->query("UPDATE user_info set ".$data." where user_id = ".$user_id);
		}
		if($save){
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM user_info where user_id = ".$user_id);
		if($delete)
			return 1;
	}
	
	function signup(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", address = '$address' ";
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = 3";
		$chk = $this->db->query("SELECT * FROM users where username = '$username' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$login = $this->login2();
				if($login)
				return $login;
		}
	}
	function update_account(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' and id != '{$_SESSION['login_id']}' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("UPDATE users set $data where id = '{$_SESSION['login_id']}' ");
		if($save){
			$data = '';
			foreach($_POST as $k => $v){
				if($k =='password')
					continue;
				if(empty($data) && !is_numeric($k) )
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			if($_FILES['img']['tmp_name'] != ''){
							$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
							$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
							$data .= ", avatar = '$fname' ";

			}
			$save_alumni = $this->db->query("UPDATE alumnus_bio set $data where id = '{$_SESSION['bio']['id']}' ");
			if($data){
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				$login = $this->login2();
				if($login)
				return 1;
			}
		}
	}

	function save_seller(){
		extract($_POST);

		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", address = '$address' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = '$type' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}
		if($save){
			return 1;
			exit();
		}
		return 2;
		exit();
	}	

	function delete_seller(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}

	function save_settings(){
		extract($_POST);
		$data = " name = '".str_replace("'","&#x2019;",$name)."' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['system'][$key] = $value;
		}

			return 1;
				}
	}

	
	function save_category(){
		extract($_POST);
		$data = " cat_title = '$cat_title' ";
			if(empty($cat_id)){
				$save = $this->db->query("INSERT INTO categories set $data");
			}else{
				$save = $this->db->query("UPDATE categories set $data where cat_id = $cat_id");
			}
		if($save)
			return 1;
	}
	function delete_category(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM categories where cat_id = ".$cat_id);
		if($delete){
			return 1;
		}
	}
	function save_brand(){
		extract($_POST);
		$data = " brand_title = '$brand_title' ";
			if(empty($brand_id)){
				$save = $this->db->query("INSERT INTO brands set $data");
			}else{
				$save = $this->db->query("UPDATE brands set $data where brand_id = $brand_id");
			}
		if($save)
			return 1;
	}
	function delete_brand(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM brands where brand_id = ".$brand_id);
		if($delete){
			return 1;
		}
	}
	function save_product(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('product_id','product_image')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		
		if(empty($product_id)){
			$save = $this->db->query("INSERT INTO products set $data");
			$product_id = $this->db->insert_id;
		}else{
			$save = $this->db->query("UPDATE products set $data where product_id = $product_id");
		}

		if($save){
			if($_FILES['product_image']['tmp_name'] != ''){
			$ftype= explode('.',$_FILES['product_image']['name']);
			$ftype= end($ftype);
			$product_image =$product_id.'.'.$ftype;
			if(is_file('assets/uploads/'. $product_image))
				unlink('assets/uploads/'. $product_image);
			$move = move_uploaded_file($_FILES['product_image']['tmp_name'],'assets/uploads/'. $product_image);
			$save = $this->db->query("UPDATE products set product_image='$product_image' where product_id = $product_id");
			}
			return 1;
		}
	}
	function delete_product(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM products where product_id = ".$product_id);
		if($delete){
			return 1;
		}
	}
	function get_latest_bid(){
		extract($_POST);
		$get = $this->db->query("SELECT * FROM bids where product_id = $product_id order by bid_amount desc limit 1 ");
		$bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0 ;
		return $bid;
	}
	function save_bid(){
		extract($_POST);
		$data = "";
		$chk = $this->db->query("SELECT * FROM bids where product_id = $product_id order by bid_amount desc limit 1 ");
		$uid = $chk->num_rows > 0 ? $chk->fetch_array()['user_id'] : 0 ;
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
					$data .= ", user_id='{$_SESSION['login_id']}' ";

		if($uid == $_SESSION['login_id']){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO bids set ".$data);
		}else{
			$save = $this->db->query("UPDATE bids set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_book(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM books where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function get_booked_details(){
		extract($_POST);
		$qry = $this->db->query("SELECT b.*,c.brand, c.model FROM books b inner join cars c on c.id = b.car_id where b.id = $id ")->fetch_array();
		$data = array();
		foreach($qry as $k=>$v){
			if(!is_numeric($k))
			$data[$k]= $v;
		}
			return json_encode($data);
	}
	function save_movement(){
		extract($_POST);
		$data = " booked_id = '$book_id' ";
		$data .= ", car_id = '$car_id' ";

		if(empty($id)){
			$save = $this->db->query("INSERT INTO borrowed_cars set ".$data);
			if($save){
				$data = " car_registration_no = '$car_registration_no' ";
				$data .= ", car_plate_no = '$car_plate_no' ";
				$this->db->query("UPDATE books set $data where id = $book_id");
			}
		}else{
		$data .= ", status = '$status' ";
			$save = $this->db->query("UPDATE borrowed_cars set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_movement(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM borrowed_cars where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_event(){
		extract($_POST);
		$data = " title = '$title' ";
		$data .= ", schedule = '$schedule' ";
		$data .= ", content = '".htmlentities(str_replace("'","&#x2019;",$content))."' ";
		if($_FILES['banner']['tmp_name'] != ''){
						$_FILES['banner']['name'] = str_replace(array("(",")"," "), '', $_FILES['banner']['name']);
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['banner']['name'];
						$move = move_uploaded_file($_FILES['banner']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", banner = '$fname' ";

		}
		if(empty($id)){

			$save = $this->db->query("INSERT INTO events set ".$data);
		}else{
			$save = $this->db->query("UPDATE events set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_event(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM events where id = ".$id);
		if($delete){
			return 1;
		}
	}
	
	function participate(){
		extract($_POST);
		$data = " event_id = '$event_id' ";
		$data .= ", user_id = '{$_SESSION['login_id']}' ";
		$commit = $this->db->query("INSERT INTO event_commits set $data ");
		if($commit)
			return 1;

	}

	function send_message(){
		extract($_POST);
		$data = " sender_id = '$sender_id' ";
		$data .= ", receiver_id = '$receiver_id' ";
		$data .= ", message = '$message' ";

		if(empty($sender_id)){
			return 2;
		}else{
			$save = $this->db->query("INSERT INTO chatlog set $data");
		}

		if($save)
			return 1;		
	}
	
	function update_order_status(){
		extract($_POST);
		if(empty($order_id)){
			return 2;
		}else{
			$save = $this->db->query("UPDATE orders SET p_status = '".$p_status."' WHERE order_id=".$order_id);
		}
		if($save)
			return 1;
	}
}