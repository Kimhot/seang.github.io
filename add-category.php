<?php
		session_start();
		if(!isset($_SESSION['user_id'])) {
			header("location:login.php");
			exit();
		}else{
			include('config/db.php');
		}
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Fan System</title>

	<!-- All CSS -->
	<?php include("part/all-css.php");?>
	<!-- All CSS end -->
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
	  <!-- Navbar -->
    <?php include("part/navbar.php");?>
      <!-- Navbar end -->

      <!-- Sidebar -->
      <?php include("part/sidebar.php");?>
      <!--  Sidebar end -->

    <div class="content-wrapper">
        <section class="container-fluid">
          <div class="row">
            <div class="card card-default col-md-12 col-lg-12">
                <div class="card-header">
                    <h1 class="card-title">New Category</h1>
                        <div class="card-tools">
                            <a href="manage-category.php" class="btn btn-info btn-sm">Manage Category</a>
                        </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="actions/addCategory.php" method="POST" enctype="multipart/form-data">
                                <div class="card-body">

                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12">
                                            <label for="name">Category Name</label>
                                            <select class="custom-file select2 ct-select2" name="Category">
                                                <option value="" selected="selected">Select Type</option>
                                                    <?php
                                                        $sql = $conn->query("SELECT * FROM `category` WHERE `user` = '$_SESSION[user_id]'");
                                                        while($row = mysqli_fetch_assoc($sql)){
                                                    ?>
                                                <option class="text-capitalize"><?php echo ucfirst($row['name']); ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12">
                                            <label>Image</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="uploadfile" oninput="img_preview.src=window.URL.createObjectURL(this.files[0])">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <img id="img_preview" class="img-thambnail mt-3" src="" alt="category icon" height="200px" width="200px;" >
                                    </div>

                                </div>

                                <div class="mt-3 ml-4">
                        <button type="submit" class="btn btn-info" name="submitCategory">Save</button>
                            </form>
                            
                    </div>
                        </div>
                    </div>
                
                    
                
                </div>
            </div>
            <!-- <div class="d-none d-lg-block col-lg-3">
              <div class="card">
                <a href="#"> <img src="dist/img/clinic.jpg" alt="" class="img-fluid w-100"> </a>
              </div>
            </div> -->
          </div>
        </section>
      </div>
    </div>
	<!-- Footer -->
	<?php include("part/footer.php");?>
	<!-- Footer End -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

	<!-- Alert -->
	<?php include("part/alert.php");?> 
	<!-- Alert end --> 
	
	<!-- All JS -->
	<?php include("part/all-js.php");?>
	<!-- All JS end -->
    <!-- Page specific script -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2({
          tags: true,
          placeholder: "Type category name..."
        });

        //Initialize Select2 Elements
        $(".select2bs4").select2({ theme: "bootstrap4", });
          });
    </script>
      
  </body>
</html>
