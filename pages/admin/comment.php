<?php include "includes/header.php"?>
    <div id="wrapper">
        <?php include "includes/side_navbar.php"?> 
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include "includes/navbar.php"?> 
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Comments</h3>
                    <hr>
                    <?php 
                        if (isset($_GET['add'])) 
                        {
                            include_once "includes/comment_add.php";
                        }
                        elseif (isset($_GET['update'])) 
                        {
                            $id = $_GET['update'];
                            include_once "includes/comment_update.php";
                        }
                        else 
                        {
                            include_once "includes/comment_table.php";
                        }
                    ?>
                    
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <?php include "includes/footer.php"?> 