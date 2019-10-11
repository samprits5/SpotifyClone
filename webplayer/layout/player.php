</div>


<?php 


include_once("../backend/connection-pdo.php");

if (isset($_REQUEST['id'])) {
    
    $sql = "SELECT songs_table.id, songs_table.name AS sname, songs_table.length, songs_table.path, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id WHERE songs_table.id = ?";

    $query  = $pdoconn->prepare($sql);
    $query->execute([$_REQUEST['id']]);
    $arr_song=$query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($arr_song)) {
        $query  = $pdoconn->prepare($sql);
        $query->execute(["24"]);
        $arr_song=$query->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT songs_table.id, songs_table.name AS sname, songs_table.length, songs_table.path, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id WHERE songs_table.id = ?";

        $query  = $pdoconn->prepare($sql);
        $query->execute([  strval(24 - 1) ]);
        $arr_prev=$query->fetchAll(PDO::FETCH_ASSOC);


        if (!empty($arr_prev)) {
            $prev_id = 24 - 1;
        } else {
            $prev_id = -1;
        }


        $sql = "SELECT songs_table.id, songs_table.name AS sname, songs_table.length, songs_table.path, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id WHERE songs_table.id = ?";

        $query  = $pdoconn->prepare($sql);
        $query->execute([  strval(24 + 1) ]);
        $arr_next=$query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($arr_next)) {

            $next_id = 24 + 1;

        } else {

            $next_id = -1;
        }

        $sql = "SELECT * FROM favorites_table WHERE user_id = ? AND song_id = ?";

        $query  = $pdoconn->prepare($sql);
        $query->execute([$_SESSION['user_id'], $_REQUEST['id']]);
        $arr_fav=$query->fetchAll(PDO::FETCH_ASSOC);
    
    } else {


    $sql = "SELECT songs_table.id, songs_table.name AS sname, songs_table.length, songs_table.path, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id WHERE songs_table.id = ?";

    $query  = $pdoconn->prepare($sql);
    $query->execute([  strval(intval($_REQUEST['id']) - 1) ]);
    $arr_prev=$query->fetchAll(PDO::FETCH_ASSOC);


    if (!empty($arr_prev)) {
        $prev_id = intval($_REQUEST['id']) - 1;
    } else {
        $prev_id = -1;
    }


    $sql = "SELECT songs_table.id, songs_table.name AS sname, songs_table.length, songs_table.path, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id WHERE songs_table.id = ?";

    $query  = $pdoconn->prepare($sql);
    $query->execute([  strval(intval($_REQUEST['id']) + 1) ]);
    $arr_next=$query->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($arr_next)) {

        $next_id = intval($_REQUEST['id']) + 1;

    } else {

        $next_id = -1;
    }

    $sql = "SELECT * FROM favorites_table WHERE user_id = ? AND song_id = ?";

    $query  = $pdoconn->prepare($sql);
    $query->execute([$_SESSION['user_id'], $_REQUEST['id']]);
    $arr_fav=$query->fetchAll(PDO::FETCH_ASSOC);

}

} else {


    $sql = "SELECT songs_table.id, songs_table.name AS sname, songs_table.length, songs_table.path, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id WHERE songs_table.id = ?";

    $query  = $pdoconn->prepare($sql);
    $query->execute(["24"]);
    $arr_song=$query->fetchAll(PDO::FETCH_ASSOC);


    $sql = "SELECT songs_table.id, songs_table.name AS sname, songs_table.length, songs_table.path, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id WHERE songs_table.id = ?";

    $query  = $pdoconn->prepare($sql);
    $query->execute([  strval(24 - 1) ]);
    $arr_prev=$query->fetchAll(PDO::FETCH_ASSOC);


    if (!empty($arr_prev)) {
        $prev_id = 24 - 1;
    } else {
        $prev_id = -1;
    }


    $sql = "SELECT songs_table.id, songs_table.name AS sname, songs_table.length, songs_table.path, artist_table.name AS aname FROM songs_table LEFT JOIN artist_table ON songs_table.artist_id = artist_table.id WHERE songs_table.id = ?";

    $query  = $pdoconn->prepare($sql);
    $query->execute([  strval(24 + 1) ]);
    $arr_next=$query->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($arr_next)) {

        $next_id = 24 + 1;

    } else {

        $next_id = -1;
    }

    $sql = "SELECT * FROM favorites_table WHERE user_id = ? AND song_id = ?";

    $query  = $pdoconn->prepare($sql);
    $query->execute([$_SESSION['user_id'], "24"]);
    $arr_fav=$query->fetchAll(PDO::FETCH_ASSOC);



}

?>





    <footer id="player-main" class="player">

        <?php foreach ($arr_song as $key) { ?>
        <div class="player-song">
            <div class="player-song-img">
                <img src="../images/piano.jpg" alt="piano">
            </div>
            <div class="player-song-name">
                <a href="#">
                    <h3><?php echo $key['sname']; ?></h3>
                </a>
                <a href="#">By <?php echo $key['aname']; ?></a>

            </div>
            <div class="player-song-addFav">
                <button type="button" song_id="<?php echo $key['id']; ?>" user_id="<?php echo $_SESSION['user_id']; ?>" class="addToFav <?php if(!empty($arr_fav)) echo 'inFav'; ?>" id="addToFav"></button>
            </div>
        </div>
        <div class="player-controls-main">
            <div class="player-controls">
                <button id="repeat" class="player-controls-btn"></button>
                <button id="prev" <?php if ($prev_id != -1) {
                    echo 'onclick="location.href=\''.'./?id='.$prev_id.'\';"';
                } ?> class="player-controls-btn<?php if($prev_id == -1) echo ' disabled'; ?>" ></button>
                <button id="play" class="player-controls-btn"></button>
                <button id="next" <?php if ($next_id != -1) {
                    echo 'onclick="location.href=\''.'./?id='.$next_id.'\';"';
                } ?> class="player-controls-btn<?php if($next_id == -1) echo ' disabled'; ?>"></button>
                <div id="volume">
                    <button id="volume-icon" class="player-controls-btn"></button>
                    <div id="volume-range-main">
                        <div id="volume-range">
                            <div id="volume-range-bar" data-value="100"></div>
                            <div id="volume-range-thumb"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="player-controls-duration">
                <span id="startTime">0:00</span>
                <div id="duration-range-main">
                    <div id="duration-range">
                        <div id="duration-range-bar"></div>
                        <div id="duration-range-thumb"></div>
                    </div>
                </div>
                <span id="endTime"><?php echo $key['length'] ?></span>
            </div>

            <audio id="musicPlayer" src="<?php echo '../'.$key['path'] ?>"></audio>
        </div>
        <!-- <div class="player-menu"></div> -->
    <?php } ?>
    </footer>
</div>