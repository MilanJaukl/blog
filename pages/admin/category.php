<?php include "includes/header.php" ?>

<?php 
// tvorba kategorii
// parr: name, active
// database: name, active, creator 
    $update = false;
    if (isset($_POST['submit'])) 
    {
        $data = Form::clearPOSTSubmit($_POST);
        $data['name'] = Database::clean_string_input($data['name']);
        $data['creator'] = 22;
        Category::create($data);

    }
    if (isset($_POST['update'])) 
    {
        $data = Form::clearPOSTUpdate($_POST);
        Category::updateById($_GET['update'], $data);
    }

    if (isset($_GET['delete'])) 
    {
        Category::deleteById($_GET['delete']);
        header("Location: category.php");
    }
    if (isset($_GET['update'])) 
    {
        $update = true;
        $id = $_GET['update'];
    }
?>

    <div id="wrapper">
        <?php include "includes/side_navbar.php"?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include "includes/navbar.php" ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Kategorie</h3>
                    <hr>
                    <h4>Pridavani kategorii</h4>
                    <form class="needs-validation" action="" method="post" novalidate>
                        <div class="row">
                            <div class="col-4">
                                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Akcie, Komodity, FOREX" required>
                                <div class="valid-feedback">
                                    V pořádku
                                </div>
                                <div class="invalid-feedback">
                                    Prosím vyplňte název kategorie
                                </div>
                            </div>
                            <div class="col-3">
                                <select name="active" class="form-select" aria-label="Default select example">
                                    <option value="1">Aktivní</option>
                                    <option value="0">Neaktivní</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input class="btn btn-primary mt-1" type="submit" name="submit" value="Přidat">
                            </div>
                        </div>
                    </form>
                    <hr>
                    <h4>Úprava kategorii</h4>
                    <?php if($update){ 
                       $editCategory = Category::getById($id) 
                    ?>
                        <form class="needs-validation" action="" method="post" novalidate>
                        <div class="row">
                            <div class="col-4">
                                <input name="name" value="<?php echo $editCategory->data['name']?>" type="text" class="form-control" id="exampleFormControlInput1" required>
                                <div class="valid-feedback">
                                    V pořádku
                                </div>
                                <div class="invalid-feedback">
                                    Prosím vyplňte název kategorie
                                </div>
                            </div>
                            <div class="col-3">
                                <select name="active" class="form-select" aria-label="Default select example">
                                    <option value="1" <?php if($editCategory->data['active'] == 1) {echo "selected";} ?>>Aktivní</option>
                                    <option value="0" <?php if($editCategory->data['active'] == 0) {echo "selected";} ?>>Neaktivní</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input class="btn btn-warning mt-1" type="submit" name="update" value="Uložit">
                                <a href="category.php">Zrušit</a>
                            </div>
                        </div>
                    </form>
                    <?php } else {?>
                    <p>Vyberte kategorii</p>
                    <?php } ?>
                    <hr>
                    <div class="card shadow mt-1">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Výpis kategorií</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table id="mytable" class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Number of posts</th>
                                            <th>Status</th>
                                            <th>Smazána</th>
                                            <th>Date of create</th>
                                            <th>Creator</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (Category::getAll() as $category) { ?>
                                            <tr data-id="<?php echo $category->data['id']; ?>" class="showModal"> 
                                                <td><?php echo $category->data['id'];?></td>
                                                <td><?php echo $category->data['name'];?></td>
                                                <td><?php print_r($category->numberOfPosts()) ?></td>
                                                <td><?php if($category->isActive()) {echo "Aktivní";}else {echo "Neaktivní";} ?></td>
                                                <td><?php if($category->isDeleted()) {echo "Ano";} else {echo "ne";}?></td>
                                                <td><?php echo $category->data['date_of_create'];?></td>
                                                <td><?php echo $category->data['creator'];?></td>
                                                <td><a href="category.php?delete=<?php echo $category->data['id'];?>">Smazat</a></td>
                                                <td><a href="category.php?update=<?php echo $category->data['id'];?>">Upravit</a></td>
                                            </tr>

                                        <?php  } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Id</strong></td>
                                            <td><strong>Name</strong></td>
                                            <td><strong>Number of posts</strong></td>
                                            <td><strong>Date of create</strong></td>
                                            <td><strong>active</strong></td>
                                            <td><strong>Salary</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upravit kategorii</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Nazev kategorie
                <input class="form-control" type="text" placeholder="default">
                <br>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Smazáno</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Aktivní</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
<!-- modal -->

    <script type="text/javascript">
        (() => {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                    }, false)
                })
            })();

            // const myModal = document.getElementById('myModal')
            // const myInput = document.getElementById('myInput')

            // myModal.addEventListener('shown.bs.modal', () => {
            // myInput.focus()
// })
            // $(document).ready(function() 
            // {
            //     $('.showModal').click(function () 
            //     {
            //         var userId = $(this).data('id');
            //         alert(userId);
            //     });
            // });
            
    </script>

    <?php include "includes/footer.php"; ?>