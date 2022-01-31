<?php 
	include('db_connect.php');
	session_start();
	if(isset($_GET['user_id'])){
		$user = $conn->query("SELECT * FROM user_info where user_id =".$_GET['user_id']);
		foreach($user->fetch_array() as $k =>$v){
			$meta[$k] = $v;
		}
	}
?>
<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="manage-user">	
		<input type="hidden" name="user_id" value="<?php echo isset($meta['user_id']) ? $meta['user_id']: '' ?>">
		<div class="form-group">
			<label for="name">First Name</label>
			<input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo isset($meta['first_name']) ? $meta['first_name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Last Name</label>
			<input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo isset($meta['last_name']) ? $meta['last_name']: '' ?>" required>
		</div>		
		<div class="form-group">
			<label for="name">Mobile</label>
			<input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo isset($meta['mobile']) ? $meta['mobile']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Address 1</label>
			<input type="text" name="address1" id="address1" class="form-control" value="<?php echo isset($meta['address1']) ? $meta['address1']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Address 2</label>
			<input type="text" name="address2" id="address2" class="form-control" value="<?php echo isset($meta['address2']) ? $meta['address2']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Email</label>
			<input type="email" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
			<?php if(isset($meta['user_id'])): ?>
			<small><i>Leave this blank if you dont want to change the password.</i></small>
		<?php endif; ?>
		</div>

	</form>
</div>
<script>
	
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=save_user',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">Email already exist</div>')
					end_load()
				}
			}
		})
	})

</script>