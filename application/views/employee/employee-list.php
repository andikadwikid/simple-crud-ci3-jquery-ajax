<tr>
	<th>No</th>
	<th>Name</th>
	<th>Email</th>
	<th>Phone</th>
	<th>Adress</th>
	<th colspan="2">Action</th>
</tr>
<?php if (is_array($employees) && count($employees)) : ?>
	<?php
	$no = 1;
	foreach ($employees as $employee) : ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $employee->name ?></td>
			<td><?= $employee->email ?></td>
			<td><?= $employee->phone ?></td>
			<td><?= $employee->address ?></td>
			<td>
				<a class="delete_employee" id="<?= $employee->id ?>">
					<div class="btn btn-danger"><i class="fa fa-trash"></i></div>
				</a>

				<a class="edit_employee" id="<?= $employee->id ?>">
					<div class="btn btn-primary"><i class="fa fa-edit"></i></div>
				</a>

			</td>
		</tr>
	<?php endforeach; ?>
<?php else : ?>
	<tr>
		<td colspan="6" class="text-center">No Data</td>
	</tr>
<?php endif; ?>

<script>
	$(document).ready(() => {
		$('.delete_employee').click(async (e) => {
			e.preventDefault()
			let id = $(e.currentTarget).attr('id')
			console.log(id)
			const response = await Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			})

			if (response.isConfirmed) {
				$.ajax({
					url: `http://localhost/test/employee/destroy/${id}`,
					type: 'delete',
					cache: false,
					success: (response) => {
						$('table').load('http://localhost/test/employee/show_employee');

						Swal.fire({
							icon: 'success',
							title: 'Your work has been saved',
							showConfirmButton: false,
							timer: 1500
						})
					}
				})
			}
		})
	})

	$(document).ready(() => {
		$('.edit_employee').click((e) => {
			let title = "Edit employee"
			let id = $(e.currentTarget).attr('id')
			$.ajax({
				url: `http://localhost/test/employee/edit_employee/${id}`,
				type: "GET",
				cache: false,
				success: function(data) {
					$('#myModal').modal('show')
					$('.modal-body').html(data);
					document.getElementById('title-form').innerHTML = title;
				}
			})

		})
	})
</script>