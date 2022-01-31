<?php
include "db.php";

include "header.php";

    if(isset($_SESSION['current_gcash_source_id'])) {
        unset($_SESSION['current_gcash_source_id']);
        unset($_SESSION['current_product_price']);
        unset($_SESSION['current_gcash_product_description']);
    }
    else{
        echo "<script> location.href='index.php'; </script>";
    }
?>
<style>
h1 {
    color: #FF5733;
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
    color: #FF5733;
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
}

.card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    margin: auto;
}
</style>
<div style="width: 100%;">
    <div class="card" style="text-align: center;">
        <div style="border-radius:200px; height:200px; width:200px; background: #FFDDD5; margin:0 auto;">
            <i class="fa fa-times" style="color: #FF5733;
        font-size: 100px;
        line-height: 200px;
        margin-left: 0;"></i>
        </div>
        <h1>Invalid</h1>
        <p>Your payment is invalid! Try again.</p>
    </div>
</div>
<?php
include "footer.php";
?>