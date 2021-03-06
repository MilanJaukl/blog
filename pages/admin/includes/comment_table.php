<?php 
    if (isset($_GET['delete'])) 
    {
        Comment::deleteById($_GET['delete']);
    }
?>

<h4 class="text-dark mb-4">Přidat komentář</h4>
                    <a class="btn btn-primary" href="comment.php?add">Přidat komentář</a>
                    <hr>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Výpis komentářů</p>
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
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>post_id</th>
                                            <th>user_id</th>
                                            <th>date</th>
                                            <th>text</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach (Comment::getAll() as $comment) { ?>
                                        <tr>
                                            <td><?php echo $comment->data['id'] ?></td>
                                            <td><?php echo $comment->data['post_id'] ?></td>
                                            <td><?php echo $comment->data['user_id'] ?></td>
                                            <td><?php echo $comment->data['date_of_create'] ?></td>
                                            <td><?php echo $comment->data['text'] ?></td>
                                            <td><?php if ($comment->isBanned()) { echo "zablokován";} else {echo "online";}  ?></td>
                                            <td><a href="comment.php?update=<?php echo $comment->data['id'] ?>">Upravit</a></td>
                                            <td><a href="comment.php?delete=<?php echo $comment->data['id'] ?>">Smazat</a></td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Name</strong></td>
                                            <td><strong>Position</strong></td>
                                            <td><strong>Office</strong></td>
                                            <td><strong>Age</strong></td>
                                            <td><strong>Start date</strong></td>
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