<?php
$title = "Update page";
include_once("config.php");
include_once("header.php");

$selectedId = $_GET["id"];

$query = "SELECT * FROM users where id = $selectedId";
$result = mysqli_query($conn, $query);

foreach ($result as $key => $data) {
    $userId =  $data['id'];
    $userName =  $data['name'];
    $userEmail =  $data['email'];
    $userPassword =  $data['password'];
    $userMobile =  $data['mobile'];
}
?>

<?php
if (isset($_POST['btn'])) {
    $name = trim($_POST['user']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $mobile = trim($_POST['mobile']);


    $query = "UPDATE users 
              SET name = '$name', 
                  email = '$email', 
                  password = '$password', 
                  mobile = '$mobile' 
               WHERE id = $selectedId";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Data updated successfully!',
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
                    text: 'Data updated failed: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
    }
}

?>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-5 bg-secondary p-3 text-white rounded">
        <form action="" method="POST">
            <h2 class="text-center mb-3">Update User</h2>
            <div class="form-group mb-3">
                <label for="Uname" class="form-lable">Name</label>
                <input type="text" class="form-control" name="user" id="Uname" value="<?php echo $userName ?>">
            </div>
            <div class="form-group mb-3">
                <label for="Uemail" class="form-lable">Email</label>
                <input type="email" class="form-control" name="email" id="Uemail" value="<?php echo $userEmail ?>">
            </div>
            <div class="form-group mb-3">
                <label for="Upassword" class="form-lable">Password</label>
                <input type="password" class="form-control" name="password" id="Upassword" value="<?php echo $userPassword ?>">
            </div>
            <div class="form-group mb-3">
                <label for="Uphone" class="form-lable">Mobile</label>
                <input type="tel" class="form-control" name="mobile" id="Uphone" value="<?php echo $userMobile ?>">
            </div>
            <div class="form-group mb-3 mt-5">
                <input type="submit" class="form-control bg-primary text-white fw-bold" value="Update User" name="btn">
            </div>
        </form>
    </div>
</div>



<?php include_once("footer.php") ?>