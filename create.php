<?php
$title = "Create page";
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

    $fileExtaintion = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $allowedExtension = ["png", "jpg", "jpeg", "webp", "avif"];
    $fileValidation =  in_array($fileExtaintion, $allowedExtension);

    if ($fileValidation) {
        $fileName = $_FILES['file']['name'];
        $filePath = $_FILES['file']['tmp_name'];
        $uploadFolder = 'files/' . $fileName;

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
            if (move_uploaded_file($filePath, $uploadFolder)) {
                // ✅ Insert all data + file together
                $query = "INSERT INTO users (name, email, password, mobile, files)
                      VALUES ('$name', '$email', '$password', '$mobile', '$fileName')";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "<script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'User and file uploaded successfully!',
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
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'File upload failed!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
            }
        }
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'File extaintion png , jpg , jpeg, webp , avif are allowed only !',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
        </script>";
    }
}
?>



<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-5 bg-secondary p-3 text-white rounded">
        <form action="" method="POST" class="" enctype="multipart/form-data">
            <h2 class="text-center mb-3">Create User</h2>
            <div class="form-group mb-3">
                <label for="Uname" class="form-lable fw-bold">Name</label>
                <input type="text" class="form-control" name="user" id="Uname">
            </div>
            <div class="form-group mb-3">
                <label for="Uemail" class="form-lable fw-bold">Email</label>
                <input type="email" class="form-control" name="email" id="Uemail">
            </div>
            <div class="form-group mb-3">
                <label for="Upassword" class="form-lable fw-bold">Password</label>
                <input type="password" class="form-control" name="password" id="Upassword">
            </div>
            <div class="form-group mb-3">
                <label for="Uphone" class="form-lable fw-bold">Mobile</label>
                <input type="tel" class="form-control" name="mobile" id="Uphone">
            </div>
            <div class="form-group mb-3">
                <label for="fileUpload" class="form-label fw-bold">Choose any file</label>
                <input type="file" class="form-control" id="fileUpload" name="file">
            </div>
            <div class="form-group mb-3 mt-5">
                <input type="submit" class="form-control bg-primary text-white fw-bold" value="Add User" name="btn">
            </div>
        </form>
    </div>
</div>

<?php include_once("./footer.php"); ?>