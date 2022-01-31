<?php include('db_connect.php');?>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Transactions</b>
                        <!-- <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right"
                                href="index.php?page=manage_product" id="new_product">
                                <i class="fa fa-plus"></i> New Entry
                            </a></span> -->
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Img</th>
                                    <th class="">Product Name</th>
                                    <th class="">Other Info</th>
                                    <th class="">Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$i = 1;
								$cat = array();
								$cat[] = '';
								$products = $conn->query("SELECT a.seller_id, a.product_image, a.product_title, a.product_price, b.user_id, b.qty, b.trx_id, b.p_status, b.p_type, b.date_created FROM `products` as a LEFT JOIN `orders` as b ON a.product_id = b.product_id");
								$sales = $conn->query("SELECT SUM(a.product_price) as total_price, SUM(b.qty) as total_qty, a.product_id, a.seller_id, a.product_image, a.product_title, a.product_price, b.qty, b.trx_id, b.p_status, b.p_type, b.date_created FROM `products` as a LEFT JOIN `orders` as b ON a.product_id = b.product_id WHERE a.seller_id=".$_SESSION['login_id']);
                                
                                $total_qty = 0;
                                $total_prices = 0;
                                $total_sales = 0;

                                while($r=$sales->fetch_assoc()):
                                    $total_qty = $r['total_qty'];
                                    $total_prices = $r['total_price'];
                                endwhile;

                                $total_sales = $total_qty * $total_prices;                                
                                
                                ?>
                                <p class="alert alert-info"><b>Total Sales:</b>
                                    ₱<?php echo number_format($total_sales,2) ?></p>
                                <?php

								while($row=$products->fetch_assoc()):
									//TODO:
									// $get = $conn->query("SELECT * FROM bids where product_id = {$row['id']}");
									// $bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0 ;
									// $tbid = $conn->query("SELECT distinct(user_id) FROM bids where product_id = {$row['id']} ")->num_rows;
								?>
                                <?php if($_SESSION['login_id'] == $row['seller_id']): ?>
                                <tr data-id='<?php echo $row['id'] ?>'>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                        <div class="row justify-content-center">
                                            <img src="<?php echo 'assets/uploads/'.$row['product_image'] ?>" alt="">
                                        </div>
                                    </td>
                                    <td class="">
                                        <p><b><?php echo ucwords($row['product_title']) ?></b></p>
                                    </td>
                                    <td class="">
                                        <p><small>Transaction ID: <b><?php echo $row['trx_id'] ?></b></small></p>
                                        <p><small>Quantity: <b><?php echo $row['qty'] ?></b></small></p>
                                        <p><small>Each:
                                                <b><?php echo  number_format((float)($row['product_price']), 2, '.', '') ?></b></small>
                                        </p>
                                        <p><small>Total:
                                                <b>₱<?php echo  number_format((float)($row['product_price'] * $row['qty']), 2, '.', '') ?></b></small>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p><b><?php echo $row['p_type'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary view_user" type="button"
                                            data-id="<?php echo $row['user_id'] ?>">View Buyer Info</button>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>

</div>
<style>
td {
    vertical-align: middle !important;
}

td p {
    margin: unset
}

table td img {
    max-width: 100px;
    max-height: :150px;
}

img {
    max-width: 100px;
    max-height: :150px;
}
</style>
<script>
$(document).ready(function() {
    $('table').dataTable()
})

$('.view_user').click(function() {
    if ($(this).attr('data-id'))
        uni_modal("<i class'fa fa-card-id'></i> Buyer Details", "view_udet.php?id=" + $(this).attr('data-id'))

})
</script>