<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
    
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		
            
            <div class='aside'>
							<h3 class='aside-title'>Categories</h3>
							<div class='btn-group-vertical'>
	";
	if(mysqli_num_rows($run_query) > 0){
        $i=1;
		while($row = mysqli_fetch_array($run_query)){
            
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
            $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_cat=$i";
            $query = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($query);
            $count=$row["count_items"];
            $i++;
            
            
			echo "
					
                    <div type='button' class='btn navbar-btn category' cid='$cid'>
									
									<a href='#'>
										<span  ></span>
										$cat_name
										<small class='qty'>($count)</small>
									</a>
								</div>
                    
			";
            
		}
        
        
		echo "</div>";
	}
}
if(isset($_POST["brand"])){
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con,$brand_query);
	echo "
		<div class='aside'>
							<h3 class='aside-title'>Brand</h3>
							<div class='btn-group-vertical'>
	";
	if(mysqli_num_rows($run_query) > 0){
        $i=1;
		while($row = mysqli_fetch_array($run_query)){
            
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];
            $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_brand=$i";
            $query = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($query);
            $count=$row["count_items"];
            $i++;
			echo "
					
                    
                    <div type='button' class='btn navbar-btn selectBrand' bid='$bid'>									
									<a href='#'>
										<span ></span>
										$brand_name
										<small >($count)</small>
									</a>
								</div>";
		}
		echo "</div>";
	}
}

if(isset($_POST["page"])){
	$sql = "SELECT * FROM products";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#product-row' page='$i' id='page' class='active'>$i</a></li>
            
            
		";
	}
}
if(isset($_POST["getProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
            
            $cat_name = $row["cat_title"];
			echo "
				
                        
                        <div class='col-md-4 col-xs-6' >
								<a href='product.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img src='admin/assets/uploads/$pro_image' style='max-height: 170px;' alt=''>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>$pro_price<del class='product-old-price'>₱".$pro_price*1.3."</del></h4>																				
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> add to cart</button>
									</div>
								</div>
							</div>
                        
			";
		}
	}
}


if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products,categories WHERE product_cat = '$id' AND product_cat=cat_id";
        
	}else if(isset($_POST["selectBrand"])){
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM products,categories WHERE product_brand = '$id' AND product_cat=cat_id";
	}else if(isset($_POST["search"])) {        		
		// header('location:store.php');
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products WHERE product_title LIKE '%$keyword%'";   		
	}
	
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){	
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
            $cat_name = isset($row["cat_title"]) ? $row["cat_title"] : '';
			echo "
				<div class='col-md-4 col-xs-6'>
						<a href='product.php?p=$pro_id'><div class='product'>
							<div class='product-img'>
								<img  src='admin/assets/uploads/$pro_image'  style='max-height: 170px;' alt=''>
							</div></a>
							<div class='product-body'>
								<p class='product-category'>$cat_name</p>
								<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
								<h4 class='product-price header-cart-item-info'>$pro_price<del class='product-old-price'>₱".$pro_price*1.3."</del></h4>		
							</div>
							<div class='add-to-cart'>
								<button pid='$pro_id' id='product' href='#' tabindex='0' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button>
							</div>
						</div>
					</div>";
		}
	}
	


	if(isset($_POST["addToCart"])){
		

		$p_id = $_POST["proId"];
		

		if(isset($_SESSION["uid"])){

		$user_id = $_SESSION["uid"];

		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is already added into the cart Continue Shopping..!</b>
				</div>
			";//not in video
		} else {
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','$user_id','1')";
			if(mysqli_query($con,$sql)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is Added..!</b>
					</div>
				";
			}
		}
		}else{
			$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
			$query = mysqli_query($con,$sql);
			if (mysqli_num_rows($query) > 0) {
				echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Product is already added into the cart Continue Shopping..!</b>
					</div>";
					exit();
			}
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','-1','1')";
			if (mysqli_query($con,$sql)) {
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Your product is Added Successfully..!</b>
					</div>
				";
				exit();
			}
			
		}
		
		
		
		
	}

