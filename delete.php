<?php
$title = "Delete page";
include_once("config.php");
include_once("header.php");

$selectedId = $_GET["id"];

$query = "delete from  users where id = $selectedId";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Data deleted successfully!',
                    icon: 'danger',
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
?>





<?php include_once("footer.php") ?>