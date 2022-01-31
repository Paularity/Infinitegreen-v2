<?php 
include('db_connect.php');
session_start();
// if(isset($_GET['id'])){
	$users = $conn->query("SELECT id,name FROM users;");
    // $sendTo = '';
	// foreach($msgs->fetch_array() as $k =>$v){
	// 	$meta[$k] = $v;
	// }
// }
?>
<style>
#uni_modal .modal-footer {
    display: none;
}
</style>
<div class="container-fluid">
    <div class="row p-4 bg-light">
        <div class="col-md-12">
            <div id="msg"></div>
            <form action="" id="send-message">
                <input type="hidden" name="sender_id" value="<?php echo isset($_SESSION['login_id']) ? $_SESSION['login_id']: '' ?>">
                <div class="row">
                    To:&nbsp;
                    <select name="receiver_id" class="form-select form-select-lg" required>
                        <option selected value="">Select Contact</option>
                        <?php while($row = $users->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="row mt-4">
                    <textarea name="message" placeholder="Enter a message..." class="form-control" required></textarea>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 ml-auto">
                        <button class="btn btn-primary" type="submit">Send</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>                
            </form>
        </div>
    </div>
</div>
<script>
    $('#send-message').submit(function(e) {
        e.preventDefault();
        start_load()
        $.ajax({
            url: 'ajax.php?action=send_message',
            method: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully saved", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)
                } else {
                    $('#msg').html('<div class="alert alert-danger">There was an error. Please contact support.</div>')
                    end_load()
                }
            }
        })
    })
</script>