//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
	}else{
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
	}
	
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}
//Count User cart item

//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

	if (isset($_SESSION["uid"])) {
		//When user is logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
	}else{
		//When user is not logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0) {
			$n=0;
			$total_price=0;
			while ($row=mysqli_fetch_array($query)) {
                
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				$total_price=$total_price+$product_price;
				echo '
					
                    
                    <div class="product-widget">
												<div class="product-img">
													<img src="admin/assets/uploads/'.$product_image.'" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">'.$product_title.'</a></h3>
													<h4 class="product-price"><span class="qty">'.$n.'</span>$'.$product_price.'</h4>
												</div>
												
											</div>'
                    
                    
                    ;
				
			}
            
            echo '<div class="cart-summary">
				    <small class="qty">'.$n.' Item(s) selected</small>
				    <h5>$'.$total_price.'</h5>
				</div>'
            ?>


<?php
			
			exit();
		}
	}
	
    
    
    if (isset($_POST["checkOutDetails"])) {		
		if (mysqli_num_rows($query) > 0) {
			//display user cart item with "Ready to checkout" button if user is not login
			echo '<div class="main ">
			<div class="table-responsive">
			<form method="post" action="">
			
	               <table id="cart" class="table table-hover table-condensed" id="">
    				<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:7%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                    ';
				$n=0;
				while ($row=mysqli_fetch_array($query)) {
					$n++;
					$product_id = $row["product_id"];
					$product_title = $row["product_title"];
					$product_price = $row["product_price"];
					$product_image = $row["product_image"];
					$cart_item_id = $row["id"];
					$qty = $row["qty"];

					echo 
						'
                             
						<tr>
							<td data-th="Product" >
								<div class="row">
								
									<div class="col-sm-4 "><img src="admin/assets/uploads/'.$product_image.'" style="height: 70px;width:75px;"/>
									<h4 class="nomargin product-name header-cart-item-name"><a href="product.php?p='.$product_id.'">'.$product_title.'</a></h4>
									</div>
									<div class="col-sm-6">
										<div style="max-width=50px;">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
										</div>
									</div>
									
									
								</div>
							</td>
                            <input type="hidden" name="product_id[]" value="'.$product_id.'"/>
				            <input type="hidden" name="" value="'.$cart_item_id.'"/>
							<td data-th="Price"><input type="text" class="form-control price" value="'.$product_price.'" readonly="readonly"></td>
							<td data-th="Quantity">
								<input type="text" class="form-control qty" value="'.$qty.'" >
							</td>
							<td data-th="Subtotal" class="text-center"><input type="text" class="form-control total" value="'.$product_price.'" readonly="readonly"></td>
							<td class="actions" data-th="">
							<div class="btn-group">
								<a href="#" class="btn btn-info btn-sm update" update_id="'.$product_id.'"><i class="fa fa-refresh"></i></a>
								
								<a href="#" class="btn btn-danger btn-sm remove" remove_id="'.$product_id.'"><i class="fa fa-trash-o"></i></a>		
							</div>							
							</td>
						</tr>
					
                            
                            ';
				}
				
				
				$cardSelected = isset($_SESSION['selected_payment_method']) ? ($_SESSION['selected_payment_method'] == 'card' ?? 'selected') : '';
				$gcashSelected = isset($_SESSION['selected_payment_method']) ? ($_SESSION['selected_payment_method'] == 'gcash' ?? 'selected') : '';
				$codSelected = isset($_SESSION['selected_payment_method']) ? ($_SESSION['selected_payment_method'] == 'cod' ?? 'selected') : '';
				echo '</tbody>
				<tfoot>		
					<tr>
						<div class="row" style="margin-left: 0 !important;">
							<div class="col-md">
								<b>Payment Method</b>
							</div>
							<div class="col-md" style="padding: 24px 0;">
								<a href="javascript:void(0)" id="btn-card" class="btn btn-payment-method '. $cardSelected .'"> Credit / Debit Card </a>
								<a href="javascript:void(0)" id="btn-gcash" class="btn btn-payment-method '. $gcashSelected .'"> Gcash </a>
								<a href="javascript:void(0)" id="btn-cod" class="btn btn-payment-method '. $codSelected .'"> Cash on Delivery </a>
							</div>
						</div>			
						<hr/>
					</tr>
					<tr>
						<td><a href="store.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
						<td colspan="2" class="hidden-xs"></td>
						<td class="hidden-xs text-center"><b class="net_total" ></b></td>
						<div id="issessionset"></div>
                        <td>
							
							';
				if (!isset($_SESSION["uid"])) {
					echo '
					
						<a href="" data-toggle="modal" data-target="#Modal_register" class="btn btn-success">Ready to Checkout</a></td>
					</tr>
				</tfoot>				
				</table></div></div>				
				';
                }else if(isset($_SESSION["uid"])){
					//Paypal checkout form
					echo '
					</form>
					
						<form action="checkout.php" method="post">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="shoppingcart@infinitegreen.com">
							<input type="hidden" name="upload" value="1">';
							  
							$x=0;
							$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
							$query = mysqli_query($con,$sql);
							while($row=mysqli_fetch_array($query)){
								$x++;
								echo  	

									'<input type="hidden" name="total_count" value="'.$x.'">
									<input type="hidden" name="item_name_'.$x.'" value="'.$row["product_title"].'">
								  	 <input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
								     <input type="hidden" name="amount_'.$x.'" value="'.$row["product_price"].'">
								     <input type="hidden" name="quantity_'.$x.'" value="'.$row["qty"].'">';
								}								

							echo   
								'<input type="hidden" name="return" value="http://localhost/myfiles/public_html/payment_success.php"/>
					                <input type="hidden" name="notify_url" value="http://localhost/myfiles/public_html/payment_success.php">
									<input type="hidden" name="cancel_return" value="http://localhost/myfiles/public_html/cancel.php"/>
									<input type="hidden" name="currency_code" value="PHP"/>
									<input type="hidden" name="custom" value="'.$_SESSION["uid"].'"/>
									<input type="submit" id="submit" name="login_user_with_product" name="submit" class="btn btn-success" value="Ready to Checkout">
									</form></td>
									
									</tr>
									
									</tfoot>
									
							</table>
							</div></div>    
								';
				}
			}
	}
	
	
}

