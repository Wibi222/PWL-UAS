<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<hr>
<div class="table-responsive">
    <a type="button" class="btn btn-success" href="<?= base_url() ?>download">
        Download Data
    </a>
    <!-- Table with stripped rows -->
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Alamat</th>
                <th scope="col">Ongkir</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($buy)):
                foreach ($buy as $index => $item):
                    ?>
                    <tr>
                        <th scope="row"><?php echo $index + 1 ?></th>
                        <td><?php echo $item['username'] ?></td>
                        <td><?php echo number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?php echo $item['alamat'] ?></td>
                        <td><?php echo $item['ongkir'] ?></td>
                        <td><?php echo ($item['status'] == "1") ? "1" : "0" ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-id="<?= $item['id'] ?>" data-bs-toggle="modal"
                                data-bs-target="#statusModal-<?= $item['id'] ?>">
                                Ubah Status
                            </button>
                        </td>
                    </tr>
                    <!-- Status Modal Begin -->
                    <div class="modal fade" id="statusModal-<?= $item['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('changeStatus') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status">
                                                <option value="1" <?= $item['status'] == '1' ? 'selected' : '' ?>>1</option>
                                                <option value="0" <?= $item['status'] == '0' ? 'selected' : '' ?>>0</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Status Modal End -->
                    <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->
</div>
<?= $this->endSection() ?>