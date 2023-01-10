<?php
    if(isset($_POST["login"]))
        header("Location: login.php");
    // Nếu không phải là sự kiện đăng ký thì không xử lý
    if (!isset($_POST['txtUsername'])){
        die('');
    }
     
    //Nhúng file kết nối với database
    include './database/db.php';
          
    //Khai báo utf-8 để hiển thị được tiếng việt
    header('Content-Type: text/html; charset=UTF-8');
          
    //Lấy dữ liệu từ file taoTK.php
    $username   = addslashes($_POST['txtUsername']);
    $password   = addslashes($_POST['txtPassword']);
    $email      = addslashes($_POST['txtEmail']);
    $fullname   = addslashes($_POST['txtFullname']);
    $birthday   = addslashes($_POST['txtBirthday']);
          
    //Kiểm tra người dùng đã nhập liệu đầy đủ chưa
    if (!$username || !$password || !$email || !$fullname || !$birthday )
    {
        echo '<script>  alert("Vui lòng nhập đầy đủ thông tin.");
        window.location.href="taoTK.html";   
        </script>';
        exit;
    }
          
        // Mã khóa mật khẩu
        $password = md5($password);
          
    //Kiểm tra tên đăng nhập này đã có người dùng chưa
    if (mysqli_num_rows($connect->query("SELECT username FROM member WHERE username='$username'")) > 0){
        echo '<script>  alert("Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác.");
        window.location.href="taoTK.html";   
        </script>';
        exit;
    }
          
    //Kiểm tra email có đúng định dạng hay không
    if (!mb_eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email))
    {
        echo '<script>  alert("Email này không hợp lệ. Vui long nhập email khác.");
        window.location.href="taoTK.html";   
        </script>';
        exit;
    }
          
    //Kiểm tra email đã có người dùng chưa
    if (mysqli_num_rows($connect->query("SELECT email FROM member WHERE email='$email'")) > 0)
    {
        echo '<script>  alert("Email này đã có người dùng. Vui lòng chọn Email khác.");
        window.location.href="taoTK.html";     
        </script>';
        exit;
    }
    //Kiểm tra dạng nhập vào của ngày sinh
    if (!mb_eregi("^[0-9]+/[0-9]+/[0-9]{2,4}", $birthday))
    {
        echo '<script>  alert("Ngày tháng năm sinh không hợp lệ. Vui long nhập lại.");
        window.location.href="taoTK.html";     
        </script>';
        exit;
    }
          
    //Lưu thông tin thành viên vào bảng
    @$addmember = $connect->query("
        INSERT INTO member (
            username,
            password,
            email,
            fullname,
            birthday
        )
        VALUE (
            '{$username}',
            '{$password}',
            '{$email}',
            '{$fullname}',
            '{$birthday}'
        )
    ");
                          
    //Thông báo quá trình lưu

    if ($addmember)
        echo '<script>  alert("Quá trình đăng ký thành công.");
        window.location.href="login.php";   
        </script>';    
    else
        echo '<script>  alert("Có lỗi xảy ra trong quá trình đăng ký.");
        window.location.href="taoTK.html";     
        </script>';
        
?>