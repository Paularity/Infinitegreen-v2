<?php
include 'header.php';
?>
<?php 	
	if(!isset($_SESSION['uid'])){
		echo "<script> location.href='index.php'; </script>";
	}
?>
<div class="container" style="margin: 20px auto;">
    <h4>My Orders</h4>
    <hr>
    <table class="table table-condensed table-bordered table-hover">
        <thead>
            <tr>
                <th class="">Img</th>
                <th class="">Product Name</th>
                <th class="">Other Info</th>
                <th class="">Type</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 1;
                $cat = array();
                $cat[] = '';
                $products = $con->query("SELECT a.seller_id, a.product_image, a.product_title, a.product_price, b.user_id, b.qty, b.trx_id, b.p_status, b.p_type, b.date_created FROM `products` as a LEFT JOIN `orders` as b ON a.product_id = b.product_id ORDER BY b.date_created DESC");               
            ?>
            <?php
                while($row=$products->fetch_assoc()):
            ?>
                <?php if($_SESSION['uid'] == $row['user_id']): ?>
                    <tr data-id='<?php echo $row['id'] ?>'>
                        <td class="text-center">
                            <img style="max-width: 150px;" src="<?php echo 'admin/assets/uploads/'.$row['product_image'] ?>" alt="">
                        </td>
                        <td class="">
                            <p><b><?php echo ucwords($row['product_title']) ?></b></p>
                        </td>
                        <td class="">
                            <p><small>Transaction ID: <b><?php echo $row['trx_id'] ?></b></small></p>
                            <p><small>Transaction Date: <b><?php echo $row['date_created'] ?></b></small></p>
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
                    </tr>
                <?php endif; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
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

#uni_modal .modal-footer {
    display: none;
}
</style>
<script>
$(document).ready(function() {
    $('table').dataTable()
})
</script>
<?php
    include "newslettter.php";
    include "footer.php";
?>