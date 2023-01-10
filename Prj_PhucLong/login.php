<?php
//Khai báo sử dụng session
session_start();
 
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
 
//Xử lý đăng nhập
if (isset($_POST['dangnhap'])) 
{
    //Kết nối tới database
    include('./database/db.php');
     
    //Lấy dữ liệu nhập vào
    $username = addslashes($_POST['txtUsername']);
    $password = addslashes($_POST['txtPassword']);
     
    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$username || !$password) {
        echo '<script>  alert("Vui Lòng Nhập Tên Đăng Nhập Hoặc Mật Khẩu");
        window.location.href="login.php";   
        </script>';
        
        exit;
    }
     
    // mã hóa pasword
    $password = md5($password);
     
    //Kiểm tra tên đăng nhập có tồn tại không
    $query = $connect->query("SELECT username, password FROM member WHERE username='$username'");
    if (mysqli_num_rows($query) == 0) {
        echo '<script>  alert("Tên Đăng Nhập Không Đúng");
        window.location.href="login.php";    
        </script>';
        
        exit;
    }
     
    //Lấy mật khẩu trong database ra
    $row = mysqli_fetch_array($query);
     
    //So sánh 2 mật khẩu có trùng khớp hay không
    if ($password != $row['password']) {
        echo '<script>  alert("Nhập Sai Mật Khẩu Vui Lòng Nhập lại"); 
        window.location.href="login.php";   
        </script>';
          
        exit;
    }
     
    //Lưu tên đăng nhập
    $_SESSION['username'] = $username;
    if ($username == "admin")
        echo '<script>  alert("Bạn đã đăng nhập thành công. "); 
        window.location.href="./dssp.php";   
        </script>';
    else
        echo '<script>  alert("Bạn đã đăng nhập thành công. Không Có Quyền Lực admin nên sẽ quay về trang chủ "); 
        window.location.href="trangChu.html";   
        </script>';
         
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>PhucLong.vn</title>
    <link rel="stylesheet" href="css/dangnhap.css">
    <script src="https://kit.fontawesome.com/b8ab9ce7ed.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <header class="sticky">
        <div class="delivery">
            <img src="images\delivery.png" alt="" class="anh">
        </div>
        <div class="giuaTren">
            <div class="Logo">
            <a href="trangchu.html"><img src="images\logo_PhucLong.png" alt="" class="Anhlogo">
            </div>
        </div>
        <div class="phaiTren">
            <span><a href="login.php" class="DangNhap">Đăng nhập</a></span>
            <span class="VNhEN">VN|EN</span>
            <span><button onclick="window.location.href='./taoTK.html'"  class="btnGioHang">Đăng ký <p class=shopinglogo><i class="fa-solid fa-user"></i></p></button></i></p></button></span>
        </div>
    </div>
    </header>
    <div class="tong">
        <div class="Login">
            <div>
                <img src="images/coc-giay-in-logo-1.jpg" alt="" class="imglogin">
            </div>

            <div class="DangNhap2">
                <!-- php/logincheck.php -->
                <form action='login.php?do=login' method='POST'>
                    <div class="imgLogin">
                        <img src="images/logo_PhucLong2.png" alt="" >
                    </div>
                    <div class="container">
                        
                      <input type="text" placeholder="Nhập Tên Tài Khoản" name="txtUsername" >
                      <input type="password" placeholder="Nhập Password" name="txtPassword" >
                          
                      <button class="BtSubmit" type="submit"  name="dangnhap">Login</button>
                      <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                      </label>
                    </div>
            </div>
        </div>
        <div class="bottom">
            <div class="bottrai">
                <b>Trụ sở chính</b>
                : Công ty Cổ Phần Phúc Long Heritage - ĐKKD: 0316 871719
                do sở KHĐT TPHCM cấp lần đầu ngày 21/05/2021
                <br>
                <b>Nhà máy</b>
                : D_8D_CN Đường XE 1, Khu Công Nghiệp Mỹ Phước III, phường Mỹ Phước, thị xã Bến Cát, tỉnh Bình Dương, Việt Nam
                <br>
                <b>Địa chỉ</b>
                : 42/24 - 42/26 Đường 643 Tạ Quang Bửu, phường 4, quận 8, Hồ Chí Minh
                <b>Điện thoại</b>
                : 028 6263 0377 - 6263 0378 
                <br>
                <b>Fax</b>
                : (028) 6263 0379 
                <br>
                <b>Email</b>
                sales@phuclong.masangroup.com
            </div>
            <div class="botgiua">
                <b>Đăng ký nhận tin khuyến mãi</b>
                <br>
                <div class="email">
                    <input type="email"class="form-control"placeholder="Nhập địa chỉ email">
                    <button class="btn3">GỬI</button>
                </div>
                <br>
                <span>Chính sách đặt hàng</span>
                <br>
                <span>Chính sách bảo mật thông tin</span>
            </div>
            <div class="botphai">
                <span style="color:green ;">VN</span><span> | EN</span>
                <br>
                <img  class="thongbao"src="https://phuclong.com.vn/images/common/dathongbao.png" alt="">
                <br>
                <div class="f-social">
                    <a class="btn-icon" href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <a class="btn-icon" href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <a class="btn-icon" href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <a class="btn-icon" href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>

    </div>
        
</body>
</html>
