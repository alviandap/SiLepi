<div class="portlet light">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-globe font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Form Pertanyaan</span>
        </div>
    </div>

    <div class="portlet-body form">
        <form role="form" id="frm_fr" class="form-horizontal form-bordered form-row-stripped">
            <div class="form-body">
            	<h3 class="form-section">Silahkan pilih sesuai kebutuhan anda</h3>
                <div class="form-group">
                    <label class="col-md-3 control-label">Budget</label>
                    <div class="col-md-9">
                    	<div class="col-md-5">
                        	<input type="text" name="inp2[price][start]" class="form-control col-md-5 mask_currency" value="<?= $_POST['inp2']['price']['start'] ?>"/>
                        </div>
                        <div class="col-md-1" style="margin-top:8px">Sampai</div>
                        <div class="col-md-5">
                        	<input type="text" name="inp2[price][end]" class="form-control col-md-5 mask_currency" value="<?= $_POST['inp2']['price']['end'] ?>"/>
                        </div>
                        <span class="help-block">Kosongkan pilihan budget jika tidak mempunyai budget khusus</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Merk</label>
                    <div class="col-md-9">
                        <div class="checkbox-list">
                        	<?php foreach($brand as $b) { ?>
                            <label class="checkbox-inline col-md-3" style="margin-left:0px; padding-left:0px">
                            <input type="checkbox" name="inp2[brand][]" id="" value="<?= $b ?>" <?= array_key_exists('brand', $_POST['inp2']) && in_array($b, $_POST['inp2']['brand']) ? 'checked="checked"' : '' ?>> <img src="cdn/icons/<?= $b ?>.png" height="75" alt="<?= str_replace('_', ' ', $b) ?>">
                            </label>
                            <?php } ?>
                            <span class="help-block">Jangan dicentang jika ingin memilih semua merk</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Sistem Operasi</label>
                    <div class="col-md-9">
                        <div class="checkbox-list">
                        	<?php foreach($os as $ido => $o) { ?>
                            <label class="checkbox-inline col-md-4" style="margin-left:0px; padding-left:0px">
                            <input type="checkbox" name="inp2[os][]" id="" value="<?= $ido ?>" <?= array_key_exists('os', $_POST['inp2']) && in_array($ido, $_POST['inp2']['os']) ? 'checked="checked"' : '' ?>> <img src="cdn/icons/<?= $ido ?>.jpg" height="25" alt="<?= $o ?>">
                            </label>
                            <?php } ?>
                            <span class="help-block">Jangan dicentang jika ingin memilih semua sistem operasi</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Jenis</label>
                    <div class="col-md-9">
                        <div class="checkbox-list">
                        	<?php foreach($type as $id => $name) { ?>
                            <label class="checkbox-inline col-md-6" style="margin-left:0px; padding-left:0px">
                            <input type="checkbox" name="inp2[type][]" id="" value="<?= $id ?>" <?= array_key_exists('type', $_POST['inp2']) && in_array($id, $_POST['inp2']['type']) ? 'checked="checked"' : '' ?>> <img src="cdn/icons/<?= $id ?>.png" height="40"> &nbsp; <?= $name ?>
                            </label>
                            <?php } ?>
                            <span class="help-block">Jangan dicentang jika ingin memilih semua jenis sepeda</span>
                        </div>
                    </div>
                </div>
            	<h3 class="form-section">Silahkan pilih satu atau lebih pilihan dibawah ini sesuai kebutuhan anda</h3>
                <div class="form-group">
                    <label class="col-md-3 control-label">Screen Technology</label>
                    <div class="col-md-9 controls">
						<?= $this->mainapi->chkbox2('inp[screen_technology]', $screen_technology, '', 'id="screen_technology" class="form-control span12"', $_POST['inp'], 'screen_technology'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Screen Resolution</label>
                    <div class="col-md-9 controls">
                    	<?= $this->mainapi->chkbox2('inp[screen_resolution]', $screen_resolution, '', 'id="screen_resolution" class="form-control span12"', $_POST['inp'], 'screen_resolution'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Processor</label>
                    <div class="col-md-9 controls">
                    	<?= $this->mainapi->chkbox2('inp[processor]', $processor, '', 'id="processor" class="form-control span12"', $_POST['inp'], 'processor'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">RAM</label>
                    <div class="col-md-9 controls">
                    	<?= $this->mainapi->chkbox2('inp[ram]', $ram, '', 'id="ram" class="form-control span12"', $_POST['inp'] ,'ram'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Primary Camera</label>
                    <div class="col-md-9 controls">
                    	<?= $this->mainapi->chkbox2('inp[primary_camera]', $primary_camera, '', 'id="primary_camera" class="form-control span12"', $_POST['inp'], 'primary_camera'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Secondary Camera</label>
                    <div class="col-md-9 controls">
                    	<?= $this->mainapi->chkbox2('inp[secondary_camera]', $secondary_camera, '', 'id="secondary_camera" class="form-control span12"', $_POST['inp'], 'secondary_camera'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Internal Memmory</label>
                    <div class="col-md-9 controls">
                    	<?= $this->mainapi->chkbox2('inp[internal_memmory]', $internal_memmory, '', 'id="internal_memmory" class="form-control span12"', $_POST['inp'], 'internal_memmory'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Video Record</label>
                    <div class="col-md-9 controls">
                    	<?= $this->mainapi->chkbox2('inp[video_record]', $video_record, '', 'id="video_record" class="form-control span12"', $_POST['inp'], 'video_record'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Screen Size</label>
                    <div class="col-md-9 controls">
                    	<?= $this->mainapi->chkbox2('inp[screen_size]', $screen_size, '', 'id="screen_size" class="form-control span12"', $_POST['inp'], 'screen_size'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Battery Capacity</label>
                    <div class="col-md-9">
                    	<?= $this->mainapi->chkbox2('inp[battery_capacity]', $battery_capacity, '', 'id="battery_capacity" class="form-control span12"', $_POST['inp'], 'battery_capacity'); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="button" onclick="recommend_sr()" class="btn purple">Rekomendasikan &nbsp; <i class="fa fa-long-arrow-right"></i></button>
            </div>
        </form>
    </div>
</div>

