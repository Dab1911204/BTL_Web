<?php   
    include 'connect.php';
    $keysearch = $_POST['key'];
    $records_per_page = $_POST['page'];
    $current_page = $_POST['current_page'];
    $start= ($current_page - 1) * $records_per_page;
    if($keysearch=="")
    {
        $query= "select * from tintuc LIMIT $start, $records_per_page";
    }
    else{
        // tìm kiếm theo tên nhà cung cấp, nếu muốn tmf kiếm theo địa chỉ cần thêm " or diaChi like '%E$keysearch%'" vào trước limit
        $query= "select * from tintuc where tieuDe like '%$keysearch%' LIMIT $start, $records_per_page";
    }
    $html='';
    $result= mysqli_query($conn, $query);
    $num = 1;
    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while ($row = mysqli_fetch_assoc($result))
        {

            $html.= '<div class="list">
                        <div class="list-left">
                            <img src="/Demo/imgchung/'. $row['anhTinTuc'].' " alt="">
                            <div class="list-info">
                                <h4>'. $row['tieuDe'].'</h4>
                                <span class="list-category">'. $row['ngayThang'].' </span>
                            </div>
                        </div>
                        <div class="list-right">
                            <div class="list-control">
                                <div class="list-tool">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Xem thêm</button>
                                    <a href="edit_news.php?matintuc='. $row['maTintuc'].'" class="btn btn-success" style="margin: 0px 10px;"><i class="far fa-edit"></i></a>
                                    <a onclick="return confirm(\'Bạn có chắc chắn muốn xóa tin tức này không?\');" href="delete_news.php?matintuc='. $row['maTintuc'].'" class="btn-delete" style="border-radius: 4px;"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Scrollable modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="blog-post outer-top-bd wow fadeInUp">
                                        <a href=""><img class="img-responsive" src="/Demo/imgchung/'. $row['anhTinTuc'].'" width=900px height=500px alt=""></a>
                                        <h1><a href="">'. $row['tieuDe'].'</a></h1>
                                        <p>'. $row['noiDung'].'</p>
                                        <span class="datetime">'. $row['ngayThang'].'</span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
    };
    echo $html;
?>