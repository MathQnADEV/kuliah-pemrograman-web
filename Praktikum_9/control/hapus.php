 <?php
	require_once dirname(__DIR__) . '/config.php';
	include BASE_PATH . '/control/koneksi.php';

	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		$sql = "DELETE FROM dairy WHERE id=$id";
		if ($result = $kon->query($sql)) {
			header("Location: " . BASE_URL . "/index.php");
			exit();
		} else {
			die("Gagal menghapus catatan! {$result}");
		}
		
	} else {
		header("Location: " . BASE_URL . "/index.php");
		exit();
	}
