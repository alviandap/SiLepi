<style>
#table_paginate { float:right !important }
#table_paginate ul { margin-top:0px !important }
.details-less { display:none }
</style>
<?php //print_r($result); ?>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-globe font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Hasil Rekomendasi Produk</span>
        </div>
    </div>
    <div class="portlet-body">
    	<div class="note note-bordered note-danger" style="text-align:center">
            <h4>Selamat anda telah menemukan produk yang anda cari</h4>
        </div>
        <div class="table-container">
        	<form role="form" id="frm_r">
        	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="table">
                <thead>
                    <tr>
                        <th width="10%">Gambar</th>
                        <th width="80%">Deskripsi Produk</th>
                    </tr>
                </thead>
                <tbody>
                	<?php $id = 1; foreach($result as $row) { ?>
                	<tr>
                        <td><img src="cdn/images/<?= $row['produk'] ?>.jpg" width="135" /></td>
                        <td><strong><?= str_replace('_', ' ', $row['produk']) ?></strong><br />
							<p><?= $row['explain'] ?></p>
                            <button type="button" onclick="show_details(<?= $id ?>)" class="show-details btn btn-xs red">Details <i class="fa fa-caret-right"></i></button>
                            <p id="txt-<?= $id ?>" class="details-less"><?= implode('<br>', $row['detail']) ?></p></td>
                    </tr>
                    <?php  $id++; }?>
                </tbody>
            </table>
            <div>
                <a href="https://forms.gle/gzftweDoqRuE61aK7" target="_blank">Silahkan isi form ini terlebih dahulu</a>
            </div>
            </form>
    	</div>
    </div>
</div>

<script language="javascript">
var limit_viewed = <?= $this->config->item('limit_viewed') ?>;
</script>

