<?php 

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" id="new_seller"><i class="fa fa-plus"></i> New
                Seller/Admin</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
 					include 'db_connect.php';
 					$type = array("Admin","Seller","Buyer");
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $i++ ?>
                            </td>
                            <td>
                                <?php echo ucwords($row['name']) ?>
                            </td>

                            <td>
                                <?php echo $row['username'] ?>
                            </td>
                            <td>
                                <?php echo $type[$row['type']-1] ?>
                            </td>
                            <td>
                                <center>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button"
                                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit_seller" href="javascript:void(0)"
                                                data-id='<?php echo $row['id'] ?>'>Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_seller" href="javascript:void(0)"
                                                data-id='<?php echo $row['id'] ?>'>Delete</a>
                                        </div>
                                    </div>
                                </center>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<script>
$('table').dataTable();
$('#new_seller').click(function() {
    uni_modal('New Admin/Seller', 'manage_sellers.php')
})
$('.edit_seller').click(function() {
    uni_modal('Edit Seller', 'manage_sellers.php?id=' + $(this).attr('data-id'))
})
$('.delete_seller').click(function() {
    _conf("Are you sure to delete this seller?", "delete_seller", [$(this).attr('data-id')])
})

function delete_seller($id) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_seller',
        method: 'POST',
        data: {
            id: $id
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