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
                        <b>Messages</b>
                        <span class="float:right"><button class="btn btn-primary btn-block btn-sm col-sm-2 float-right new_message">
                                <i class="fa fa-plus"></i> New Message
                            </button></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="">Name</th>
                                    <th class="" style="width: 30%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include 'db_connect.php';
                                    $msgs = $conn->query("SELECT c.receiver_id as receiver_id, c.sender_id as sender_id, sender.name as sender, receiver.name as receiver, c.date_created, COUNT(c.message) as total_messages FROM `chatlog` as c LEFT JOIN users as sender ON c.sender_id = sender.id LEFT JOIN users as receiver ON c.receiver_id = receiver.id GROUP BY sender.id,receiver.id");
                                    while($row = $msgs->fetch_assoc()):                                        
                                ?>                                
                                <?php if($_SESSION['login_id'] == $row['receiver_id']): ?>
                                <tr>
                                    <td>
                                        <p><?php echo $_SESSION['login_id'] == $row['receiver_id'] ? $row['sender'] : $row['receiver'] ?></p>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary show_messages" type="button"
                                            data-id="<?php echo $row['sender_id'] ?>">Show Messages <span
                                                class="badge badge-pill badge-danger"><?php echo $row['total_messages']; ?></span></button>
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

    $('.show_messages').click(function() {
        location.href = "index.php?page=manage_messages&id=" + $(this).attr('data-id')
        // uni_modal("Message", "manage_messages.php?id=" + $(this).attr('data-id'), 'mid-large')
    })

    $('.new_message').click(function() {
        uni_modal("New Message", "new_message.php", 'mid-large')
    })
})



// $('.view_product').click(function() {
//     uni_modal("product Details", "view_product.php?id=" + $(this).attr('data-id'), 'mid-large')

// })
// $('.edit_product').click(function() {
//     location.href = "index.php?page=manage_product&id=" + $(this).attr('data-id')

// })
// $('.delete_product').click(function() {
//     _conf("Are you sure to delete this product?", "delete_product", [$(this).attr('data-id')])
// })

// function delete_product($id) {
//     start_load()
//     $.ajax({
//         url: 'ajax.php?action=delete_product',
//         method: 'POST',
//         data: {
//             id: $id
//         },
//         success: function(resp) {
//             if (resp == 1) {
//                 alert_toast("Data successfully deleted", 'success')
//                 setTimeout(function() {
//                     location.reload()
//                 }, 1500)

//             }
//         }
//     })
// }
</script>