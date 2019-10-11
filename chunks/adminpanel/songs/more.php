<?php
include_once("../backend/connection-pdo.php");

if (isset($_REQUEST['id'])) {

	$sql = "SELECT songs_table.id, songs_table.path, songs_table.description, genre_table.name AS gname, mood_table.name AS mname, songs_table.name AS sname, songs_table.length, artist_table.name AS aname FROM songs_table LEFT JOIN genre_table ON songs_table.genre_id = genre_table.id LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id LEFT JOIN mood_table ON songs_table.mood_id = mood_table.id WHERE songs_table.id = ?";

	$query  = $pdoconn->prepare($sql);
	$query->execute([$_REQUEST['id']]);

	$arr_all=$query->fetchAll(PDO::FETCH_ASSOC);

} else {
	session_start();
	$_SESSION['error'] = "No ID Parameter Found!";
	header('location: songs-list.php');
}


?>




<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="main-section">
							<h2 class="content-heading">Song Details</h2>


						<?php 
						
						// session_destroy();

                        if(isset($_SESSION['error'])){
							echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
							unset($_SESSION['error']);
                        }
						?>
								

                            <form method="post" action="../backend/admin/add-songs.php" enctype="multipart/form-data">
                        		
                        		<?php foreach ($arr_all as $key) {
                        			# code...
                        		   ?>




								<div class="row">
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="song-title">Song Title</label>
											<input type="text" name="title" class="form-control" id="song-title" aria-describedby="song-help" value="<?php echo $key['sname']; ?>" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="song-description">Song Description</label>
											<input type="text" name="description" class="form-control" id="song-description" aria-describedby="song-des-help" value="<?php echo $key['description']; ?>" disabled>
										</div>
									</div>
								</div>


                                <div class="row">
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="song-length">Song Length</label>
											<input type="text" name="length" class="form-control" id="song-length" aria-describedby="song-length-help" value="<?php echo $key['length']; ?>" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="song-artist">Song Artist</label>
											<input type="text" name="artist" class="form-control" id="song-artist" aria-describedby="song-artist-help" value="<?php echo $key['aname']; ?>" disabled>
										</div>
									</div>
								</div>

                                <div class="row">
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="song-genre">Song Genre</label>
											<input type="text" name="genre" class="form-control" id="song-genre" aria-describedby="song-genre-help" value="<?php echo $key['gname']; ?>" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="song-mood">Song Mood</label>
											<input type="text" name="mood" class="form-control" id="song-mood" aria-describedby="song-mood-help" value="<?php echo $key['mname']; ?>" disabled>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-md-12">
										<div class="form-group text-left">
											<label for="song-genre">File Path</label>
											<input type="text" name="genre" class="form-control" id="song-genre" aria-describedby="song-genre-help" value="<?php echo $key['path']; ?>" disabled>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col text-right section-buttons">
										<a href="songs-edit.php?id=<?php echo $_REQUEST['id']; ?>" class="btn btn-outline-success">Edit Song</a>
										<a href="songs-list.php" class="btn btn-outline-success">Dismiss</a>
									</div>
								</div>
								
								<?php } ?>
							</form>

						</div>
					</div>
				</div>
			</div>