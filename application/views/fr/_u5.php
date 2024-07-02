
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-globe font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Hasil Rekomendasi Produk</span>
        </div>
    </div>
    <div class="portlet-body form">
        <div style="text-align: center;">
         <img src="https://thumbs.dreamstime.com/b/problem-rubber-stamp-grunge-design-dust-scratches-effects-can-be-easily-removed-clean-crisp-look-color-easily-87996883.jpg" alt="LENSA PINTAR Logo" style="width: 50%; height: auto;">
    	</div>
         <!--<pre>
        < ?php print_r($result); ?>
        </pre>-->
        <div style="text-align: center;">
    	<h4>
        	Maaf tidak ada produk yang sesuai dengan kebutuhan anda. Pilihan yang dicentang merupakan kebutuhan yang menyebabkan tidak ditemukannya produk
</h4></div><br><br>
        <!--<ul>
        	<?php if((isset($result['pref']['price']['start']) && !empty($result['pref']['price']['start'])) && (isset($result['pref']['price']['end']) && !empty($result['pref']['price']['end']))) { ?>
        	<li>Budget = <?= $result['pref']['price']['start'].' - '.$result['pref']['price']['end'] ?></li>
            <?php } ?>
            <?php if(isset($result['pref']['brand']) && !empty($result['pref']['brand'])) { ?>
            <li>Merk = <?= implode(', ', $result['pref']['brand']) ?></li>
            <?php } ?>
            <?php if(isset($result['pref']['os']) && !empty($result['pref']['os'])) { ?>
            <li>Type = <?= implode(', ', $result['pref']['os']) ?></li>
            <?php } ?>
            <?php if(isset($result['pref']['type']) && !empty($result['pref']['type'])) { ?>
            <li>Type = <?= implode(', ', $result['pref']['type']) ?></li>
            <?php } ?>
            
			<?php if(isset($result['usermodel']) && !empty($result['usermodel'])) { foreach($result['usermodel'] as $f) { ?>                    
            <li>Kebutuhan <?= $f ?></li>
            <?php } } ?>
        </ul>-->
    	<h4>
        	Produk bisa didapatkan dengan menyesuaikan kebutuhan anda kembali :
        </h4>
        <form role="form" id="frm_fr" class="form-horizontal form-bordered form-row-stripped">
            <div class="form-body">
            	<?php if((isset($result['contra_pref']['price']['start']) && !empty($result['contra_pref']['price']['start'])) && (isset($result['contra_pref']['price']['end']) && !empty($result['contra_pref']['price']['end']))) { ?>
                <div class="form-group">
                    <h3 class="form-section mt-5" style="color: #069;">Silahkan pilih sesuai Budget anda</h3>
                    <label class="col-md-3 control-label">Budget</label>
                    <div class="col-md-9">
                    	<div class="col-md-5">
                        	<input type="text" name="inp[price][start]" class="form-control col-md-5 mask_currency" placeholder="Mulai Dari; tanpa tanda baca" value="<?= $result['pref']['price']['start'] ?>" />
                        </div>
                        <div class="col-md-1" style="margin-top:8px">Sampai</div>
                        <div class="col-md-5">
                        	<input type="text" name="inp[price][end]" class="form-control col-md-5 mask_currency" placeholder="Sampai Dengan; tanpa tanda baca" value="<?= $result['pref']['price']['end'] ?>" />
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <?php if(isset($result['contra_pref']['brand']) && !empty($result['contra_pref']['brand'])) { ?>
                <input type="hidden" name="inp[chk_pref][]" value="brand" />
                <h3 class="form-section mt-5">Silahkan pilih sesuai Merk anda</h3>
                <div class="form-group">
                    <label class="col-md-3 control-label">Merk</label>
                    <div class="col-md-9">
                        <div class="checkbox-list">
                        	<?php foreach($brand as $idb => $b) { ?>
                            <label class="checkbox-inline col-md-3 mb-5" style="margin-left: 0; padding: 0; text-align: center;">
                            <input type="checkbox" name="inp[brand][]" id="" value="<?= $b ?>" <?= in_array($b, $result['pref']['brand']) ? 'checked="checked"' : '' ?>> <img src="cdn/icons/<?= $idb ?>.svg" style="width: 100px; height: 100px; object-fit: contain;" alt="<?= $b ?>">
                            </label>
                            <?php } ?>
                            
							<!--< ?php foreach($result['pref']['brand'] as $b) { ?>
                            <label class="checkbox-inline">
                            <input type="checkbox" name="inp[brand][]" id="" value="< ?= $b ?>" checked="checked"> < ?= $b ?>
                            </label>
                            < ?php } ?>-->
                        </div>
                        <label class="col-md-3 control-label mb-5"></label>
                    <span class="help-block col-md-9">*Jangan dicentang jika ingin memilih semua Merk Laptop</span>
                    </div>
                </div>
                <?php } ?> 
                
                <?php if(isset($result['contra_pref']['os']) && !empty($result['contra_pref']['os'])) { ?>
                <input type="hidden" name="inp[chk_pref][]" value="os" />
                <div class="form-group">
                    <label class="col-md-3 control-label">Sistem Operasi</label>
                    <div class="col-md-9">
                        <div class="row" style="padding:0px 15px">
                            <div class="checkbox-list">
                                <?php foreach($os as $ido => $o) { ?>
                                <label class="checkbox-inline col-md-4" style="margin-left:0px; padding-left:0px">
                                <input type="checkbox" name="inp[os][]" id="" value="<?= $o ?>" <?= in_array($o, $result['pref']['os']) ? 'checked="checked"' : '' ?>> <img src="cdn/icons/<?= $ido ?>.jpg" height="25" alt="<?= $o ?>">
                                </label>
                                <?php } ?>
                                
                                
                                <!--< ?php foreach($result['pref']['os'] as $b) { ?>
                                <label class="checkbox-inline">
                                <input type="checkbox" name="inp[os][]" id="" value="< ?= $b ?>" checked="checked"> < ?= $b ?>
                                </label>
                                < ?php } ?>-->
                            </div>
                    	</div>
                        <div class="row" style="padding:0px 15px">
                        	<span class="help-block">Jangan dicentang jika ingin memilih semua sistem operasi</span>
                        </div>
                    </div>
                </div>
                <?php } ?>                 
                
                <?php if(isset($result['contra_pref']['type']) && !empty($result['contra_pref']['type'])) { ?>
                <input type="hidden" name="inp[chk_pref][]" value="type" />
                <div class="form-group">
                    <h3 class="form-section mt-5">Silahkan pilih sesuai kebutuhan anda</h3>
                    <label class="col-md-3 control-label">Jenis</label>
                    <div class="col-md-9">
                        <div class="checkbox-list">
                        	<?php foreach($type as $id => $name) { ?>
                            <label class="checkbox-inline col-md-3 mb-5" style="margin-left: 0; padding: 0; text-align: center;">
                            <input type="checkbox" name="inp[type][]" id="" value="<?= $id ?>" <?= in_array($id, $result['pref']['type']) ? 'checked="checked"' : '' ?>> <img src="cdn/icons/<?= $id ?>.png" height="100" alt="<?= $name ?>"><br><?= $name ?>
                            </label>
                            <?php } ?>
                          
                            <!--< ?php foreach($$result['pref']['type'] as $t) { ?>
                            <label class="checkbox-inline">
                            <input type="checkbox" name="inp[type][]" id="" value="< ?= $t ?>" checked="checked"> < ?= $t ?>
                            </label>
                            < ?php } ?>-->
                        </div>
                          <label class="col-md-3 control-label mb-5"></label>
                    <span class="help-block col-md-9">*Jangan dicentang jika ingin memilih semua jenis Laptop</span>
                    </div>
                </div>
                <?php } ?>
                
                <?php if(isset($result['contra_usermodel']) && !empty($result['contra_usermodel'])) { ?> 
                    <h3 class="form-section mt-5">Silahkan pilih satu atau lebih pilihan dibawah ini sesuai kebutuhan anda</h3>
                   <?php foreach($result['contra_usermodel'] as $f) { ?>                                      
                <div class="form-group">
                    <label for="inputEmail1"  class="col-md-3 control-label" style="display: flex; flex-direction: column; align-items: left;"> <?= str_replace('_', ' ', $f) ?></label>
                    <div class="col-md-9">
                        <div class="radio-list">
                        	<label class="rradio-inline col-md-3 m-3" style="margin-left: 0; padding: 0; text-align: center;">
                                <input type="radio" name="inp[usermodel][<?= $f ?>]" value="fh" checked="checked"> 
                                Wajib Dipenuhi
                            </label>
                        	<label class="radio-inline col-md-3 m-3" style="margin-left: 0; padding: 0; text-align: center;">
                                <input type="radio" name="inp[usermodel][<?= $f ?>]" value="fs"> 
                                Lebih baik dipenuhi
                            </label>
                        	<label class="rradio-inline col-md-3 m-3" style="margin-left: 0; padding: 0; text-align: center;">
                                <input type="radio" name="inp[usermodel][<?= $f ?>]" value="fx"> 
                                Tidak Diperlukan
                            </label>
                        </div>
                    </div>
                </div>
            	<?php } } ?>
            </div>
            <div class="form-actions" style="text-align: right;">
                <button type="button" onclick="recommend_u5()" class="btn purple">Rekomendasikan &nbsp; <i class="fa fa-long-arrow-right"></i></button>
            </div>
        </form>
    </div>
</div>

<script language="javascript">
var limit_viewed = <?= $this->config->item('limit_viewed') ?>;
</script>