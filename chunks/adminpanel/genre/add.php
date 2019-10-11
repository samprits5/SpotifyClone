<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="main-section">
							<h2 class="content-heading">Add Genre</h2>


						<?php 
						
						// session_destroy();

                        if(isset($_SESSION['error'])){
							echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
							unset($_SESSION['error']);
                        }
						?>
								

                            <form method="post" action="../backend/admin/add-genre.php">
                        
								<div class="row">
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="genre-name">Genre Name</label>
											<input type="text" name="name" class="form-control" id="genre-name" aria-describedby="genre-help" placeholder="Add a new genre name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group text-left">
											<label for="genre-description">Genre Description</label>
											<input type="text" name="description" class="form-control" id="genre-description" aria-describedby="genre-des-help" placeholder="Add a genre description">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col text-right section-buttons">
										<button type="submit" class="btn btn-outline-success">Add Genre</button>
										<a href="genre-list.php" class="btn btn-outline-success">Dismiss</a>
									</div>
								</div>
								

							</form>

						</div>
					</div>
				</div>
			</div>