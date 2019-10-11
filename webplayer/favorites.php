<?php include_once("./layout/head.php") ?>

<?php include_once("./layout/left-sidebar.php") ?>

<?php


include_once("../backend/connection-pdo.php");


$sql = "SELECT songs_table.id, songs_table.name AS sname, artist_table.name AS aname FROM favorites_table LEFT JOIN songs_table ON favorites_table.song_id = songs_table.id LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id WHERE favorites_table.user_id = ?";

$query  = $pdoconn->prepare($sql);
$query->execute([$_SESSION['user_id']]);
$arr=$query->fetchAll(PDO::FETCH_ASSOC);


?>

        <section id="section-main">
            <div class="filterNav">
                <a href="./" class="filterNav-link">Featured</a>
                <a href="./categories.php" class="filterNav-link">Categories</a>
                <a href="./genre.php" class="filterNav-link">Genre</a>
                <a href="./moods.php" class="filterNav-link">Mood</a>
                <a href="./artists.php" class="filterNav-link">Artists</a>
                <a href="./favorites.php" class="filterNav-link active">Favorites</a>
            </div>
            <div class="music">
                <div class="music-page">
                    <div class="music-head">
                        <div class="music-head-item">
                            <h1>Your Favorites</h1>
                        </div>
<!--                         <div class="music-head-item">
                            <a href="#" class="viewMore">View More</a>
                        </div> -->
                    </div>
                    <div class="music-row">
                    <?php $count = 1; ?>
                    <?php foreach ($arr as $key) { ?>
                        <a href="./favorites.php?id=<?php echo $key['id']; ?>" class="music-col">
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