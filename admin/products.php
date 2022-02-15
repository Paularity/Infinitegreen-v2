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
                        <b>List of Products</b>
                        <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right"
                                href="index.php?page=manage_product" id="new_product">
                                <i class="fa fa-plus"></i> New Entry
                            </a></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Img</th>
                                    <th class="">Remaining Stock</th>
                                    <th class="">Product</th>
                                    <th class="">Other Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$i = 1;
								$cat = array();
								$cat[] = '';
								$products = $conn->query("SELECT * FROM products as p LEFT JOIN categories as c ON p.product_cat = c.cat_id LEFT JOIN brands as b ON b.brand_id = p.product_brand order by p.product_title ASC");
								while($row=$products->fetch_assoc()):
									//TODO:
									// $get = $conn->query("SELECT * FROM bids where product_id = {$row['id']}");
									// $bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0 ;
									// $tbid = $conn->query("SELECT distinct(user_id) FROM bids where product_id = {$row['id']} ")->num_rows;
								?>
                                <?php if($_SESSION['login_id'] == $row['seller_id'] || $_SESSION['login_id'] == 1 ): ?>
									<tr data-id='<?php echo $row['id'] ?>'>
										<td class="text-center"><?php echo $i++ ?></td>
										<td class="">
											<div class="row justify-content-center">
												<img src="<?php echo 'assets/uploads/'.$row['product_image'] ?>" alt="">
											</div>
										</td>
										<td class="text-center">
											<p> <b><?php echo $row['stock'] ?></b></p>
										</td>
										<td class="">
											<p><b><?php echo ucwords($row['product_title']) ?></b></p>
										</td>
										<td class="">
											<?php if($_SESSION['login_id'] == 1): ?>
                                                <p><small>Seller ID: <b><?php echo $row['seller_id'] ?></b></small></p>
                                            <?php endif; ?>
											<p><small>Description: <b><?php echo $row['product_desc'] ?></b></small></p>
											<p><small>Category: <b><?php echo $row['cat_title'] ?></b></small></p>
											<p><small>Brand: <b><?php echo $row['brand_title'] ?></b></small></p>
											<p><small>Price: <b>₱<?php echo $row['product_price'] ?></b></small></p>
										</td>
										<td class="text-center">
											<button class="btn btn-sm btn-outline-primary edit_product" type="button"
												data-id="<?php echo $row['product_id'] ?>">Edit</button>
											<button class="btn btn-sm btn-outline-danger delete_product" type="button"
												data-id="<?php echo $row['product_id'] ?>">Delete</button>
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

$('.view_product').click(function() {
    uni_modal("product Details", "view_product.php?id=" + $(this).attr('data-id'), 'mid-large')

})
$('.edit_product').click(function() {
    location.href = "index.php?page=manage_product&id=" + $(this).attr('data-id')

})
$('.delete_product').click(function() {
    _conf("Are you sure to delete this product?", "delete_product", [$(this).attr('data-id')])
})

function delete_product($product_id) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_product',
        method: 'POST',
        data: {
            product_id: $product_id
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)

            }
        }
    })
}
</script>