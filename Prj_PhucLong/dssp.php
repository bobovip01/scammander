<link rel="stylesheet" href="SanPhamThem.css">
<?php
    include './database/db.php';
    if(isset($_POST["added"])) {
        if (isset($_FILES["img"])) {
            $file_name = $_FILES['img']['name'];
            $file_tmp =$_FILES['img']['tmp_name'];
            move_uploaded_file($file_tmp,"./dataPic/{$_POST['id']}.png");

            $sql = "INSERT INTO nuocitem (id,Tenitem,GiaThanh,SoLuong) VALUES ({$_POST['id']},'{$_POST['Tenitem']}',{$_POST['GiaThanh']},{$_POST['SoLuong']})";
            if ($connect->query($sql) === TRUE) {
                $alert = "Thêm sản phẩm thành công";
                $alert_type = "success";
            }
        }
    }

    if(isset($_POST["edited"])) {
        $sql = "UPDATE nuocitem SET Tenitem='{$_POST['Tenitem']}',GiaThanh={$_POST['GiaThanh']},SoLuong={$_POST['SoLuong']} WHERE id={$_POST['edited']}";
        if ($connect->query($sql) === TRUE) {
            $alert = "Sửa sản phẩm thành công";
            $alert_type = "success";
        }
    }

    if(isset($_POST["delete"])) {
        unlink("./dataPic/{$_POST['delete']}.png");
        $sql = "DELETE FROM nuocitem WHERE id={$_POST["delete"]}";
        if ($connect->query($sql) === TRUE) {
            $alert = "Xoá sản phẩm thành công";
            $alert_type = "success";
        }
    }
?>
<div class="khung">
<form class="main-box" method="POST" enctype="multipart/form-data">
    <div class="main-title">
    
        Tìm kiếm sản phẩm
    </div>
    <div class="search-box">
        <input class="search-input" name="search">
        <button class="search-btn" name="search-submit">
            <img class="search-icon" src="/images/searchicon.svg">
        </button>
    </div>
    <div class="main-content">
        <div class="main-table">
            <div class="table-hd">Ảnh
                   
            </div>
            <div class="table-hd">Mã Nước.....   
                <input class="table-input-id" name="id">
            </div>
            
            <div class="table-hd">Tên Sản Phẩm
                <input class="table-input-tsp" name="Tenitem">
            </div>
            <div class="table-hd">Giá Thành
                <input class="table-input-gia" name="GiaThanh">
            </div>
            <div class="table-hd">Số Lượng
                <input class="table-input-sl" name="SoLuong">
            </div>
           <div class="tbl">
            <div class="table-hd">Thao tác
            <?php
                if(isset($_POST["add"])):
            ?>
                <div class="table-them">
                    <input  name="img" type="file" id="img" style="display:none;" accept="image/*">
                    <label for="img" class="table-btn">Ấn vào Chữ để Up Ảnh</label>
                    <div class="table-i">
                    <button class="table-btn" name="added">Thêm</button></div>
                    
                </div>
            </div>
                    </div>
                </div>
                
                <div class="table-i">
                    
                </div>
                <div class="table-i">
                    
                </div>
                <div class="table-i">
                    
                </div>
                <div class="table-i">
                    
                </div>
                
            <?php else: ?>
                <button class="table-add" name="add">
                    <img class="table-add-icon" <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Thêm sản phẩm
                </button>
            <?php endif ?>
            <div class="main-title">
    
                        Toàn Bộ Sản Phẩm
                </div>
            <?php
                $search_sql = (isset($_POST["search-submit"]) && $_POST["search"] !== "") ? " WHERE Tenitem LIKE '%{$_POST["search"]}%'" : "";
                $result = $connect->query("SELECT * FROM nuocitem {$search_sql}");
                if (mysqli_num_rows($result) > 0):
                    while($row = $result->fetch_assoc()):
                        if(isset($_POST["edit"]) && $_POST["edit"] == $row["id"]):
            ?>
            
                <div class="table-i">
                    <img class="table-img" src="./dataPic/<?=$row["id"]?>.png">
                    
                </div>
            
                <div class="table-i"><?=$row["id"]?></div>
                <div class="table-i">
                    <input class="table-input" name="Tenitem" value="<?=$row["Tenitem"]?>">
                </div>
                <div class="table-i">
                    <input class="table-input" name="GiaThanh" value="<?=$row["GiaThanh"]?>">
                </div>
                <div class="table-i">
                    <input class="table-input" name="SoLuong" value="<?=$row["SoLuong"]?>">
                </div>
                <div class="table-i">
                    <button class="table-btn" name="edited" value=<?=$row["id"]?>>Sửa</button>
                </div>
            <?php else: ?>
              
                <div class="bot">
                
                <div class="mini">
                
                <div class="table-i">
                 <img class="table-img" src="./dataPic/<?=$row["id"]?>.png">  
                </div>
                <div class="table-i"><?=$row["Tenitem"]?></div>
                <div class="table-i"><?=$row["GiaThanh"]?></div>
                <div class="table-i"><?=$row["SoLuong"]?></div>
                 <div class="table-i">
                 <button class="icon-box" name="edit" value="<?=$row["id"]?>">
                        <img src="/images/edit-2.png" class="table-icon">
                    </button>
                     <button class="icon-box" name="delete" value="<?=$row["id"]?>">
                        <img src="/images/trash.svg" class="table-icon">
                    </button>
                    </ul>
                    </div>
                    </div>
            <?php endif; endwhile; endif; ?>
            </div>
        </div>
    </div>
    </div>
</form>