//Set Payment Method
if (isset($_POST["updatePaymentMethod"])) {
	$_SESSION['selected_payment_method'] = $_POST['payment_method'];
	return  $_POST['payment_method'];
}

function GUID()
{
	if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}

	return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

//Set GCASH Payment Method
if (isset($_POST["checkoutGcash"])) {
	$generatedId =  $_SESSION['name'] . '_' . $_SESSION['uid'] . '_' . GUID();
	$generateDate = date('m/d/Y h:i:s a', time());
	// PAYMONGO API
	$url = 'https://api.paymongo.com/v1/sources';
	// changeable
	$public_key = 'pk_test_dDMnoENhY29bNe44tEajyA8E';
	$secret_key = 'sk_test_ZMMN26Bfi8f36XFZVRk6Q5Nr';

	$data =[ "data" => [
			"attributes" => [
				//changeable
				"amount" => (float)($_POST['total'])*100,
				"redirect" => [
					// success and invalid page changeable
					"success" => "http://localhost/infinitegreen-v2-store/success-payment.php",
					"failed" => "http://localhost/infinitegreen-v2-store/invalid-payment.php",
				],
				"type" => "gcash",
				"currency" => "PHP",
				"billing" => [
					"name" => $generatedId,
					"phone" => $_POST['accountNumber'],
					"email" => $_SESSION['email']
				]
			]
		]]; 

	$dataText = $data_string = json_encode($data);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_USERPWD, "$secret_key:$secret_key");
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);                                                                     
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')
	); 
	
	
	$resp = curl_exec($curl);
	curl_close($curl);
	$json_a=json_decode($resp,true);    
	
	$generateOrderId = $generatedId."_".$generateDate;
	$user_id = $_SESSION['uid'];
	$address = $_SESSION['address'];
	$account_name = $_SESSION['fullname'];
	$account_number = $_POST['accountNumber'];

	$_SESSION['current_gcash_source_id'] = $json_a['data']['id'];
	$_SESSION['current_product_price'] = (float)($_POST['total'])*100;
	$_SESSION['current_gcash_product_description'] = $json_a['data']['attributes']['billing']['name'] . $json_a['data']['attributes']['created_at'];
	echo $json_a["data"]["attributes"]["redirect"]["checkout_url"];		
	// if( (float)($_POST['total']) >= 100 ){		
	// }
	exit();
}

