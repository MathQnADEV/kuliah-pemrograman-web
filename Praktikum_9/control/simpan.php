 <?php
	require_once dirname(__DIR__) . '/config.php';
	include BASE_PATH . '/control/koneksi.php';

	if (isset($_POST['save'])) {
		$id = $_POST['id'];
		$title = $_POST['judul'];
		$content = $_POST['content'];

		$title = mysqli_real_escape_string($kon, $title);
		$content = mysqli_real_escape_string($kon, $content);

		$id ? $sql = "UPDATE dairy SET judul='$title', content='$content' WHERE id=$id" : $sql = "INSERT INTO dairy (judul, content) VALUES ('$title', '$content')";

		if ($result = $kon->query($sql)) {
			header("Location: " . BASE_URL . "/index.php");
			exit();
		} else {
			die("Gagal menyimpan catatan! {$result}");
		}
	}else{
		header("Location: " . BASE_URL . "/index.php");
		exit();
	}
