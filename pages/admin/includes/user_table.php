<?php 
    if (isset($_GET['delete'])) 
    {
        User::deleteById($_GET['delete']);
    }
    if (isset($_GET['ban'])) 
    {
        User::banUser($_GET['ban']);
    }
    if (isset($_GET['unban'])) 
    {
        User::unbanUser($_GET['unban']);
    }

?>

<h4>Add user</h4>
        <a class="btn btn-primary" href="user.php?add">Přidat</a>
        <hr>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Users Info</p>
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
                                <th>Online</th>
                                <th>First & Last name</th>
                                <th>Usernames</th>
                                <th>email</th>
                                <th>role</th>
                                <th>date of registration</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach (User::getAll() as $user) { ?>
                            <tr>
                                <td><?php echo $user->data['id']?></td>
                                <td style="text-align: center"><span class="dot dot-online"></span></td>
                                <td><img class="rounded-circle me-2" width="30" height="30" src="../../images/userProfiles/<?php echo $user->data['image']; ?>"><?php echo $user->data['first_name']. " ".$user->data['second_name'] ?></td>
                                <td><?php echo $user->data['username']?></td>
                                <td><?php echo $user->data['email']?></td>
                                <td><?php echo $user->getNameOfRole();?></td>
                                <td><?php echo $user->data['date_of_create']?></td>
                                <td><?php echo $user->getStatusText();?></td>
                                <td><a href="user.php?update=<?php echo $user->data['id']?>">Upravit</a></td>
                                <?php 
                                    if ($user->isBanned()) 
                                    {
                                        echo "<td><a href='user.php?unban={$user->data['id']}'>Unban</a></td>";
                                    }
                                    else 
                                    {
                                        echo "<td><a href='user.php?ban={$user->data['id']}'>Ban</a></td>";
                                    }
                                ?>
                                <td><a onclick="javascript: return confirm('are y sure?')" href="user.php?delete=<?php echo $user->data['id']?>">Smazat</a></td>
                            </tr>
                            <?php }?>

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