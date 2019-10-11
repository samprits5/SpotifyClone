<?php

if(!isset($_REQUEST['id'])){

	$_SESSION['error'] = "Invalid ID Parameter!";
	echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'
			</div>';
	require('../chunks/adminpanel/layout/footer.php');
    exit();
    
} else {

	$id = $_REQUEST['id'];
	
	include_once("../backend/connection-pdo.php");

	$sql = "SELECT * FROM genre_table WHERE id = ?";

	$query  = $pdoconn->prepare($sql);

	$query->execute([$id]);

	$arr_login=$query->fetchAll(PDO::FETCH_ASSOC);

}

?>

<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="main-section">
							<h2 class="content-heading">Edit Genre</h2>
						<?php 
						
						// session_destroy();

                        if(isset($_SESSION['error'])){
							echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
							unset($_SESSION['error']);
                        }
						?>

								<?php
                                    foreach($arr_login as $arr) {
                                ?>
								

                            <form method="post" action="../backend/admin/update-genre.php">


							<?php echo '<input type="hidden" value="'.$_REQUEST['id'].'" name="id">'; ?>
                        
								<div class="row">
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="genre-name">Genre Name</label>
											<input type="text" value="<?php echo $arr['name']; ?>" name="name" class="form-control" id="genre-name" aria-describedby="genre-help" placeholder="Add a new genre name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="genre-description">Genre Description</label>
											<input type="text" value="<?php echo $arr['description']; ?>" name="description" class="form-control" id="genre-description" aria-describedby="genre-des-help" placeholder="Add a genre description">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col text-right section-buttons">
										<button class="btn btn-outline-success">Update Genre</button>
										<a href="genre-list.php" class="btn btn-outline-success">Dismiss</a>
									</div>
								</div>
								

							</form>

							<?php } ?>

						</div>
					</div>
				</div>
			</div>