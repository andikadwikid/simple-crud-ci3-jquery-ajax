<form method="POST" id="form_employee">

	<label for="name">Name</label>
	<input type="text" class="form-control" name="name" id="name" value="<?= $employee->name ?>">
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="text" class="form-control" name="email" id="email" value="<?= $employee->email ?>">
	</div>

	<div class="form-group">
		<label for="phone">Phone</label>
		<input type="number" class="form-control" name="phone" id="phone" value="<?= $employee->phone ?>" min="0">
	</div>

	<div class="form-group">
		<label for="address">Address</label>
		<textarea name="address" class="form-control" id="address"><?= $employee->address ?></textarea>
	</div>

	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-warning" id="update">update</button>
</form>

<script>
	$(document).ready(() => {
		$('#form_employee').on('submit', async (e) => {
			e.preventDefault()
			let id = <?= $employee->id ?>

			const response = await Swal.fire({
				title: 'Are you sure you want to update this employee data ?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, update it!'
			})

			if (response.isConfirmed) {
				$.ajax({
					url: `http://localhost/test/employee/update_employee/${id}`,
					type: 'post',
					data: $('#form_employee').serialize(),
					dataType: 'json',
					cache: false,
					success: (response) => {
						if (response.error) {
							console.log(response)
							$('#myModal').modal('show')
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Something went wrong!',
							})
						} else {
							$('#myModal').modal('hide')
							$('table').load('http://localhost/test/employee/show_employee');

							Swal.fire({
								icon: 'success',
								title: 'Employee data updated successfully',
								showConfirmButton: false,
								timer: 1500
							})
						}
					}

				})
			}
		})
	})
</script>