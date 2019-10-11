<?php include_once("./layout/head.php") ?>
<?php include("./layout/header.php") ?>

<?php include("./layout/left-sidebar.php") ?>


<?php
include_once("../backend/connection-pdo.php");

$sql = "SELECT * FROM users_table WHERE id = ?";

$query  = $pdoconn->prepare($sql);
$query->execute([$_SESSION['user_id']]);
$arr_all=$query->fetchAll(PDO::FETCH_ASSOC);

?>


            <div class="col-9">
                <div class="section-content">
                    <h3>Profile Overview</h3>
                    <?php

                        if (isset($_SESSION['msg'])) {

                            echo '<div class="alert alert-danger" role="alert" style="border-radius: 0;">'.$_SESSION['msg'].'
                                    </div>';
                            unset($_SESSION['msg']);
                        }


                    ?>
                    <form id="editForm" class="form-account form">

                        <?php foreach ($arr_all as $key) { ?>

                        <div class="form-group">
                            <label for="inputEmail4">Email</label>
                            <div class="form-input-bg">
                                <input type="email" class="form-control" id="inputEmail4" value="<?php echo $key['email']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName44">Name</label>
                            <div class="form-input-bg">
                                <input type="text" class="form-control" id="inputName44" value="<?php echo $key['name']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputGender">Gender</label>
                            <div class="form-input-bg">
                                <input type="text" class="form-control" id="inputGender" value="<?php echo $key['gender']; ?>" disabled>
                            </div>
<!--                             <label for="inputState__">Gender</label>
                            <div class="form-input-bg">
                                <select id="inputState__" class="form-control">
                                    <option selected>Alien Type</option>
                                    <option>...</option>
                                </select>
                            </div> -->
                        </div>

                        <div class="form-group">
                            <label for="inputPassword4">Mobile Number</label>
                            <div class="form-input-bg">
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo $key['number']; ?>" disabled>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="./edit-profile.php" class="button">Edit Profile</a>
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once("./layout/footer.php") ?>

<?php include_once("./layout/bottom.php") ?>