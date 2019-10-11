
<?php require('../chunks/adminpanel/layout/header.php'); ?>

<?php require('../chunks/adminpanel/layout/sidenav.php'); ?>

    <div id="content">

        <?php require('../chunks/adminpanel/layout/topnav.php'); ?>

        <?php

            if(isset($_SESSION['msg'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$_SESSION['msg'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';

                unset($_SESSION['msg']);
            }
        ?>

    </div>



<?php require('../chunks/adminpanel/layout/footer.php'); ?>