<?php 
include "db.php";
include "header.php";
if(isset($_GET['id'])){
	$msgs = $con->query("SELECT sender.name as sender, c.message, c.sender_id, c.receiver_id, receiver.name as receiver, c.date_created FROM `chatlog` as c LEFT JOIN users as sender ON c.sender_id = sender.id LEFT JOIN users as receiver ON c.receiver_id = receiver.id ORDER BY c.date_created ASC");
	// foreach($msgs->fetch_array() as $k =>$v){
	// 	$meta[$k] = $v;
	// }
}
?>
<div class="container-fluid" style="padding: 20px;">
    <div class="row p-4 bg-light">
        <div class="col-md-12">
            <div id="msg"></div>
            <?php if(isset($msgs)): ?>
				<?php while($row = $msgs->fetch_assoc()): ?>
					<?php if($row['sender_id'] == $_GET['id'] && $row['receiver_id'] == $_SESSION['uid']): ?>
					<div class="col-md-12">
						<div class="alert alert-info" role="alert" style="max-width: 600px;">
							<small class="font-weight-bold"><?php echo $row['sender']; ?></small>: <?php echo $row['message']; ?>
						</div>				
					</div>
					<?php endif; ?>
					<?php if($row['sender_id' ] == $_SESSION['uid'] && $row['receiver_id'] == $_GET['id']): ?>
					<div class="col-md-12">
						<div class="alert alert-primary ml-auto" role="alert" style="max-width: 600px;">
							<small class="font-weight-bold">Me</small>: <?php echo $row['message']; ?>
						</div>				
					</div>
					<?php endif; ?>
            	<?php endwhile; ?>
			<?php endif; ?>

            <form action="" id="send-message">
                <input type="hidden" name="sender_id" value="<?php echo isset($_SESSION['uid']) ? $_SESSION['uid']: '' ?>">
                <input type="hidden" name="receiver_id" value="<?php echo isset($_GET['id']) ? $_GET['id']: '' ?>">
                <div class="col-md-12">
                    <!-- <div class="alert alert-info" role="alert">
                A simple info alert—check it out!
            </div>
            <label for="" class="control-label">Name</label> -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="message" placeholder="Enter a message..."
                            required>
                        <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Send</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
// $('#send-message').submit(function(e){
// 	e.preventDefault();
// 	start_load()
// 	$.ajax({
// 		url:'admin/ajax.php?action=send_message',
// 		method:'POST',
// 		data:$(this).serialize(),
// 		success:function(resp){
// 			if(resp ==1){
// 				alert_toast("Message successfully sent!",'success')
// 				setTimeout(function(){
// 					location.reload()
// 				},1500)
// 			}
// 			// else{
// 			// 	$('#msg').html('<div class="alert alert-danger">Error. Please contact support.</div>')
// 			// 	end_load()
// 			// }
// 		}
// 	})
// })
</script>
<?php
	include "footer.php";
?>