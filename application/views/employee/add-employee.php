<form method="POST" id="form_employee">

	<label for="name">Name</label>
	<input type="text" class="form-control" name="name" id="name" value="">
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="text" class="form-control" name="email" id="email" value="">
	</div>

	<div class="form-group">
		<label for="phone">Phone</label>
		<input type="number" class="form-control" name="phone" id="phone" value="" min="0">
	</div>

	<div class="form-group">
		<label for="address">Address</label>
		<textarea name="address" class="form-control" id="address"></textarea>
	</div>

	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary" id="save">Save</button>
</form>

<script>
	$(document).ready(() => {
		$('#save').click((e) => {
			e.preventDefault()
			$.ajax({
				url: 'http://localhost/test/employee/post',
				type: 'POST',
				data: $('#form_employee').serialize(),
				cache: false,
				success: (response) => {
					$('#myModal').modal('hide')
					$('table').load('http://localhost/test/employee/show_employee');

					Swal.fire({
						icon: 'success',
						title: 'Your work has been saved',
						showConfirmButton: false,
						timer: 1500
					})
				}
			})
		})
	})
</script>