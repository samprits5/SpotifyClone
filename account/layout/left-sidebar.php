<?php
include_once("../backend/connection-pdo.php");

$sql = "SELECT * FROM users_table WHERE id = ?";

$query  = $pdoconn->prepare($sql);
$query->execute([$_SESSION['user_id']]);
$arr_all=$query->fetchAll(PDO::FETCH_ASSOC);

?>
<section id="account">
    <div class="container">
        <div class="section-bg">
            <img src="../images/secBg.jpg" alt="" class="img-fluid">
        </div>
        <div class="row no-gutters">
            <div class="col-3">
                <div class="section-menu">
                    <div class="section-menu-user">
                        <form id="upload-profile-pic" class="section-menu-user-img">

                        	<?php foreach ($arr_all as $key) { ?>
                            <!-- <img src="./images/user.svg" alt="user"> -->
                            <input type="hidden" id="_userToken" value="<?php echo $_SESSION['user_id']; ?>">
                            <img src="<?php

                            if(empty($key['path'])){
                                echo '../images/team.jpg';
                            } else {
                                echo $key['path'];
                            }

                            ?>" id="profile-pic-img" alt="user">
                            <label for="addUserImg" id="addUserImg-label">
                                <i class="fas fa-user-edit"></i>
                            </label>
                            <input type="file" name="addUserImg" id="addUserImg">

                        <?php } ?>
                        </form>

                    </div>
                    <ul class="section-menu-nav">
                        <li class="section-menu-nav-item">
                            <a href="./account.php" class="d-block section-menu-nav-link">
                                <span>
                                    <i class="fas fa-home"></i>
                                </span>
                                Account overview
                            </a>
                        </li>
                        <li class="section-menu-nav-item">
                            <a href="./edit-profile.php" class="d-block section-menu-nav-link">
                                <span>
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                                Edit profile
                            </a>
                        </li>
                        <li class="section-menu-nav-item">
                            <a href="./edit-password.php" class="d-block section-menu-nav-link">
                                <span>
                                    <i class="fas fa-lock"></i>
                                </span>
                                Change password
                            </a>
                        </li>
                        <li class="section-menu-nav-item">
                            <a href="#" class="d-block section-menu-nav-link">
                                <span>
                                    <i class="fas fa-user-lock"></i>
                                </span>
                                Privacy settings
                            </a>
                        </li>
                    </ul>
                </div>
            </div>