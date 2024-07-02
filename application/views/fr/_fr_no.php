<div class="portlet light">
    <div class="portlet-title">
        <!-- <div class="caption caption-md">
            <i class="icon-globe font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Form Pertanyaan</span>
        </div> -->
        <div style="text-align: center;">
         <img src="https://thumbs.dreamstime.com/b/oops-illustration-sorry-business-man-vector-95283972.jpg" alt="LENSA PINTAR Logo" style="width: 30%; height: auto;">
    	</div>
        <div class="note note-bordered note-danger" style="text-align:center">
                    <h4>Maaf, sampai saat ini produk yang sesuai dengan kebutuhan anda masih terlalu banyak, sehingga kami akan menanyakan kembali dari awal, barangkali anda akan merubah kebutuhan anda.</h4>
                </div>
    </div>    
    <div class="portlet-body form">         
        <form role="form" id="frm_fr" class="form-horizontal form-bordered form-row-stripped">
            <div class="form-body">
                
            	<h3 class="form-section">Silahkan pilih satu atau lebih pilihan dibawah ini sesuai kebutuhan anda</h3>
                <?php $reset = $this->session->userdata('reset'); if($reset) { $this->session->set_userdata(array('reset' => false)); ?>
                <!-- dipindah atas textnya -->
                <?php } ?>
                <?php foreach($fr as $f) { ?>                    
                <div class="form-group">
				    <?php $this->load->driver('crs'); $com = $this->crs->ontology->get_fr_comment($f); if(isset($com[0])) $c = $com[0]; else $c = ''; ?>
                    <label for="inputEmail1" class="col-md-3 control-label">
                         <div class="m-3" style="display: flex; flex-direction: column; align-items: left;"> <?= str_replace('_', ' ', $f) ?></div></label>
                    <div class="col-md-9">
                        <div class="radio-list">
                        	<label class="radio-inline col-md-3 m-3" style="margin-left: 0; padding: 0; text-align: center;">
                                <input type="radio" name="inp[usermodel][<?= $f ?>]" value="fh" checked="checked"> 
                                Wajib Dipenuhi
                            </label>
                        	<label class="radio-inline col-md-3 m-3" style="margin-left: 0; padding: 0; text-align: center;">
                                <input type="radio" name="inp[usermodel][<?= $f ?>]" value="fs"> 
                                Lebih baik dipenuhi
                            </label>
                        	<label class="radio-inline col-md-3 m-3" style="margin-left: 0; padding: 0; text-align: center;">
                                <input type="radio" name="inp[usermodel][<?= $f ?>]" value="fx"> 
                                Tidak Diperlukan
                            </label>
                        </div>
                    </div>
                </div>
            	<?php } ?>
            </div>
            <div class="form-actions" style="text-align: right;">
                <button type="button" onclick="<?= $function ?>()" class="btn purple" >Rekomendasikan &nbsp; <i class="fa fa-long-arrow-right"></i></button>
            </div>
        </form>
    </div>
</div>