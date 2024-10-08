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
  <style>
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #138496;
        color: #fff; 
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include("part/navbar.php");?>
    <!-- Navbar end -->

    <!-- Sidebar -->
    <?php include("part/sidebar.php");?>
    <!--  Sidebar end -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
    <section class="container-fluid">
        <div class="row">
          <!-- medicine form start  -->
            <div class="card card-default col-md-12 col-lg-12">
                <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                    <h4 class="fs-17 font-weight-600 mb-0">New Product</h4>
                    </div>
                    <div class="text-right">
                    <a href="manage-products.php" class="btn btn-info btn-sm mr-1">Manage Product</a>
                    </div>
                </div>
                </div>
            <div class="card-body">
            <form action="actions/addProduct.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  
                    <div class="form-group">
                        <div class="col-sm-12 col-md-12">
                            <label>Category</label>
                                <div class="d-flex">
                                    <select class="form-control select2" name="category_product">
                                    <option value="" selected="selected">Select Type</option>
                                    <?php
                                        $sql = $conn->query("SELECT * FROM `category` WHERE `user` = '$_SESSION[user_id]'");
                                        while($row = mysqli_fetch_assoc($sql)){
                                    ?>
                                    <option class="text-capitalize" value="<?php echo $row['id']; ?>"><?php echo ucfirst($row['name']); ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                    <a href="add-category.php" class="btn btn-info"><i class="fas fa-plus"></i></a>
                                </div>
                        </div>
                    </div>
                 
                    <div class="form-group">
                            <div class="col-sm-12 col-md-12">
                                <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Product Name" name="product_name" required>
                            </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 col-md-12">
                            <label for="name">Unit</label>
                                <select class="form-control select2 " name="unit">
                                    <option value="" selected="selected"></option>
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 col-md-12">
                            <label for="product-price">QTY</label>
                            <input type="number" class="form-control" id="stock" placeholder="Product Initial Stock" name="new_stock" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 col-md-12">
                            <label for="product-price">Price</label>
                            <input type="number" class="form-control" id="price" placeholder="Enter Product Price" name="product_price" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 col-md-12">
                            <label>Product Details</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="details"></textarea>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-12 col-md-12">
                            <label>Product Image (Support: jpg , png , jpeg )</label>
                                <div class="row">
                                    <div class="col-sm-12 col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="uploadfile" oninput="img_preview.src=window.URL.createObjectURL(this.files[0])">
                                            <label class="custom-file-label">Choose file</label><br>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <img id="img_preview" src="" alt="product image" height="200px" width="200px;" >
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>
                <div class="form-group pl-3">
                  <button type="submit" class="btn btn-info" name="submit">Submit</button>
                </div>
            </form>
            </div>
          </div>
        </div>
        </div>
    </section>
    <!-- Main content end -->
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
  <script>
    $(function() {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Initialize Select2 Elements
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });

        $('.medicine-unit-select').select2({
          placeholder: "Select medicine unit"
        });
    });
  </script>
</body>

</html>