if(isset($_POST['paymentGcash'])) {
	$url = 'https://api.paymongo.com/v1/payments';
    // $data = array('key1' => 'value1', 'key2' => 'value2');

    $public_key = 'pk_test_dDMnoENhY29bNe44tEajyA8E';
    $secret_key = 'sk_test_ZMMN26Bfi8f36XFZVRk6Q5Nr';
	$data =[ "data" => [
			"attributes" => [
				"amount" => (float)($_SESSION['current_product_price'])*100,
				"source" => [
					"id" => $_SESSION['current_gcash_source_id'],
					"type" => "source"
				],
				"description" => $_SESSION['current_gcash_product_description'],
				"statement_descriptor" => $_SESSION['current_gcash_product_description'],                
				"currency" => "PHP",
			]
		]
		]; 

	$dataText = $data_string = json_encode($data);
	// var_dump(urlencode($dataText));
	// var_dump(($dataText));	
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_USERPWD, "$secret_key:$secret_key");
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);                                                                     
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')
	); 
	
	
	$resp = curl_exec($curl);
	curl_close($curl);
	$json_a=json_decode($resp,true);    
	var_dump($json_a);
	exit();
}

//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is removed from cart</b>
				</div>";
		exit();
	}
}


//Update Item From cart
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];
	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-info'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is updated</b>
				</div>";
		exit();
	}
}
//Send Message
if (isset($_POST["sendMessage"])) {
	$msg = $_POST["msg"];
	$sender_id =$_SESSION["uid"];
	if (isset($sender_id)) {
		$sql = "INSERT INTO `chatlog`
			(`sender_id`, `receiver_id`, `message`) 
			VALUES ('$sender_id','1','$msg')";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-info'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Message Sent!</b>
				</div>";
		exit();
	}
}

//Manage Profile
if(isset($_GET['action']) && $_GET['action'] == 'updateProfile'){
	extract($_POST);
	$data = " last_name = '$last_name' ";
	$data .= ", first_name = '$first_name' ";
	$data .= ", mobile = '$mobile' ";
	$data .= ", address1 = '$address1' ";
	$data .= ", address2 = '$address2' ";
	$data .= ", email = '$email' ";
	if(!empty($password))
	$data .= ", password = '".$password."' ";	
	$sql = "UPDATE user_info set ".$data." where user_id = ".$user_id;
	if($user_id){
		if(mysqli_query($con,$sql)){
			echo 1;
			exit();
		}
	}
	else{
		echo "error";
	}
}

// if(isset($_POST["updateProfile"])) {
// 	$last_name = $_POST['data']['first_name'];

// 	$data = " last_name = '$last_name' ";
// 	$data .= ", first_name = '$first_name' ";
// 	$data .= ", mobile = '$mobile' ";
// 	$data .= ", address1 = '$address1' ";
// 	$data .= ", address2 = '$address2' ";
// 	$data .= ", email = '$email' ";
// 	if(!empty($password))
// 	$data .= ", password = '".md5($password)."' ";		
// 	$chk = $this->db->query("Select * from user_info where email = '$email' and user_id !='$user_id' ")->num_rows;
// 	if($chk > 0){
// 		return 2;
// 		exit;
// 	}
// 	if(empty($user_id)){
// 		$save = $this->db->query("INSERT INTO user_info set ".$data);
// 	}else{
// 		$save = $this->db->query("UPDATE user_info set ".$data." where user_id = ".$user_id);
// 	}
// 	if($save){
// 		return 1;
// 	}
// }




?>