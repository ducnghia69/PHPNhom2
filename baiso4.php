<?php include_once("header.php") ?>
<?php include_once("nav.php") ?>

<?php
#Code bài số 4
include_once("model/book.php");
$id = $Title = $search = "";
	if (isset($_REQUEST["addBook"])) {
		$id = $_REQUEST["id"];
		$Title = $_REQUEST["Title"];
		$Price = $_REQUEST["Price"];
		$Author = $_REQUEST["Author"];
		$Year = $_REQUEST["Year"];
		$content = $id . "#" . $Title . "#" . $Price . "#" . $Author . "#" . $Year;		
		book::AddToFile($content);
		//echo "<meta http-equiv='refresh' content='0'>";
	}
$book = new Book(1,50, "Kỵ sỹ bóng đêm - Joker", "ducnghia69", 2019);
// $book->display();
	$ls = $book::getListFromFile();
?>
 <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0 text-center" method="post">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search for book..." aria-label="Search" aria-describedby="basic-addon2">
        </div>
</form>

<?php
	
	if (isset($_REQUEST["search"]) ) {
		$search = $_POST['search'];
		if($search != null || $search != "")
			$ls = $book::Search($search);
		else $ls = $book::getListFromFile();
	}
?>
<div class="container-fluid">
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<div  class="btn-add d-flex justify-content-end align-items-center pb-3">
				<button class="btn btn-outline-primary" data-toggle="modal" data-target="#addBook"><i class="fas fa-plus-circle"></i> Thêm</button>
			</div>
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Title</th>
					<th scope="col">Price</th>
					<th scope="col">Author</th>
					<th scope="col">Year</th>
					<th scope="col">Thao tác</th>
				</tr>
			</thead>
			<tbody>
				<?php for ($i = 0; $i < count($ls); $i++) {   ?>
					<tr>
						<th scope="row"><?php echo $ls[$i]->id ?></th>
						<td><?php echo $ls[$i]->title ?></td>
						<td><?php echo $ls[$i]->price ?></td>
						<td><?php echo $ls[$i]->author ?></td>
						<td><?php echo $ls[$i]->year ?></td>
						<td class="d-flex">
							<button class="btn btn-outline-success mr-3" data-toggle="modal" data-target="#editBook"><i class="far fa-edit"></i> Sửa</button>
							<button class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteBook"><i class="fas fa-trash-alt"></i> Xóa</button>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="deleteBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Notice</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Do you want to delete this book?</div>
			<div class="modal-footer">
				<button class="btn btn-danger" type="button" data-dismiss="modal">Delete</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<legend>Edit Book </legend>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<fieldset>
						<div class="form-group d-flex">
							<label class="pt-1 col-md-2 control-label" for="Title">Title</label>
							<div class="col-md-10">
								<input id="Title" name="Title" type="text" placeholder="Title" class="form-control input-md">
							</div>
						</div>
						<div class="form-group d-flex">
							<label class="pt-1 col-md-2 control-label" for="Title">Price</label>
							<div class="col-md-10">
								<input id="Title" name="Title" type="text" placeholder="Title" class="form-control input-md">
							</div>
						</div>
						<!-- Select Basic -->
						<div class="form-group d-flex">
							<label class="pt-1 col-md-2 control-label" for="Year">Year</label>
							<div class="col-md-10">
								<select id="Year" name="Year" class="form-control">
									<option value="2019">2019</option>
									<option value="2018">2018</option>
									<option value="2017">2017</option>
									<option value="2016">2016</option>
									<option value="2015">2015</option>
									<option value="2014">2014</option>
									<option value="2013">2013</option>
									<option value="2012">2012</option>
									<option value="2011">2011</option>
									<option value="2010">2010</option>
								</select>
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group d-flex">
							<label class="pt-1 col-md-2 control-label" for="Author">Author</label>
							<div class="col-md-10">
								<input id="Author" name="Author" type="text" placeholder="Author" class="form-control input-md">

							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-success col-md-2" type="button" data-dismiss="modal">Edit</button>
				<button class="btn btn-outline-primary col-md-2" type="button" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<legend>Add Book </legend>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="addForm" method="POST">
					<fieldset>
					<div class="form-group d-flex">
							<label class="pt-1 col-md-2 control-label" for="Title">ID</label>
							<div class="col-md-10">
								<input id="id" name="id" type="text" placeholder="ID" class="form-control input-md">
							</div>
						</div>
						<div class="form-group d-flex">
							<label class="pt-1 col-md-2 control-label" for="Title">Title</label>
							<div class="col-md-10">
								<input id="Title" name="Title" type="text" placeholder="Title" class="form-control input-md">
							</div>
						</div>
						<div class="form-group d-flex">
							<label class="pt-1 col-md-2 control-label" for="Title">Price</label>
							<div class="col-md-10">
								<input id="Title" name="Price" type="text" placeholder="Price" class="form-control input-md">
							</div>
						</div>
						<!-- Select Basic -->
						<div class="form-group d-flex">
							<label class="pt-1 col-md-2 control-label" for="Year">Year</label>
							<div class="col-md-10">
								<select id="Year" name="Year" class="form-control">
									<option value="2019">2019</option>
									<option value="2018">2018</option>
									<option value="2017">2017</option>
									<option value="2016">2016</option>
									<option value="2015">2015</option>
									<option value="2014">2014</option>
									<option value="2013">2013</option>
									<option value="2012">2012</option>
									<option value="2011">2011</option>
									<option value="2010">2010</option>
								</select>
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group d-flex">
							<label class="pt-1 col-md-2 control-label" for="Author">Author</label>
							<div class="col-md-10">
								<input id="Author" name="Author" type="text" placeholder="Author" class="form-control input-md">

							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" name="addBook" class="btn btn-outline-success col-md-2" form="addForm" value="Submit">Submit</button>
				<!-- <button type="submit" form="addForm" class="btn btn-outline-success col-md-2" data-dismiss="modal">Add</button> -->
				<button class="btn btn-outline-primary col-md-2" type="button" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<?php include_once("footer.php") ?>