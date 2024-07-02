<style>
    #table_paginate {
        float: right !important
    }

    #table_paginate ul {
        margin-top: 0px !important
    }

    .details-less {
        display: none
    }
</style>

<div class="portlet light">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-globe font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Hasil Rekomendasi Produk</span>
        </div>
    </div>
    <!-- <div style="overflow-x: scroll;" class=" d-flex w-100">
        <?php $id = 1;
        foreach ($resultt as $row) { ?>
            <div class="p-3" style="height: 200px;">
                <img src="cdn/images/<?= $row['produk'] ?>.jpg" width="135" />
                <figcaption><strong><?= str_replace('_', ' ', $row['produk']) ?></strong></figcaption>
                <div class="rating-box-2">
                    <div class="stars">
                        <?php
                        $i = 1;
                        if ($row['rating'] > 0) {
                            echo '<i class="bx bxs-star active" style="font-size:18px; gap: 0px;"></i>';
                        } else {
                            echo '<i class="bx bxs-star" style="font-size:18px"></i>';
                        }
                        $formattedRating = number_format($row['rating'], 1);
                        echo '<span style="margin-left: -15px;">' . $formattedRating . '</span>';
                        ?>
                    </div>
                </div>
            </div>
        <?php $id++;
        } ?>
    </div> -->
    <div class="portlet-body">
        <div class="table-container">
            <form role="form" id="frm_r">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered " id="table">
                    <thead>
                        <tr>
                            <th width="10%">Gambar</th>
                            <th width="80%">Informasi Produk</th>
                            <th width="10%">Pilih produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 1;
                        foreach ($result as $row) { ?>
                            <tr>
                                <td><img src="cdn/images/<?= $row['produk'] ?>.jpg" width="135" /></td>
                                <td><strong><?= str_replace('_', ' ', $row['produk']) ?></strong><br />
                                    <div class="rating-box-2">
                                        <div class="stars">
                                            <?php
                                            $i = 1;
                                            if (isset($row['rating']) && $row['rating'] > 0) {
                                                echo '<i class="bx bxs-star active" style="font-size:18px; gap: 0px;"></i>';
                                            } else {
                                                echo '<i class="bx bxs-star" style="font-size:18px"></i>';
                                            }
                                            if (isset($row['rating'])) {
                                                $formattedRating = number_format($row['rating'], 1);
                                                echo '<span style="margin-left: -15px;">' . $formattedRating . '</span>';
                                            }

                                            if (isset($row['jmlhuser'])) {
                                                echo 'Jumlah User: ' . $row['jmlhuser'];
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <p><?= $row['explain'] ?></p>
                                    <button type="button" onclick="show_details(<?= $id ?>)" class="show-details btn btn-info">Details <i class="fa fa-caret-right"></i></button>
                                    <div id="txt-<?= $id ?>" class="details-less row">
                                        <div class="col-md-6" style="margin-left:5%;"><br>
                                            <h3><strong>Spesifikasi</strong></h3>
                                            <br>
                                            <p><?= implode('<br>', $row['details']) ?></p>
                                        </div>
                                        <div class="col-md-4 float-end " style="text-align: center;margin: auto;">
                                            <h3><strong>Preview</strong></h3>
                                            <br>
                                            <img src="cdn/images/preview/<?= $row['produk'] ?>.jpg" width="90%" />

                                            <div class="rating-box-2">

                                                <div style="margin-left: 7%;margin-top:5%">
                                                    <p>Rating yang didapat</p>

                                                    <div class="stars">
                                                        <?php for ($i = 1; $i <= 5; $i++) {
                                                            if (isset($row['rating'])) {
                                                                if ($i <= $row['rating']) {
                                                                    echo '<i class="bx bxs-star active"></i>';
                                                                } elseif ($i - 0.5 <= $row['rating']) {
                                                                    echo '<i class="bx bxs-star-half active"></i>';
                                                                } else {
                                                                    echo '<i class="bx bxs-star"></i>';
                                                                }
                                                            }
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                </td>
                                <td><input type="checkbox" class="pilprod" name="product[]" value="<?= $row['produk'] ?>" />
                                </td>
                            </tr>
                        <?php $id++;
                        } ?>
                    </tbody>
                </table>
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-globe font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Hasil Semua Produk</span>
                    </div>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered " id="table">
                    <thead>
                        <tr>
                            <th width="10%">Gambar</th>
                            <th width="80%">Informasi Produk</th>
                            <th width="10%">Pilih produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $idd = 1;
                        if (isset($resultt) && is_array($resultt)) {
                            foreach ($resultt as $row) { ?>
                                <tr>
                                    <td><img src="cdn/images/<?= $row['produk'] ?>.jpg" width="135" /></td>
                                    <td><strong><?= str_replace('_', ' ', $row['produk']) ?></strong><br />
                                        <div class="rating-box-2">
                                            <div class="stars">
                                                <?php
                                                $i = 1;
                                                if (isset($row['rating']) && $row['rating'] > 0) {
                                                    echo '<i class="bx bxs-star active" style="font-size:18px; gap: 0px;"></i>';
                                                } else {
                                                    echo '<i class="bx bxs-star" style="font-size:18px"></i>';
                                                }
                                                if (isset($row['rating'])) {
                                                    $formattedRating = number_format($row['rating'], 1);
                                                    echo '<span style="margin-left: -15px;">' . $formattedRating . '</span>';
                                                }
                                                if (isset($row['jmlhuser'])) {
                                                    echo 'Jumlah User: ' . $row['jmlhuser'];
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <p><?= $row['explain'] ?></p>
                                        <button type="button" onclick="show_details(<?= $idd ?>)" class="show-details btn btn-info">Details <i class="fa fa-caret-right"></i></button>
                                        <div id="txt-<?= $idd ?>" class="details-less row">
                                            <div class="col-md-6" style="margin-left:5%;"><br>
                                                <h3><strong>Spesifikasi</strong></h3>
                                                <br>
                                                <p><?= implode('<br>', $row['details']) ?></p>
                                            </div>
                                            <div class="col-md-4 float-end " style="text-align: center;margin: auto;">
                                                <h3><strong>Preview</strong></h3>
                                                <br>
                                                <img src="cdn/images/preview/<?= $row['produk'] ?>.jpg" width="90%" />

                                                <div class="rating-box-2">

                                                    <div style="margin-left: 7%;margin-top:5%">
                                                        <p>Rating yang didapat</p>

                                                        <div class="stars">
                                                            <?php for ($i = 1; $i <= 5; $i++) {
                                                                if ($i <= $row['rating']) {
                                                                    echo '<i class="bx bxs-star active"></i>';
                                                                } elseif ($i - 0.5 <= $row['rating']) {
                                                                    echo '<i class="bx bxs-star-half active"></i>';
                                                                } else {
                                                                    echo '<i class="bx bxs-star"></i>';
                                                                }
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                    </td>
                                    <td><input type="checkbox" class="pilprod" name="product[]" value="<?= $row['produk'] ?>" />
                                    </td>
                                </tr>
                        <?php $idd++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="note note-bordered note-info" style="text-align:center">
            <h4>Pilih produk yang menurut anda sesuai.<br>Jika anda memilih satu produk, berarti anda sudah menemukan
                produk yang anda inginkan.<br>Anda boleh memilih lebih dari satu produk (jika ragu-ragu) atau tidak
                memilih satupun dari produk yang kami rekomendasikan. Kami akan membantu anda mengambil keputusan. Lalu
                klik next untuk melanjutkan</h4>
            <button type="button" onClick="r()" class="btn btn-info wrap12">Next &nbsp; &nbsp; <i class="fa fa-caret-right"></i></button>
        </div>
    </div>
</div>

<script language="javascript">
    // function r() {
    //     // Mendapatkan nilai dari checkbox yang dicentang
    //     var selectedProducts = [];
    //     $('input[name="product[]"]:checked').each(function() {
    //         selectedProducts.push($(this).val());
    //     });

    //     // Lakukan operasi atau tindakan dengan data yang telah dipilih
    //     console.log('Produk yang dipilih:', selectedProducts);
    //     // Lakukan apa pun yang diperlukan dengan data yang telah dipilih
    //     // Contohnya: Kirim data ke server, tampilkan di halaman lain, dll.
    // }
    var limit_viewed = <?= $this->config->item('limit_viewed') ?>;
</script>
</script>