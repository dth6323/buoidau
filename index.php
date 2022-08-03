<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h1>
		Đây là trang chủ
	</h1>
	<?php 
	require'conect.php';

	$trang = 1;
	if(isset($_GET['trang']))
		$trang = $_GET['trang'];
	$tim_kiem = '';
	if(isset($_GET['tim_kiem']))
		$tim_kiem = $_GET['tim_kiem'];
	$sql_tong_bai = "select count(*) from tin_tuc where tieu_de like '%$tim_kiem%'";
	$mang_tong_bai = mysqli_query($ket_noi,$sql_tong_bai);
	$kq_tong_bai = mysqli_fetch_array($mang_tong_bai);
	$tong_bai = $kq_tong_bai['count(*)'];
	$so_bai_tren_mot_trang = 2;
	$so_trang = ceil($tong_bai/$so_bai_tren_mot_trang);
	$bo_qua = $so_bai_tren_mot_trang*($trang-1);


	$sql = "select * from tin_tuc where tieu_de like '%$tim_kiem%'
	limit $so_bai_tren_mot_trang
	offset $bo_qua";
	$ket_qua = mysqli_query($ket_noi,$sql);
	?>
	<a href="form_proces.php">
		Thêm bài viết
	</a>
	<table border="1" width="100%">
		<caption>
			<form>
				<input type="search" name="tim_kiem" value="<?php echo $tim_kiem ?>">
			</form>
		</caption>
		<tr>
			<th>Mã</th>
			<th>Tiêu đề</th>
			<th>Ảnh</th>
		</tr>
		<?php foreach ($ket_qua as $tung_bai_tin_tuc){ ?>
			<tr>
				<td><?php echo $tung_bai_tin_tuc['ma'] ?></td>
				<td>
					<a href="show.php?ma=<?php echo $tung_bai_tin_tuc['ma'] ?>">
						<?php echo $tung_bai_tin_tuc['tieu_de'] ?>	
					</a>
				</td>
				<td>
					<img src="<?php echo $tung_bai_tin_tuc['anh'] ?>" height='100'>
				</td>
				<td>
					<a href="update.php?ma=<?php echo $tung_bai_tin_tuc['ma'] ?>">
						sửa
					</a>
				</td>
				<td>
					<a href="delete.php?ma=<?php echo $tung_bai_tin_tuc['ma'] ?>">
						xoá
					</a>
				</td>
			</tr>
		<?php } ?>
	</table>
	<?php for ($i=1; $i <= $so_trang ; $i++){ ?>
		<a href="?trang=<?php echo $i ?>&tim_kiem=<?php echo $tim_kiem?>">
			<?php echo $i ?>
		</a>
	<?php } ?>

</body>
</html>