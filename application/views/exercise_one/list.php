<div class="container mt-3">
	<h5 style="">Exercise 1 - Q2 : Listing</h5>
	<p>Router listing</p>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
	  Create New Router
	</button>
	<table class="table">
		<thead>
			<th>#</th>
			<th>SAP ID</th>
			<th>Hostname</th>
			<th>Loopback</th>
			<th>Mac Address</th>
			<th>.</th>
		</thead>
		<tbody>
			<?php if(!empty($list)) { ?>
				<?php foreach ($list as $key => $item) { ?>
					<tr>
						<td><?php echo ($key + 1); ?></td>
						<td><?php echo $item['sap_id']; ?></td>
						<td><?php echo $item['hostname']; ?></td>
						<td><?php echo $item['loopback']; ?></td>
						<td><?php echo $item['mac_address']; ?></td>
						<td>
							<div class="dropdown">
								<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Select An Action
								</a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<a class="dropdown-item" onclick="javascript:edit('<?php echo $item['router_id']; ?>');"  href="javascript:void(0)">Edit</a>
									<a class="dropdown-item" onclick="javascript:deleter('<?php echo $item['router_id']; ?>');" href="javascript:void(0)">Delete</a>
								</div>
							</div>
						</td>
					</tr>
				<?php } ?>
			<?php }else{ ?>
				<tr>
					<td colspan="6" align="center">No Records to show</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Router</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="container mt-3">
			<h5 style="">Exercise 1 - Q2</h5>
			<p>Create/Edit form for database</p>
			<form id="router_properties">
			  <div class="form-group">
				<label for="sapid">SAP ID</label>
				<input type="text" class="form-control" id="sapid" value="" name="sapid" aria-describedby="emailHelp">
				<small id="sapidc" class="form-text text-muted">Enter SAP ID here of the format: 12:12:34:65-e3:t5:87:5411:57</small>
			  </div>
			  <div class="form-group">
				<label for="hostname">Host Name</label>
				<input type="text" class="form-control" id="hostname"  value="" name="hostname" aria-describedby="emailHelp">
				<small id="hostnamec" class="form-text text-muted">Enter Hostname http://www.example.com</small>
			  </div>
			  <div class="form-group">
				<label for="loopback">Loopback IP</label>
				<input type="text" class="form-control" id="loopback"  value="" name="loopback" aria-describedby="emailHelp">
				<small id="loopbackc" class="form-text text-muted">Enter Loopback IP of format: 192.168.1.111:57</small>
			  </div>
			  <div class="form-group">
				<label for="macaddress">Mac Address</label>
				<input type="text" class="form-control" id="macaddress"  value="" name="macaddress" aria-describedby="emailHelp">
				<small id="macaddressc" class="form-text text-muted">Enter SAP ID here of the format: 02:42:a8:4a:80:75</small>
			  </div>
			  <div class="form-group">
				<input type="hidden" id="router_id" name="router_id" value="">
			  </div>
			  <!-- <button type="submit" class="btn btn-primary float-right">Submit</button> -->
			</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal_save">Save changes</button>
        <!-- <button type="button" class="btn btn-danger" id="modal_update">Update</button> -->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		
		$("#modal_save").show();
		$("#router_id").attr('value', '');
		placeholder = {
			"sapid" : "SAP ID",
			"hostname" : "Host Name",
			"loopback" : "Loopback IP",
			"macaddress" : "Mac Address"
		};

	});

	$(document).on("click", "#modal_save", function(){
		
		$("#modal_save").show();

		($("#router_properties").serializeArray()).forEach(function(item, index){
			$("#" + item.name).css('border-color', "#ced4da");
			if($.trim(item.value) == "" && item.name != "router_id") {
		 		$("#" + item.name).css('border-color', "red");
				return false;
			}
		});

		$.ajax({
			type: "post",
			url: software_url + 'exercise_one/update',
			data: ($("#router_properties").serialize()),
			success: function(data) {

				if (data != undefined && data.error=="" && data.msg == 'done') {
					alert("Data saved");
					$('#exampleModal').modal('hide');
					location.reload();
				}else if (data != undefined && data.error != '') {
					alert("Unable to save data");
				}

				$('#router_properties')[0].reset();
				$("#router_id").attr('value', '');
			},
			beforeSend : function(){
				//
			}
		});
	});

	function deleter(router_id)
	{
		$.ajax({
			type: "post",
			url: software_url + 'exercise_one/delete',
			data: {router_id: router_id},
			success: function(data) {

				if (data != undefined && data.error=="" && data.msg == 'done') {
					alert("Data Deleted");
				 	location.reload();
				}else if (data != undefined && data.error != '') {
					alert("Unable to save data: " + data.error);
					return false;
				}

				$('#router_properties')[0].reset();
			},
			beforeSend : function(){
				//
			}
		});
	}

	function edit(router_id)
	{
		$.ajax({
			type: "post",
			url: software_url + 'exercise_one/get_one',
			data: {router_id: router_id},
			success: function(data) {

				if (data != undefined && data.error=="" && data.msg == 'done' && data.data)
				{
					$('#exampleModal').modal('show');

					$("#sapid").attr('value', data.data.sap_id);
					$("#hostname").attr('value', data.data.hostname);
					$("#loopback").attr('value', data.data.loopback);
					$("#macaddress").attr('value', data.data.mac_address);
					$("#router_id").attr('value', data.data.router_id);

				 	// location.reload();
				}else if (data != undefined && data.error != '') {
					alert("Unable to save data: " + data.error);
					return false;
				}

				$('#router_properties')[0].reset();
			},
			beforeSend : function(){
				//
			}
		});
	}
</script>