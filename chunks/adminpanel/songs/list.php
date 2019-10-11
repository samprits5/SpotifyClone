
<?php
include_once("../backend/connection-pdo.php");

$sql = "SELECT songs_table.id, songs_table.path, genre_table.name AS gname, songs_table.name AS sname, songs_table.length, artist_table.name AS aname FROM songs_table LEFT JOIN genre_table ON songs_table.genre_id = genre_table.id LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id";

$query  = $pdoconn->prepare($sql);
$query->execute();

$arr_login=$query->fetchAll(PDO::FETCH_ASSOC);



?>





<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="main-section">
							<h2 class="content-heading">Song List</h2>


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
                                <th scope="col">Name</th>
                                <th scope="col">Length</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Artist</th>
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
                                <td><?php echo $arr['sname']; ?><img id="speaker-anim-<?php echo $count; ?>" class="hide-gif" src="../files/speaker.gif" alt=""></td>
                                <td><?php echo $arr['length']; ?></td>
                                <td><?php echo $arr['gname']; ?></td>
                                <td><?php echo $arr['aname']; ?></td>
                                <td><a href="#" onclick="playmusic(<?php echo $count; ?>);"><span id="span<?php echo $count; ?>" class="badge badge-primary">Play</span></a>&nbsp;&nbsp;<audio onended="endAudio();" id="audio<?php echo $count; ?>" src="../<?php echo $arr['path']; ?>" ></audio><a href="<?php echo "songs-edit.php?id=".$arr['id']; ?>"><span class="badge badge-info">Edit</span></a>
                                &nbsp;&nbsp;<a href="<?php echo "../backend/admin/delete-songs.php?id=".$arr['id']; ?>"><span class="badge badge-danger">Delete</span></a>&nbsp;&nbsp;<a href="<?php echo "songs-more.php?id=".$arr['id']; ?>"><span class="badge badge-success">More</span></a></td>
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