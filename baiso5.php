<?php
include_once("header.php");
include_once("nav.php");
?>
<div class="container-fluid">
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<div class="btn-add d-flex justify-content-end align-items-center pb-3">
				<button class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i> Thêm</button>
			</div>
			<thead class="thead-dark">
				<tr>
					<th scope="col">STT</th>
					<th scope="col">Từ năm</th>
					<th scope="col">Đến năm</th>
					<th scope="col">Lớp</th>
					<th scope="col">Nơi học</th>
					<th scope="col">Thao tác</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">1</th>
					<td>Mark</td>
					<td>Otto</td>
					<td>@mdo</td>
					<td>Quang Thái</td>
					<td class="d-flex">
						<button class="btn btn-outline-success mr-3"><i class="far fa-edit"></i> Sửa</button>
						<button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Xóa</button>
					</td>
				</tr>
				<tr>
					<th scope="row">1</th>
					<td>Mark</td>
					<td>Otto</td>
					<td>@mdo</td>
					<td>Quang Thái</td>
					<td class="d-flex">
						<button class="btn btn-outline-success mr-3"><i class="far fa-edit"></i> Sửa</button>
						<button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Xóa</button>
					</td>
				</tr>

			</tbody>
		</table>
	</div>
</div>

<?php
include_once("footer.php"); ?>