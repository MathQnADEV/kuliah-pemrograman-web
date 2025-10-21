<?php
require_once __DIR__ . '/config.php';
include BASE_PATH . '/control/koneksi.php';
include BASE_PATH . '/layout/header.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$result = $kon->query("SELECT * FROM dairy WHERE id=$id");
	$row = $result->fetch_assoc();
}
?>

<form method="post" action="<?= BASE_URL ?>/control/simpan.php">
	<input type="hidden" name="id" value="<?= $row['id']; ?>">
	<div class="flex flex-col justify-center items-center">
		<p class="text-4xl font-bold">Edit Catatan Baru</p>

		<fieldset class="fieldset w-full">
			<legend class="fieldset-legend text-xl">Judul</legend>
			<input type="text" class="input input-lg" value="<?= htmlspecialchars($row['judul']); ?>" name="judul" />
		</fieldset>

		<fieldset class="fieldset w-full">
			<legend class="fieldset-legend text-xl">Isi</legend>
			<textarea class="textarea textarea-lg w-full" name="content">
<?= htmlspecialchars($row['content']); ?></textarea>
		</fieldset>
	</div>

	<div class="mt-4 flex justify-end items-center gap-4">
		<button class="btn btn-success" name="save">Kirim</button>
		<button class="btn btn-error">
			Cancel
		</button>
	</div>
</form>


<?php include BASE_PATH . '/layout/footer.php'; ?>