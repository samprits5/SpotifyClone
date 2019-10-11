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

	$sql = "SELECT *  FROM home_table WHERE id = ?";

	$query  = $pdoconn->prepare($sql);

	$query->execute([$id]);

	$arr_login=$query->fetchAll(PDO::FETCH_ASSOC);



	$sql = "SELECT id, name FROM songs_table";

	$query  = $pdoconn->prepare($sql);

	$query->execute();

	$arr_songs=$query->fetchAll(PDO::FETCH_ASSOC);


	$sql = "SELECT name FROM artist_table";

	$query  = $pdoconn->prepare($sql);

	$query->execute();

	$arr_artist=$query->fetchAll(PDO::FETCH_ASSOC);

}

?>

<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="main-section">
							<h2 class="content-heading">Edit Homepage Song</h2>
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
								

                            <form method="post" action="../backend/admin/update-homepage.php">


							<?php echo '<input type="hidden" value="'.$_REQUEST['id'].'" name="id">'; ?>
                        
								<div class="row">
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="genre-name">Main Title</label>
											<input type="text" value="<?php echo $arr['name']; ?>" name="name" class="form-control" id="genre-name" aria-describedby="genre-help">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group text-left">
										    <label for="artist">Song Artist</label>
										    <select class="form-control" id="artist" name="artist">
										    <?php foreach ($arr_artist as $key) {
										    	echo '<option value="'.$key['name'].'">'.$key['name'].'</option>';
										    } ?>
										    </select>
										  </div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group text-left">
										    <label for="artist">Assign Song</label>
										    <select class="form-control" id="artist" name="song">
										    <?php foreach ($arr_songs as $key) {
										    	echo '<option value="'.$key['id'].'">'.$key['name'].'</option>';
										    } ?>
										    </select>
										  </div>
									</div>
								</div>

								<div class="row">
									<div class="col text-right section-buttons">
										<button class="btn btn-outline-success">Update Genre</button>
										<a href="homepage-list.php" class="btn btn-outline-success">Dismiss</a>
									</div>
								</div>
								

							</form>

							<?php } ?>

						</div>
					</div>
				</div>
			</div>