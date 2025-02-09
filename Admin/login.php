<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets1/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    include "connect.php";
    if (isset($_POST['login'])) {
        $tenTaiKhoan = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM taikhoan WHERE tenTaiKhoan = '$tenTaiKhoan' AND Mat_khau = '$password'";
        $result = mysqLi_query($conn, $sql);
        if (mysqLi_num_rows($result) == 1) {
            $row = mysqLi_fetch_array($result);
            $_SESSION["taikhoan"] = $row['tenTaiKhoan'];
            header("location:trangchu.php");
        } else {
            echo "<script>alert('Tài khoản hoặc mật khẩu không đúng!')</script>";
        }
    }

    ?>
    <div class="form-group">
        <div class="icon">
            <i class="fa-solid fa-circle-user"></i>
        </div>
        <form action="login.php" method="post">
            <input class="input-field" type="text" placeholder="Tên đăng nhập" name="username" required>
            <input class="input-field" type="password" placeholder="Mật khẩu" name="password" required>
            <input type="submit" value="Đăng nhập" name="login">
        </form>
    </div>
</body>

</html>