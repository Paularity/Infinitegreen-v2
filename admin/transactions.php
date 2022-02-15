<?php include('db_connect.php');?>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
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
                                    <th class="">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$i = 1;
								$cat = array();
								$cat[] = '';
								$productSql = "SELECT a.seller_id, a.product_image, a.product_title, a.product_price, b.order_id, b.user_id, b.qty, b.trx_id, b.p_status, b.p_type, b.date_created FROM `orders` as b LEFT JOIN `products` as a ON a.product_id = b.product_id WHERE b.date_created > DATE_SUB(CURDATE(), ";
								$sales = $conn->query("SELECT a.product_price, b.qty FROM `products` as a LEFT JOIN `orders` as b ON a.product_id = b.product_id WHERE a.seller_id=".$_SESSION['login_id']);                                                                
                                
                                $range = isset($_SESSION['currentTrxRange']) ? $_SESSION['currentTrxRange'] : 'month';  

                                switch ($range) {
                                    case "month":
                                        $productSql .= 'INTERVAL 1 MONTH';
                                        $productSql .= ') ORDER BY b.date_created DESC';                                
                                        $products = $conn->query($productSql);
                                        break;
                                    case "year":
                                        $productSql .= 'INTERVAL 1 YEAR';
                                        $productSql .= ') ORDER BY b.date_created DESC';                                
                                        $products = $conn->query($productSql);
                                        break;
                                    //if no match, use week
                                    default:
                                        $productSql .= 'INTERVAL 1 WEEK';
                                        $productSql .= ') ORDER BY b.date_created DESC';                                
                                        $products = $conn->query($productSql);
                                }                                
                                
                                

                                $total_prices = 0;

                                while($r=$sales->fetch_assoc()):
                                    $total_prices += ($r['product_price'] * $r['qty']);                                    
                                endwhile;                              
                                
                                ?>
                                <p class="alert alert-info"><b>Total Sales:</b>
                                    ₱<?php echo number_format(($total_prices),2) ?></p>
                                <div class="btn-group mb-4">
                                    <button data-id="week" type="button"
                                        class="btn-range btn btn-outline-primary <?= $range == 'week' ? 'active' : '' ?>">Weekly</button>
                                    <button data-id="month" type="button"
                                        class="btn-range btn btn-outline-primary <?= $range == 'month' ? 'active' : '' ?>">Monthly</button>
                                    <button data-id="year" type="button"
                                        class="btn-range btn btn-outline-primary <?= $range == 'year' ? 'active' : '' ?>">Yearly</button>
                                </div>
                                <?php                                                
								while($row=$products->fetch_assoc()):
									//TODO:
									// $get = $conn->query("SELECT * FROM bids where product_id = {$row['id']}");
									// $bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0 ;
									// $tbid = $conn->query("SELECT distinct(user_id) FROM bids where product_id = {$row['id']} ")->num_rows;
								?>
                                <?php if($_SESSION['login_id'] == $row['seller_id']|| $_SESSION['login_id'] == 1 ): ?>
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
                                        <?php if($_SESSION['login_id'] == 1): ?>
                                            <p><small>Seller ID: <b><?php echo $row['seller_id'] ?></b></small></p>
                                        <?php endif; ?>
                                        <p><small>Transaction ID: <b><?php echo $row['trx_id'] ?></b></small></p>
                                        <p><small>Transaction Date: <b><?php echo $row['date_created'] ?></b></small>
                                        </p>
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
                                        <?php if ($row['p_status'] == 'Pending'): ?>
                                        <p style="color: #ffc107; font-weight: bold;">Pending</p>
                                        <?php endif; ?>
                                        <?php if ($row['p_status'] == 'Shipped'): ?>
                                        <p style="color: #007bff; font-weight: bold;">Shipped</p>
                                        <?php endif; ?>
                                        <?php if ($row['p_status'] == 'Completed'): ?>
                                        <p style="color: #28a745; font-weight: bold;">Completed</p>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary view_user" type="button"
                                            data-id="<?php echo $row['user_id'] ?>">View Buyer Info</button>
                                        <button class="btn btn-sm btn-outline-info edit_status" type="button"
                                            data-id="<?php echo $row['order_id'] ?>">Edit Status</button>
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

$('.btn-range').click(function() {
    start_load()
    $.ajax({
        url: 'ajax.php?action=filter_transaction',
        method: 'POST',
        data: {range: $(this).attr('data-id')},
        success: function(resp) {
            if (resp == 1) {
                // alert_toast("Data filtered saved", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)
            } else {
                $('#msg').html(
                    '<div class="alert alert-danger">There was an error. Please contact support.</div>'
                    )                
            }
            end_load()
        }
    })
})

$('.view_user').click(function() {
    if ($(this).attr('data-id'))
        uni_modal("<i class'fa fa-card-id'></i> Buyer Details", "view_udet.php?id=" + $(this).attr('data-id'))
})
$('.edit_status').click(function() {
    if ($(this).attr('data-id'))
        uni_modal("<i class'fa fa-card-id'></i> Update Status", "edit_order_status.php?id=" + $(this).attr(
            'data-id'))
})
</script>