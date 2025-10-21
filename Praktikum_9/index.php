<?php
require_once __DIR__ . '/config.php';
include BASE_PATH . '/control/koneksi.php';
include BASE_PATH . '/layout/header.php';
?>

<div class="flex flex-col items-center my-4">
	<p class="text-2xl font-bold my-4">Selamat datang di Simple Diary</p>
	<a href="tambah.php">
		<button class="btn btn-neutral">
			Tambah
		</button>
	</a>
</div>


<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th>Judul</th>
				<th>Isi</th>
				<th>Tanggal</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$result = $kon->query("SELECT * FROM dairy ORDER BY created_at DESC");
			$id = 1;
			while ($row = $result->fetch_assoc()):
			?>
				<tr>
					<td><?= $id++; ?></td>
					<td><?= htmlspecialchars($row['judul']); ?></td>
					<td><?= nl2br(htmlspecialchars($row['content'])); ?></td>
					<td><?= $row['created_at']; ?></td>
					<td>
						<a href="edit.php?id=<?= $row['id']; ?>">
							<button class="btn btn-warning">
								Edit
							</button>
						</a>
						<button class="btn btn-error" onclick="my_modal_<?= $row['id']; ?>.showModal()">Delete</button>
						<dialog id="my_modal_<?= $row['id']; ?>" class="modal">
							<div class="modal-box">
								<h3 class="text-xl font-bold">Hapus Diary</h3>
								<p class="py-4 text-lg">Yakin ingin menghapus diary dengan judul "<?= htmlspecialchars($row['judul']); ?>"?</p>
								<div class="modal-action">
									<form method="dialog">
										<input type="hidden" name="id" value="<?= $row['id']; ?>">
										<button class="btn btn-error" formmethod="post" formaction="<?= BASE_URL ?>/control/hapus.php" name="delete">Delete</button>
										<button class="btn btn-neutral">Close</button>
									</form>
								</div>
							</div>
						</dialog>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>


<?php include BASE_PATH . '/layout/footer.php'; ?>