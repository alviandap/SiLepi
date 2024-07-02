<div class="col-md-12" style="background:url(assets/global/img/background.jpg); opacity:0.7; height:500px;">
    <div class="note note-bordered note-danger" style="text-align:center">
        <h4>Ini adalah aplikasi recommender system yang akan membantu anda mendapatkan sepeda berdasarkan kebutuhan anda, dengan mekanisme percakapan</h4>
        <h4>Anda cukup memasukkan kebutuhan fungsional dari produk yang anda inginkan.<br></h4><br />
        <h4>Isi terlebih dahulu informasi user berikut</h4>
        <form role="form" id="inf" class="form-horizontal form-bordered form-row-stripped">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Nama</label>
                    <div class="col-md-9">
                       	<input type="text" name="inp[u_name]" class="form-control col-md-12" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Usia</label>
                    <div class="col-md-9">
                       	<input type="text" name="inp[u_old]" class="form-control col-md-12" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Familiar terhadap fitur teknis sepeda :</label>
                    <div class="col-md-9">
                       	<div class="radio-list" style="text-align:left">
                        	<label class="radio-inline">
                                <input type="radio" name="inp[u_kategori]" value="Y" checked="checked"> 
                                Ya
                            </label>
                        	<label class="radio-inline">
                                <input type="radio" name="inp[u_kategori]" value="S"> 
                                Agak / Sedang
                            </label>
                        	<label class="radio-inline">
                                <input type="radio" name="inp[u_kategori]" value="T"> 
                                Tidak
                            </label>
                    	</div>
                    </div>
                </div>
        	</div>
            <div class="form-actions">
            	<button type="button" onClick="start()" class="btn red wrap12">Start &nbsp; &nbsp; <i class="fa fa-caret-right"></i></button>
        	</div>   
        </form>       
    </div>
</div>