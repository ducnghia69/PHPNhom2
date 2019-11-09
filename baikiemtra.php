<?php 
session_start();
include_once("model/user.php");
include_once("model/contact.php");
include_once("model/label.php");
include_once("model/labelofcontact.php");
if(!isset($_SESSION["user"])){
    header("Location:login.php");
}
include_once("header.php") ?>
<?php include_once("nav.php") ?>
<style>
    
    .input-group.md-form.form-sm.form-1 input{
      
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
    .btn-outline-info{
       border-radius: 1.5rem;
    }
    .btn-outline-info:hover{
        background-color: white;
        opacity: 0.7;
        color: #17a2b8;
    }
    .btn-label{
        border: none;
    }
</style>
<!--Navbar-->
<?php 
    if (isset($_REQUEST["add"])) {     
        $name = $_REQUEST["namecontact"];
        $email = $_REQUEST["email"];
        $phone = $_REQUEST["phone"];
        if(isset($_REQUEST["ismajor"]))
            $ismajor = $_REQUEST["ismajor"];	
        else
            $ismajor = 0;
        $contact =  new Contact(null,$name,$email, $phone,$ismajor, null);
        //$content = $id . "#" . $price . "#" . $title . "#" . $author . "#" . $year;
        //Book::addToFile($content);
        Contact::addToDB($contact);
    }else if (isset($_REQUEST["AddLabel"])) {     
        $namelabel = $_REQUEST["namelabel"];
        $label =  new Label(null,$namelabel,null);
        //$content = $id . "#" . $price . "#" . $title . "#" . $author . "#" . $year;
        //Book::addToFile($content);
        Label::addToDB($label);
    }
    $keyWord = null;
    if (strpos($_SERVER['REQUEST_URI'], "search")) { // hàm ktra chuỗi trước có chứa chuỗi sau không
      $keyWord = $_REQUEST['search'];      
    }
    $lscontact = Contact::GetListFromDB($keyWord);
    $lsmajorcontact = Contact::GetListMajorContactFromDB();
    $lslabelofcontact = LabelOfContact::GetLabelFromDatabase();
    
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
    <nav class="navbar navbar-light teal lighten-4">

<!-- Navbar brand -->
        <a class="navbar-brand" href="#"><img src="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png" class="pr-2">Danh bạ</a>

        <!-- Collapse button -->
        <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
            aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i
                class="fas fa-bars fa-1x"></i></span></button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
            <button class="btn btn-outline-info mt-3"  data-toggle="modal" data-target="#AddContact">
                <img src="https://img.icons8.com/cotton/2x/add.png" style="width : 48px">
                    Tạo liên hệ
            </button>
            <!-- Links -->
            <ul class="navbar-nav mr-auto mt-3">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-user"></i> Danh bạ (<?php global $gloContact; echo $gloContact; ?>)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-clock"></i> Thường xuyên liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-sticky-note"></i> Liên hệ trùng lặp</a>
                </li>
                <li class="nav-item">
                    <hr>
                </li>
                <li class="nav-item">    
                    <button class="navbar-toggler toggler-example border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2"
                aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i class="fas fa-chevron-up" ></i></span> Nhãn</button>         
                    <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                
                    <!-- Links -->
                    <ul class="navbar-nav mr-auto mt-3">
                        <?php foreach ($lslabelofcontact as $key => $value) {?>
                            <li class="nav-item">
                              <a class="nav-link" href="#"><i class="fas fa-tag"></i> <?php echo $value->labelname  ?> (<?php echo $value->countcontact ?>)</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">   
                           <button class="btn btn-outline-info btn-label" data-toggle="modal" data-target="#AddLabel"><i class="fas fa-plus-circle"></i> Tạo nhãn</button>          
                           
                        </li>
                    </ul>
                </li>
               
            </ul>
            <!-- Links -->

        </div>
        <!-- Collapsible content -->

    </nav>
    </div>
    <div class="col-sm-9 mt-3">
      <div class="row">      
        <div class="col-sm-12">
            <div class="input-group md-form form-sm form-1 pl-0 pr-0">
                <form class="form-inline container-fluid text-center p-0">
                    <i class="fas fa-search pr-1" aria-hidden="true"></i>
                    <input name="search" value="<?php echo $_REQUEST["search"] ?? ""; ?>" class="form-control p-0 border-0" style="width:97.6%;background:#f5f6f7" type="text" placeholder=' Tìm kiếm' aria-label="Search" >
                </form>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table table-borderless">
                <thead>
                    <tr style="border-bottom: 1px solid #CCCCCC;">                 
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    </tr>
                </thead>
                
                <tbody> 
                    
                    <tr> 
                        <td>NGƯỜI LIÊN HỆ CÓ GẮN DẤU SAO </td>               
                    </tr>
                    <?php foreach ($lsmajorcontact as $key => $value) {?>
                        <tr>
                            <td><input type="checkbox"> <?php echo $value->name?></td>
                            <td><?php echo $value->email?></td>
                            <td><?php echo $value->phone?></td>
                        </tr>
                    <?php } ?>
                    <tr> 
                        <td>DANH BẠ</td> 
                        <td></td>
                        <td></td>
                                      
                    </tr>
                    <?php foreach ($lscontact as $key => $value) {?>
                        <tr>
                            <td><input type="checkbox"> <?php echo $value->name?></td>
                            <td><?php echo $value->email?></td>
                            <td><?php echo $value->phone?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                
            </table>
        </div>
      </div>
    </div>
   
  </div>
</div>

<!--/.Navbar-->
<!--Create contact -->
<div class="modal fade" id="AddContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add Contact</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post">
					<div class="form-group ">
						<label for="from">Name contact</label>
						<input type="text" class="form-control" name="namecontact" placeholder="Name contact">
					</div>
					<div class="form-group">
						<label for="to">Email</label>
						<input type="email" class="form-control" name="email" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="class">Phone</label>
						<input type="text" class="form-control" name="phone" placeholder="Phone">
					</div>
					<div class="form-group">
						<label for="place" style="float: left; margin-right:10px; padding-top: 5px">Gắn dấu sao</label>
						<input type="checkbox" class="form-control" name="ismajor" value="1" style="width: 20px;">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="add">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--Create label -->
<div class="modal fade" id="AddLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="width: 500px">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add Label</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post">
					<div class="form-group" >
						<label for="from">Label Name</label>
						<input type="text" class="form-control"  name="namelabel" placeholder="Label Name">
					</div>					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="AddLabel">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include_once("footer.php") ?>