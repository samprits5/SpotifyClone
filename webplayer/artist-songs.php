<?php include_once("./layout/head.php") ?>

<?php include_once("./layout/left-sidebar.php") ?>

<?php


include_once("../backend/connection-pdo.php");

if (isset($_REQUEST['aid'])) {

	$emp = false;

	$sql = "SELECT songs_table.id, songs_table.name AS sname, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id WHERE songs_table.artist_id = ?";

	$query  = $pdoconn->prepare($sql);
	$query->execute([$_REQUEST['aid']]);
	$arr=$query->fetchAll(PDO::FETCH_ASSOC);


	if (empty($arr)) {

		$emp = true;

		$sql = "SELECT songs_table.id, songs_table.name AS sname, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id";

		$query  = $pdoconn->prepare($sql);
		$query->execute();
		$arr=$query->fetchAll(PDO::FETCH_ASSOC);
	}

		$sql = "SELECT name FROM artist_table WHERE id = ?";

		$query  = $pdoconn->prepare($sql);
		$query->execute([$_REQUEST['aid']]);
		$arr_gen=$query->fetchAll(PDO::FETCH_ASSOC);
		$artist_name = '';
		foreach ($arr_gen as $key) {
			$artist_name = $key['name'];
		}

} else {

	$emp = true;

	$sql = "SELECT songs_table.id, songs_table.name AS sname, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id";

	$query  = $pdoconn->prepare($sql);
	$query->execute();
	$arr=$query->fetchAll(PDO::FETCH_ASSOC);

}


?>

        <section id="section-main">
            <div class="filterNav">
                <a href="./" class="filterNav-link">Featured</a>
                <a href="./categories.php" class="filterNav-link">Categories</a>
                <a href="./genre.php" class="filterNav-link">Genre</a>
                <a href="./moods.php" class="filterNav-link">Mood</a>
                <a href="./artists.php" class="filterNav-link active">Artists</a>
                <a href="./favorites.php" class="filterNav-link">Favorites</a>
            </div>
            <div class="music">
                <div class="music-page">
                    <div class="music-head">
                        <div class="music-head-item">
                            <?php if ($emp) {
                            	echo '<p>No such songs of this Artist. Showing all the songs!</p>';
                            } else {
                            	echo '<h1>All The '.$artist_name.'\'s Songs</h1>';
                            } ?>
                        </div>
<!--                         <div class="music-head-item">
                            <a href="#" class="viewMore">View More</a>
                        </div> -->
                    </div>
                    <div class="music-row">
                    <?php $count = 1; ?>
                    <?php foreach ($arr as $key) { ?>
                        <a href="
                        <?php if($emp) {
                        	echo './artist-songs.php?id='.$key['id'];
                        } else {
                        	echo './artist-songs.php?aid='.$_REQUEST['aid'].'&id='.$key['id'];
                        } ?>" class="music-col">
                            <div class="music-img">
                                <img src="../images/home<?php echo $count; ?>.jpg" alt="night" class="img-fluid">
                                <button class="music-playBtn">
                                    <img src="../images/play.svg" alt="play">
                                </button>
                            </div>
                            <h3><?php echo $key['sname']; ?></h3>
                            <h5><?php echo $key['aname']; ?></h5>
                        </a>
                    <?php $count++; ?>
                    <?php if ($count > 6) {
                    	$count = 1;
                    } ?>
                    <?php } ?>
                        
                    </div>
                </div>
            </div>
        </section>
    
<?php include_once("./layout/player.php") ?>

<?php include_once("./layout/bottom.php") ?>