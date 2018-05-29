<?php session_start();
	include 'includes/db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password']) == true){
		$sel_sql = "SELECT * FROM users WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[password]'";
		if($run_sql = mysqli_query($conn, $sel_sql)){
			while($rows = mysqli_fetch_assoc($run_sql)){
				$name = $rows['user_f_name'].' '.$rows['user_l_name'];
				$job = $rows['user_designation'];
				$gender = $rows['user_gender'];
				$contact_no = $rows['user_phone_no'];
				if(mysqli_num_rows($run_sql) == 1 ){
					if($rows['role'] == 'admin'){
					} else {
						header('Location:../forum.php');
					}
				} else{
					header('Location:../forum.php');
				}
			}
		}
	} else {
		header('Location:../forum.php');
	}
	//// Counting Posts
	$sql = "SELECT * FROM posts WHERE status = 'published'";
	$run = mysqli_query($conn,$sql);
	$total_posts = mysqli_num_rows($run);

	/// Counting Categories
	$sql = "SELECT * FROM category";
	$run = mysqli_query($conn,$sql);
	$total_categories = mysqli_num_rows($run);
	
	///Counting Users
	$sql = "SELECT * FROM users";
	$run = mysqli_query($conn,$sql);
	$total_users = mysqli_num_rows($run);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Panel</title>
		<link rel="stylesheet" href="../../bootstrap.css">
		<script src="../../js/jquery.js"></script>
		<script src="../../bootstrap.js"></script>
	</head>
	<body>
		<?php include 'includes/header.php';?>
		<div style="width:50px;height:50px;"></div>

		<?php echo $_SESSION['user']; include 'includes/sidebar.php';?>
		<div class="col-lg-10">
		<div style="width:50px;height:50px;"></div>
			<div class="col-md-3">

				<div class="panel panel-danger">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3"><i class="glyphicon glyphicon-signal" style="font-size:4.5em"></i></div>
							<div class="col-xs-9 text-right">
								<div style="font-size:2.5em"><?php echo $total_posts; ?></div>
								<div>Posts</div>
							</div>
						</div>
					</div>
					<a href="post_list.php">
						<div class="panel-footer">
							<div class="pull-left">View Posts</div>
							<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3"><i class="glyphicon glyphicon-th-list" style="font-size:4.5em"></i></div>
							<div class="col-xs-9 text-right">
								<div style="font-size:2.5em"><?php echo $total_categories; ?></div>
								<div>Categories</div>
							</div>
						</div>
					</div>
					<a href="category_list.php">
						<div class="panel-footer">
							<div class="pull-left">Veiw Categories</div>
							<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3"><i class="glyphicon glyphicon-user" style="font-size:4.5em"></i></div>
							<div class="col-xs-9 text-right">
								<div style="font-size:2.5em"><?php echo $total_users; ?></div>
								<div>Users</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<div class="pull-left">View Users</div>
							<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3"><i class="glyphicon glyphicon-comment" style="font-size:4.5em"></i></div>
							<div class="col-xs-9 text-right">
								<div style="font-size:2.5em">6</div>
								<div>Comments</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<div class="pull-left">View Comments</div>
							<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="clearfix"></div>

			<!-- Top Blocks Ends----->
			<!-- Users Area --->
			<div class="col-lg-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4>Users List</h4>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>S.NO</th>
									<th>Name</th>
									<th>Role</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$sql = "SELECT * FROM users LIMIT 5";
								$run = mysqli_query($conn,$sql);
								$number = 1;
								while ($rows = mysqli_fetch_assoc($run)){
									echo '
										<tr>
											<td>'.$number.'</td>
											<td>'.$rows['user_f_name'].' '.$rows['user_l_name'].'</td>
											<td>'.$rows['role'].'</td>
										</tr>
									';
									$number++;
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Profile Area -->
			<div class="col-lg-4">
				<div class="panel panel-primary">
				<div class="panel-heading">
				<div class="col-md-7">
				<div class="page-header"><h4><?php echo $name; ?></h4></div>
				</div>
				<div class="col-md8">
					<img src="../images/model.jpg" width="30%" class="img-circle">
				</div>
					<div class="panel-body">
						<table class="table table-condensed">
							<tbody>
								<tr>
									<th>Job:</th>
									<td><?php echo $job; ?></td>
								</tr>
								<tr>
									<th>Role:</th>
									<td><?php echo $_SESSION['role']; ?></td>
								</tr>
								<tr>
									<th>Email:</th>
									<td><?php echo $_SESSION['user']; ?></td>
								</tr>
								<tr>
									<th>Contact:</th>
									<td><?php echo $contact_no; ?></td>
								</tr>
								<tr>
									<th>Gender:</th>
									<td><?php echo $gender; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<!------ Post lists Starts----->
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Latest Posts</h3></div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Date</th>
								<th>Image</th>
								<th>Title</th>
								<th>Description</th>
								<th>Category</th>
								<th>Author</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM posts p JOIN category c ON c.c_id = p.category WHERE p.author = '$_SESSION[user]' AND p.status = 'published'";
								//$sql = "SELECT * FROM posts WHERE author = '$_SESSION[user]' AND status = 'published'";
								$run = mysqli_query($conn,$sql);
								$number = 1;
								while($rows = mysqli_fetch_assoc($run)){
									echo '
									<tr>
										<td>'.$number.'</td>
										<td>'.$rows['date'].'</td>
										<td><img src="../'.$rows['image'].'" width="50px"></td>
										<td>'.$rows['title'].'</td>
										<td>'.substr($rows['description'],0,50).'....</td>
										<td>'.ucfirst($rows['category_name']).'</td>
										<td>'.$name.'</td>
									</tr>
									';
									$number++;
								}
							?>

						</tbody>
					</table>
				</div>
			</div>
			<!-- Latest Comments Area -->
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Latest Comments</h3></div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Date</th>
								<th>Author</th>
								<th>Email</th>
								<th>Post</th>
								<th>Comments</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>2015-10-21</td>
								<td>Michael</td>
								<td>abc@gmail.com</td>
								<td>2</td>
								<td>I like that Post</td>
							</tr>
							<tr>
								<td>2</td>
								<td>2015-10-21</td>
								<td>Michael</td>
								<td>abc@gmail.com</td>
								<td>2</td>
								<td>I like that Post</td>
							</tr>
							<tr>
								<td>3</td>
								<td>2015-10-21</td>
								<td>Michael</td>
								<td>abc@gmail.com</td>
								<td>2</td>
								<td>I like that Post</td>
							</tr>
							<tr>
								<td>4</td>
								<td>2015-10-21</td>
								<td>Michael</td>
								<td>abc@gmail.com</td>
								<td>2</td>
								<td>I like that Post</td>
							</tr>
							<tr>
								<td>5</td>
								<td>2015-10-21</td>
								<td>Michael</td>
								<td>abc@gmail.com</td>
								<td>2</td>
								<td>I like that Post</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<footer></footer>
	</body>
</html>
