<form method="POST" id="form_employee">
	<input type="hidden" class="csrf_hash" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" class="form-control" name="name" id="name" value="<?= $employee->name ?>">
		<div class="invalid-feedback" id="name_error"></div>
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="text" class="form-control" name="email" id="email" value="<?= $employee->email ?>">
		<div class="invalid-feedback" id="email_error"></div>
	</div>

	<div class="form-group">
		<label for="phone">Phone</label>
		<input type="number" class="form-control" name="phone" id="phone" value="<?= $employee->phone ?>" min="0">
		<div class="invalid-feedback"></div>
	</div>

	<div class="form-group">
		<label for="address">Address</label>
		<textarea name="address" class="form-control" id="address"><?= $employee->address ?></textarea>
		<div class="invalid-feedback"></div>
	</div>

	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-warning" id="update">update</button>
</form>

<script>
	$(document).ready(() => {

		$('#form_employee').on('submit', async (e) => {
			e.preventDefault()
			let id = <?= $employee->id ?>

			let csrf_name = $('.csrf_hash').attr('name')
			let csrf_hash = $('.csrf_hash').val()

			$.ajax({
				url: `http://localhost/test/employee/update_employee/${id}`,
				type: 'post',
				data: $('#form_employee').serialize(),
				cache: false,
				success: function(response) {
					let data = JSON.parse(response)

					$('.csrf_hash').val(data.csrf_hash)

					if (data.success === true) {
						$('#myModal').modal('hide')
						$('table').load('http://localhost/test/employee/show_employee')

						Swal.fire({
							icon: 'success',
							title: 'Employee data updated successfully',
							showConfirmButton: false,
							timer: 1500
						})
					}

					if (data.success === false) {
						if (data.errors.name_error != '') {
							$('#name').addClass('is-invalid')
							$('#name_error').html(data.errors.name_error)
						} else {
							$('#name').removeClass('is-invalid')
							$('#name_error').html('')
						}

						if (data.errors.email_error) {
							$('#email').addClass('is-invalid')
							$('#email_error').html(data.errors.email_error)
						} else {
							$('#email').removeClass('is-invalid')
							$('#email_error').html('')
						}
					}

				},
				error: function(response) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Something went wrong!',
					})
				}
			})
		})
	})
</script>