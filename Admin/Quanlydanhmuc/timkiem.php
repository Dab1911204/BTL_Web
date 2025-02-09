<?php   
    include 'ketnoi.php';
    function showCategories($danhmuc, $parent_id = -1, $char = '')
    {
        foreach ($danhmuc as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['danhMucCha'] == $parent_id)
            {            
                ?>
                    <tr>
                        <td><?php echo $item['maDanhMuc']; ?></td>
                        <td><?php echo $char.$item['tenDanhMuc']; ?></td>
                        <td><?php echo getTenDanhMuc($item["danhMucCha"]) ?></td>
                        <td><?php echo $item['duongDan']; ?></td>
                        <td> <a href="suadanhmuc.php?id=<?php echo $item['maDanhMuc'];?>" class="btn btn-info">Sửa</a>
                            <a onclick="return confirm('Bạn có muốn xóa danh muc này không');"
                                href="xoadanhmuc.php?id=<?php echo $item['maDanhMuc'];?>" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                    <?php                
                // Xóa chuyên mục đã lặp
                unset($danhmuc[$key]); 
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($danhmuc, $item['maDanhMuc'], $char.'|____');
            }
        }
    }
    function getTenDanhMuc($id){
        $tendanhmuccha = '';
        if($id != -1)
        {
            $q1 = "select tenDanhMuc from danhmuc where maDanhMuc = '".$id."'";
            $result1 = mysqli_query(mysqli_connect("localhost","root","","btl_web"),$q1);
            if(mysqli_num_rows($result1)>0)
            {
                $tendanhmuccha = mysqli_fetch_assoc($result1)['tenDanhMuc'];                
            }
        }
        return $tendanhmuccha;
    }
    $keysearch = $_POST['key'];
    if($keysearch=="")
    {
        $query= "select * from danhmuc";
    }
    else{
        // tìm kiếm theo danh mục, nếu muốn tmf kiếm theo đdanh mục cha " or danhMucCha like '%$keysearch%'" vào trước limit
        $query= "select * from danhmuc where tenDanhMuc like '%$keysearch%'";
    }
    $html='';
    $result= mysqli_query($conn, $query);
    $num = 1;
    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        
        if($keysearch == ''){
            $danhmuc = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $danhmuc [] = $row;
            }
            showCategories($danhmuc);

        }else{
            while ($row = mysqli_fetch_assoc($result))
            {
                $html.= '<tr>
                            <td>'.$row["maDanhMuc"].'</td>
                            <td>'. $row['tenDanhMuc'].'</td>
                            <td>'.$row['danhMucCha'].'</td>
                            <td>'. $row['duongDan'].'</td>
                            <td> <a href="suadanhmuc.php?id='. $row['maDanhMuc'].'" class="btn btn-info">Sửa</a>
                                <a onclick="return confirm(\'Bạn có muốn danh mục này không\');"
                                    href="xoadanhmuc.php?id='. $row['maDanhMuc'].'"
                                    class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>';
            }
        }
    };
    echo $html;
?>