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

	$sql = "SELECT * FROM songs_table WHERE id = ?";

	$query  = $pdoconn->prepare($sql);

	$query->execute([$id]);

	$arr_login=$query->fetchAll(PDO::FETCH_ASSOC);


	$sql1 = "SELECT * FROM artist_table";

	$query1  = $pdoconn->prepare($sql1);

	$query1->execute();

	$arr_artist=$query1->fetchAll(PDO::FETCH_ASSOC);


	$sql2 = "SELECT * FROM genre_table";

	$query2  = $pdoconn->prepare($sql2);

	$query2->execute();

	$arr_genre=$query2->fetchAll(PDO::FETCH_ASSOC);


	$sql3 = "SELECT * FROM mood_table";

	$query3  = $pdoconn->prepare($sql3);

	$query3->execute();

	$arr_mood=$query3->fetchAll(PDO::FETCH_ASSOC);

}

?>


<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="main-section">
							<h2 class="content-heading">Edit Song Info</h2>


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
								

                            <form method="post" action="../backend/admin/update-songs.php" enctype="multipart/form-data">

							<?php echo '<input type="hidden" value="'.$_REQUEST['id'].'" name="id">'; ?>
                        
								<div class="row">
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="song-title">Song Title</label>
											<input type="text" name="title" value="<?php echo $arr['name']; ?>" class="form-control" id="song-title" aria-describedby="song-help" placeholder="Add a song title">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="song-description">Song Description</label>
											<input type="text" name="description" value="<?php echo $arr['description']; ?>" class="form-control" id="song-description" aria-describedby="song-des-help" placeholder="Add a song description">
										</div>
									</div>
								</div>


                                <div class="row">
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="song-length">Song Length</label>
											<input type="text" name="length" value="<?php echo $arr['length']; ?>" class="form-control" id="song-length" aria-describedby="song-length-help" placeholder="Ex. 05:34">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group text-left">
										    <label for="artist">Song Artist</label>
										    <select class="form-control" id="artist" name="artist">
										    <?php foreach ($arr_artist as $key) {
										    	echo '<option value="'.$key['id'].'">'.$key['name'].'</option>';
										    } ?>
										    </select>
										  </div>
									</div>
								</div>

                                <div class="row">
									<div class="col-md-6">
										<div class="form-group text-left">
										    <label for="artist">Song Genre</label>
										    <select class="form-control" id="artist" name="genre">
										    <?php foreach ($arr_genre as $key) {
										    	echo '<option value="'.$key['id'].'">'.$key['name'].'</option>';
										    } ?>
										    </select>
										  </div>
									</div>
									<div class="col-md-6">
										<div class="form-group text-left">
										    <label for="artist">Song Mood</label>
										    <select class="form-control" id="artist" name="mood">
										    <?php foreach ($arr_mood as $key) {
										    	echo '<option value="'.$key['id'].'">'.$key['name'].'</option>';
										    } ?>
										    </select>
										  </div>
									</div>
								</div>

                                <div class="row upload-song-div">
                                    <div class="col-12">

                                    <h6 class="upload-song">Upload Song File</h6>

                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="song-upload">
                                        <label class="custom-file-label" for="song-upload">Choose...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                    
                                    </div>
                                </div>

								<div class="row">
									<div class="col text-right section-buttons">
										<button type="submit" class="btn btn-outline-success">Update Song</button>
										<a href="songs-list.php" class="btn btn-outline-success">Dismiss</a>
									</div>
								</div>
								

                            </form>
                            
                            <?php } ?>

						</div>
					</div>
				</div>
			</div>