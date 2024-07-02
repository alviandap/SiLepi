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
                    <label class="col-md-3 control-label">Screen Technology</label>
                    <div class="col-md-9 controls">
                    	<?= form_dropdown('inp[screen_technology]', $screen_technology, '', 'id="screen_technology" class="form-control span12"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Screen Resolution</label>
                    <div class="col-md-9 controls">
                    	<?= form_dropdown('inp[screen_resolution]', $screen_resolution, '', 'id="screen_resolution" class="form-control span12"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Processor</label>
                    <div class="col-md-9 controls">
                    	<?= form_dropdown('inp[processor]', $processor, '', 'id="processor" class="form-control span12"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">RAM</label>
                    <div class="col-md-9 controls">
                    	<?= form_dropdown('inp[ram]', $ram, '', 'id="ram" class="form-control span12"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Primary Camera</label>
                    <div class="col-md-9 controls">
                    	<?= form_dropdown('inp[primary_camera]', $primary_camera, '', 'id="primary_camera" class="form-control span12"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Secondary Camera</label>
                    <div class="col-md-9 controls">
                    	<?= form_dropdown('inp[secondary_camera]', $secondary_camera, '', 'id="secondary_camera" class="form-control span12"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Internal Memmory</label>
                    <div class="col-md-9 controls">
                    	<?= form_dropdown('inp[internal_memmory]', $internal_memmory, '', 'id="internal_memmory" class="form-control span12"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Video Record</label>
                    <div class="col-md-9 controls">
                    	<?= form_dropdown('inp[video_record]', $video_record, '', 'id="video_record" class="form-control span12"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Screen Size</label>
                    <div class="col-md-9 controls">
                    	<?= form_dropdown('inp[screen_size]', $screen_size, '', 'id="screen_size" class="form-control span12"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Battery Capacity</label>
                    <div class="col-md-9">
                    	<?= form_dropdown('inp[battery_capacity]', $battery_capacity, '', 'id="battery_capacity" class="form-control span12"'); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="button" onclick="recommend_sr()" class="btn purple">Rekomendasikan &nbsp; <i class="fa fa-long-arrow-right"></i></button>
            </div>
        </form>
    </div>
</div>