<?php include_once("./layout/head.php") ?>

<div id="root">
    <div class="flexWrapper">
        <header id="header">
            <nav class="nav-main">
                <a href="../" class="nav-brand">Spotify</a>
                <ul>
                    <li class="nav-item">
                        <a href="./" class="nav-link">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./search.php" class="nav-link active">
                            <i class="fas fa-search"></i>
                            Search
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./library.php" class="nav-link">
                            <i class="fas fa-align-right"></i>
                            Library
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="plNames-main">
                <p>Playlist</p>
                <button onclick="location.href='./favorites.php';" type="button" id="createPL">
                    <i class="fas fa-plus-circle"></i>
                    Favorites
                </button>
            </div>
            <a href="../account/overview.php" class="userName">
                <i class="far fa-user"></i>
                <?php echo $_SESSION['user']; ?>
            </a>
        </header>


<?php

$emp = false;

include_once("../backend/connection-pdo.php");

if (isset($_REQUEST['q'])) {


	$param = '%'.$_REQUEST['q'].'%';


	$sql = "SELECT songs_table.id, songs_table.name AS sname, artist_table.name AS aname, genre_table.name AS gname, mood_table.name AS mname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id LEFT JOIN genre_table ON songs_table.genre_id = genre_table.id LEFT JOIN mood_table ON songs_table.mood_id = mood_table.id WHERE songs_table.name LIKE ? OR artist_table.name LIKE ? OR genre_table.name LIKE ? OR mood_table.name LIKE ?;";

	$query  = $pdoconn->prepare($sql);
	$query->execute([$param,$param,$param,$param]);
	$arr=$query->fetchAll(PDO::FETCH_ASSOC);

	if (empty($arr)) {
		$emp = true;
	}

}

?>

        <div id="section-wrapper">
            <form method="get" class="playerSearch" id="playerSearch">
                <input type="text" placeholder="Search Here.." class="playerSearch-input" id="playerSearch-input" value="<?php if(isset($_REQUEST['q'])) echo htmlentities($_REQUEST['q'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>" name="q">
                <button type="submit" id="playerSearch-submit" class="playerSearch-submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <section id="section-main">
                <div class="music">
                    <div class="music-page">

                    	<?php if (!isset($_REQUEST['q'])) {
                    		echo '<p>Search for songs, artists, genre, mood etc...</p>';
                    	} else { ?>


                    	<?php if ($emp) {
                    		echo '<p>Sorry! No result found!</p>';
                    	} else { ?>

        		<?php echo '<p>Search Results For : '.htmlentities($_REQUEST['q'], ENT_QUOTES | ENT_HTML5, 'UTF-8').'</p>'; ?>
				
					<?php for ($i=0; $i < count($arr);) { ?>

                        <div class="music-row">

                    	<?php for ($j=$i; $j < $i + 6; $j++) { ?>
							
							<?php if ($j == count($arr)) {
								break;
							}  ?>
                            <a href="./search.php?q=<?php echo $_REQUEST['q']; ?>&id=<?php echo $arr[$j]['id']; ?>" class="music-col">
                                <div class="music-img">
                                    <img src="../images/night.jpg" alt="night" class="img-fluid">
                                    <button class="music-playBtn">
                                        <img src="../images/play.svg" alt="play">
                                    </button>
                                </div>
                                <h3><?php echo $arr[$j]['sname']; ?></h3>
                            </a>
						<?php } ?>
                        </div>
					<?php $i+=6; ?>

                     <?php } ?>




<?php 
		}
	} 
?>
                    </div>
                </div>
            </section>
        </div>
<?php include_once("./layout/player.php") ?>

<?php include_once("./layout/bottom.php") ?>