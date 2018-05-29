<header class="navbar navbar-default navbar-static-top" >
			<div class="container">
				<a href="forum.php" class="navbar-brand">PTTP</a>
				<ul class="nav navbar-nav navbar-right">

					<?php
						$sel_cat = "SELECT * FROM category";
						$run_cat = mysqli_query($conn,$sel_cat);
						while($rows = mysqli_fetch_assoc($run_cat)){
							if(isset($_GET['cat_name'])){
								if($_GET['cat_name'] == $rows['category_name']){
								$class = 'active';
								} else {
									$class = '';
								}
							}else {
								$class='';
							}
							if($rows['category_name'] == 'home'){
								if($_SERVER['PHP_SELF'] == '/php/cms/forum.php'){
									echo '<li class="active"><a href="forum.php">'.ucfirst($rows['category_name']).'</a>';
								} else {
									echo '<li class=""><a href="forum.php">'.ucfirst($rows['category_name']).'</a>';

								}
							}else {
								echo '<li class="'.$class.'"><a href="menu.php?cat_id='.$rows['c_id'].'">'.ucfirst($rows['category_name']).'</a></li>';
							}
						}
					?>

					<li><a href="contact.php">Contact Us</a></li>
					<li><a href="registration.php">Registration</a></li>
				</ul>
			</div>
		</header>
