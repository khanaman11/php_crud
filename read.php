<?php
$title = "Read page";
include_once("config.php");
include_once("header.php");

$query = "SELECT * FROM users";

$resultSet = mysqli_query($conn, $query);

// $data = mysqli_fetch_assoc($resultSet);

?>


<div class="container mt-3">
    <div class="row">
        <div class="col-12 table-responsive">
            <div class="titel-box d-flex justify-content-between align-items-center mb-2">
                <h2 class="text-center m-0">Read user</h2>
                <a href="create.php" class="btn btn-primary fw-bold">Add User</a>
            </div>
            <table class="table table-striped table-bordered table-hover table-sm text-center">
                <thead class="table-success">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultSet as $key => $userdetails) { ?>
                        <tr>
                            <td><?php echo $userdetails["id"] ?></td>
                            <td><?php echo $userdetails["name"] ?></td>
                            <td><?php echo $userdetails["email"] ?></td>
                            <td><?php echo $userdetails["password"] ?></td>
                            <td><?php echo $userdetails["mobile"] ?></td>
                            <td>
                                <a href="delete.php?id=<?php echo $userdetails['id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this record?');">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </a>

                                <a href="update.php?id=<?php echo $userdetails['id']; ?>"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once("footer.php") ?>