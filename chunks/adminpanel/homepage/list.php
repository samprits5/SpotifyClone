<?php
include_once("../backend/connection-pdo.php");

$sql = "SELECT home_table.id, home_table.name AS tname, home_table.artist, songs_table.name AS sname FROM home_table LEFT JOIN songs_table ON home_table.song_id = songs_table.id;";

$query  = $pdoconn->prepare($sql);
$query->execute();

$arr_login=$query->fetchAll(PDO::FETCH_ASSOC);


?>




<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="main-section">
							<h2 class="content-heading">Home Page Songs</h2>


						<?php 
						
						// session_destroy();

                        if(isset($_SESSION['error'])){
							echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
							unset($_SESSION['error']);
                        }
                        ?>
                        

                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Artist</th>
                                <th scope="col">Song</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count = 1;
                                    foreach($arr_login as $arr) {
                                ?>

                                <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $arr['tname']; ?></td>
                                <td><?php echo $arr['artist']; ?></td>
                                <td><?php echo $arr['sname']; ?></td>
                                <td><a href="<?php echo "homepage-edit.php?id=".$arr['id']; ?>"><span class="badge badge-info">Edit</span></a></td>
                                </tr>


                                <?php

                                $count++;
                                }

                                ?>
                            </tbody>
                            </table>

							

						</div>
					</div>
				</div>
			</div>