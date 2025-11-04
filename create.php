<?php
$title = "Home page";
include_once("config.php");
include_once("header.php");
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_POST['btn'])) {
    $name = trim($_POST['user']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $mobile = trim($_POST['mobile']);

    // ✅ Step 1: Check if any field is empty
    if (empty($name) || empty($email) || empty($password) || empty($mobile)) {
        echo "<script>
            Swal.fire({
                title: 'Warning!',
                text: 'Please fill in all the fields!',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {
        // ✅ Step 2: Insert data if all fields filled
        $query = "INSERT INTO users (name, email, password, mobile) 
                  VALUES ('$name', '$email', '$password', '$mobile')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Data inserted successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'read.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Data insertion failed: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    }

    mysqli_close($conn);
}
?>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-5 bg-secondary p-3 text-white rounded">
        <form action="" method="POST">
            <h2 class="text-center mb-3">Create User</h2>
            <div class="form-group mb-3">
                <label for="Uname" class="form-lable">Name</label>
                <input type="text" class="form-control" name="user" id="Uname">
            </div>
            <div class="form-group mb-3">
                <label for="Uemail" class="form-lable">Email</label>
                <input type="email" class="form-control" name="email" id="Uemail">
            </div>
            <div class="form-group mb-3">
                <label for="Upassword" class="form-lable">Password</label>
                <input type="password" class="form-control" name="password" id="Upassword">
            </div>
            <div class="form-group mb-3">
                <label for="Uphone" class="form-lable">Mobile</label>
                <input type="tel" class="form-control" name="mobile" id="Uphone">
            </div>
            <div class="form-group mb-3 mt-5">
                <input type="submit" class="form-control bg-primary text-white fw-bold" value="Add User" name="btn">
            </div>
        </form>
    </div>
</div>

<?php include_once("./footer.php"); ?>
