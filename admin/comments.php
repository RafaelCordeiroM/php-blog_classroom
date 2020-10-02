<?php include "includes/header.php"; ?>

<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">

        <?php
        
            if(isset($_GET['source'])){

                switch($_GET['source']){
                    case 'add_comment':
                        include "includes/add_comment.php";
                    break;
                    default:
                        include "includes/view_comments.php";
                    ;
                }
            }
            if(!isset($_GET['source'])){
                include "includes/view_comments.php";
            }
        
        ?>
        
        </div>
    </div>

</div>



<?php include "includes/footer.php" ?>