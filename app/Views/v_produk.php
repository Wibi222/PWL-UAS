<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php foreach (session()->getFlashData('errors') as $error): ?>
            <p><?= esc($error) ?></p>
        <?php endforeach; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Buttons -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>
<a type="button" class="btn btn-success" href="<?= base_url() ?>produk/download">
    Download Data
</a>

<!-- Table -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Foto</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($product as $index => $produk) : ?>
            <tr>
                <th scope="row"><?= $index + 1 ?></th>
                <td><?= esc($produk['nama']) ?></td>
                <td><?= esc($produk['harga']) ?></td>
                <td><?= esc($produk['jumlah']) ?></td>
                <td>
                    <?php if ($produk['foto'] != '' && file_exists("img/" . $produk['foto'])) : ?>
                        <img src="<?= base_url("img/" . $produk['foto']) ?>" width="100px">
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id'] ?>">
                        Ubah
                    </button>
                    <a href="<?= base_url('produk/delete/' . $produk['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
                        Hapus
                    </a>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('produk/edit/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= esc($produk['nama']) ?>" placeholder="Nama Barang" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga" class="form-control" id="harga" value="<?= esc($produk['harga']) ?>" placeholder="Harga Barang" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" name="jumlah" class="form-control" id="jumlah" value="<?= esc($produk['jumlah']) ?>" placeholder="Jumlah Barang" required>
                                </div>
                                <img src="<?= base_url("img/" . $produk['foto']) ?>" width="100px">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                                    <label class="form-check-label" for="check">
                                        Ceklis jika ingin mengganti foto
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Edit Modal -->
        <?php endforeach; ?>
    </tbody>
</table>
<!-- End Table -->

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang" value="<?= old('nama') ?>" required>
                        <?php if (isset($errors['nama'])): ?>
                            <div class="text-danger"><?= esc($errors['nama']) ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Barang" value="<?= old('harga') ?>" required>
                        <?php if (isset($errors['harga'])): ?>
                            <div class="text-danger"><?= esc($errors['harga']) ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Barang" value="<?= old('jumlah') ?>" required>
                        <?php if (isset($errors['jumlah'])): ?>
                            <div class="text-danger"><?= esc($errors['jumlah']) ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Modal -->

<?= $this->endSection() ?>
