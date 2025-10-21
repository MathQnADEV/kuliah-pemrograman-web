<?php
require_once __DIR__ . '/config.php';
include BASE_PATH . '/control/koneksi.php';
include BASE_PATH . '/layout/header.php';
?>


<form method="post" action="<?= BASE_URL ?>/control/simpan.php">
	<div class="flex flex-col justify-center items-center">
		<p class="text-4xl font-bold">Tambah Catatan Baru</p>

		<fieldset class="fieldset w-full">
			<legend class="fieldset-legend text-xl">Judul</legend>
			<input type="text" class="input input-lg" placeholder="Tulis Judul Diary Kamu" name="judul" />
		</fieldset>

		<fieldset class="fieldset w-full">
			<legend class="fieldset-legend text-xl">Isi</legend>
			<textarea class="textarea textarea-lg w-full" placeholder="Tulis Isi Diary Kamu" name="content"></textarea>
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