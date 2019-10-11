<?php
if(!isset($_REQUEST['id'])){


	include_once("../backend/connection-pdo.php");

	$sql = "SELECT songs_table.id AS sid, users_table.id AS uid, users_table.name AS uname, songs_table.name AS sname, artist_table.name AS aname, genre_table.name AS gname, mood_table.name AS mname FROM favorites_table LEFT JOIN users_table ON favorites_table.user_id = users_table.id LEFT JOIN songs_table ON favorites_table.song_id = songs_table.id LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id LEFT JOIN genre_table ON songs_table.genre_id = genre_table.id LEFT JOIN mood_table ON songs_table.mood_id = mood_table.id";

	$query  = $pdoconn->prepare($sql);

	$query->execute();

	$arr_login=$query->fetchAll(PDO::FETCH_ASSOC);

	
    
} else {

	$id = $_REQUEST['id'];
	
	include_once("../backend/connection-pdo.php");

	$sql = "SELECT songs_table.id AS sid, users_table.id AS uid, users_table.name AS uname, songs_table.name AS sname, artist_table.name AS aname, genre_table.name AS gname, mood_table.name AS mname FROM favorites_table LEFT JOIN users_table ON favorites_table.user_id = users_table.id LEFT JOIN songs_table ON favorites_table.song_id = songs_table.id LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id LEFT JOIN genre_table ON songs_table.genre_id = genre_table.id LEFT JOIN mood_table ON songs_table.mood_id = mood_table.id WHERE favorites_table.user_id = ?";

	$query  = $pdoconn->prepare($sql);

	$query->execute([$id]);

	$arr_login=$query->fetchAll(PDO::FETCH_ASSOC);

}


?>




<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="main-section">
							<h2 class="content-heading">Favorite's List</h2>


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
                                <th scope="col">User Name</th>
                                <th scope="col">Song Name</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Artist</th>
                                <th scope="col">Mood</th>
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
                                <td><?php echo $arr['uname']; ?></td>
                                <td><?php echo $arr['sname']; ?></td>
                                <td><?php echo $arr['gname']; ?></td>
                                <td><?php echo $arr['aname']; ?></td>
                                <td><?php echo $arr['mname']; ?></td>
                                <td><a href="<?php echo "../backend/admin/delete-favorite.php?sid=".$arr['sid']."&uid=".$arr['uid']; ?>"><span class="badge badge-danger">Delete</span></a>
                                &nbsp;&nbsp;
                                <a href="<?php echo "songs-more.php?id=".$arr['sid']; ?>"><span class="badge badge-success">Song Detail</span></a></td>
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