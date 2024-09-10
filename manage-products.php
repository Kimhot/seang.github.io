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
    <title>Seang System</title>

	<!-- Data Table CSS -->
	<?php include("part/data-table-css.php");?>
	<!-- Data Table CSS end -->
	
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
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div>
                      <h3 class="card-title">Manage Products</h3>
                    </div>
                    <div class="text-right">
                      <a href="add-product.php" class="btn btn-info btn-sm mr-1"><i class="fas fa-plus mr-1"></i>New Product</a>
                    </div>
                    
                  </div>
                  
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                      <thead>
                        <tr class="bg-info">
                          <th>ID</th>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Category</th>
                          <!-- <th>Brand</th> -->
                          <!-- <th>From Abroad</th> -->
                          <!-- <th>Cost</th> -->
                          <th>Price</th>
                          <th>Total Qunatity</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql = $conn->query("SELECT a.id, a.img, a.name, c.name AS cat, a.price, a.qty FROM `product` AS a
                          inner JOIN category AS c ON (a.category = c.id and a.user = 1) ");
                          while($row = mysqli_fetch_assoc($sql)){
                        ?>
                        <tr>
                          <td class="text-capitalize"><?php echo $row['id']; ?></td>
                          <td class="text-capitalize text-center"><img src="dist/img/product/<?php echo $row['img']; ?>" alt="<?php echo $row['name']; ?>" style="max-width: 90px;"></td>
                          <td class="text-capitalize"><?php echo $row['name']; ?></td>
                          <td class="text-capitalize"><?php echo $row['cat']; ?></td>
                          <td class="text-capitalize"><?php echo $row['price']; ?>៛</td>
                          <td class="text-capitalize"><?php echo $row['qty']; ?></td>
                          <td class="text-center">
                            <div class="btn-group">
                              <button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cogs"> Manage</i> </button>
                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; top: 30px; left: 0px; will-change: top, left;">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit<?php echo $row['id']; ?>"> <i class="fa fa-edit"></i> Edit </a>
                                <a class="dropdown-item" href=""> <i class="fa fa-history"></i> Sell History </a> 
                                <a class="dropdown-item delete" href="actions/remove.php?removeProduct=<?php echo $row['id']; ?>"> <i class="fa fa-trash"></i> Delete </a>
                              </div>
                            </div>
                          </td>
                        </tr>

                       

                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
	<!-- Footer -->
	<?php include("part/footer.php");?>
	<!-- Footer End -->
  </div>

	<!-- Alert -->
	<?php include("part/alert.php");?> 
	<!-- Alert end --> 
	
	<!-- All JS -->
	<?php include("part/all-js.php");?>
	<!-- All JS end -->
	
	<!-- Data Table JS -->
	<?php include("part/data-table-js.php");?>
	<!-- Data Table JS end -->
  </body>
</html>
