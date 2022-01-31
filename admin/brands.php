<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-brand">
				<div class="card">
					<div class="card-header">
						    Brand Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="brand_id">
							<div class="form-group">
								<label class="control-label">Name</label>
								<input type="text" class="form-control" name="brand_title">
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-brand').get(0).reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>Brand List</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Brand</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$brands = $conn->query("SELECT * FROM brands order by brand_id asc");
								while($row=$brands->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p><b><?php echo $row['brand_title'] ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_brand" type="button" data-id="<?php echo $row['brand_id'] ?>"  data-name="<?php echo $row['brand_title'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_brand" type="button" data-id="<?php echo $row['brand_id'] ?>">Delete</button>
									</td>
								</tr>
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
	
	td{
		vertical-align: middle !important;
	}
</style>
<script>
	
	$('#manage-brand').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_brand',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_brand').click(function(){
		start_load()
		var cat = $('#manage-brand')
		cat.get(0).reset()
		cat.find("[name='brand_id']").val($(this).attr('data-id'))
		cat.find("[name='brand_title']").val($(this).attr('data-name'))
		// cat.find("[name='description']").val($(this).attr('data-description'))
		end_load()
	})
	$('.delete_brand').click(function(){
		_conf("Are you sure to delete this brand?","delete_brand",[$(this).attr('data-id')])
	})
	function delete_brand($brand_id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_brand',
			method:'POST',
			data:{brand_id:$brand_id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	$('table').dataTable()
</script>