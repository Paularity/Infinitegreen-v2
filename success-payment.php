<?php
include "db.php";

include "header.php";

if(isset($_SESSION['current_gcash_source_id'])){
    $url = 'https://api.paymongo.com/v1/payments';
        // $data = array('key1' => 'value1', 'key2' => 'value2');

        $public_key = 'pk_test_jnCvv3S3fxknkssw1uUwA2wR';
        $secret_key = 'sk_test_JCWt7DwW54K4wSu3PvuUv7wS';
        $data =[ "data" => [
                "attributes" => [
                    "amount" => (float)($_SESSION['current_product_price']),
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
        // echo "<script>console.log('".var_dump($json_a)."');</script>";
        // var_dump($json_a);
        if(isset($_SESSION["uid"])) {
            $paymongoPaymentId = $json_a["data"]["id"];
            $user_id = $_SESSION['uid'];
            $address = $_SESSION['address'];
            $account_name = $_SESSION['fullname'];
            $account_number = $json_a["data"]["attributes"]["billing"]["phone"];
            $total_amt = (float)($_SESSION['current_product_price'])/100;
            $products = $_SESSION['gcash_products'];

            $seller_id = $_SESSION['gcash_seller_id'];				
            $product_id = $_SESSION['gcash_product_id'];
            $qty = $_SESSION['gcash_product_qty'];                        
            
            $sql = "INSERT INTO `order_info_gcash`
            (`order_id`, `user_id`, `address`, `account_name`, `account_number`, `total_amt`) 
            VALUES ('$paymongoPaymentId','$user_id','$address', '$account_name', '$account_number', '$total_amt')";

            $sqlOrders = "INSERT INTO `orders`
            (`product_id`, `seller_id`, `user_id`, `qty`, `trx_id`, `p_status`, `p_type`) 
            VALUES ('$product_id', '$seller_id', '$user_id', '$qty', '$paymongoPaymentId', 'Pending', 'gcash')";
            if(mysqli_query($con,$sqlOrders)){
                unset($_SESSION['gcash_seller_id']);
                unset($_SESSION['gcash_product_id']);
                unset($_SESSION['gcash_product_qty']);
            }

            if(mysqli_query($con,$sql)){
                $del_sql="DELETE from cart where user_id=$user_id";
                if(mysqli_query($con,$del_sql)){

                    // reduce stock
                    foreach( $products as $p) {
                        $sqlP = "UPDATE `products` SET `stock` = ".$p['stock']." WHERE `products`.`product_id` = ".$p['id'].";";
                        mysqli_query($con,$sqlP);
                    }

                    unset($_SESSION['current_gcash_source_id']);
                    unset($_SESSION['current_product_price']);
                    unset($_SESSION['current_gcash_product_description']);
                }else{
                    echo(mysqli_error($con));
                }
                
            }	
        }		
    }
    else if(isset($_SESSION['cod_success']) || isset($_SESSION['card_success'])){
        unset($_SESSION['cod_success']);
        unset($_SESSION['card_success']);
    }
    else{
        echo "<script> location.href='index.php'; </script>";
    }
?>
<style>

h1 {
    color: #88B04B;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
}

p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
}

i {
    color: #9ABC66;
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
}

.card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    margin: 20px auto;
}
</style>
<div style="width: 100%;">
    <div class="card" style="text-align: center;">
        <div style="border-radius:200px; height:200px; width:200px; background: #ccffcc; margin:0 auto;">
            <i class="fa fa-check" style="color: #00cc66;
        font-size: 100px;
        line-height: 200px;
        margin-left: 0;"></i>
        </div>
        <h1>Success</h1>
        <p>We have processed your order successfully!</p>
    </div>
</div>
<?php
include "footer.php";
?>