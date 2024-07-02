<style>
#table_paginate { float:right !important }
#table_paginate ul { margin-top:0px !important }
.details-less { display:none }
</style>

<div class="portlet light">
    <div class="portlet-title">
        <!-- <div class="caption caption-md">
            <i class="icon-globe font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Hasil Rekomendasi Produk</span>
        </div> -->
        <div style="text-align: center;">
         <img src="https://media.istockphoto.com/vectors/congratulations-lettering-vector-id1078043842?k=6&m=1078043842&s=612x612&w=0&h=fcKGD3LvBd9Zz8j1UlzBeV_gMVRwrczhfQUjOZWh4dw=" alt="LENSA PINTAR Logo" style="width: 30%; height: auto;">
    	</div>
    </div>
    <div class="portlet-body">
    	      <div class="note" style="text-align:center">
            <h3>Selamat anda telah menemukan produk yang anda cari</h3>
        </div>
        <div class="table-container">
        	<form role="form" id="frm_r">
        	<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered " id="table">
                <thead>
                    <tr>
                          <th width="15%">Gambar</th>
                        <th width="85%">Informasi Produk</th>
                    </tr>
                </thead>
                <tbody>
                	<?php $id = 1; foreach($result as $row) { ?>
                	<tr>
                        <td><img src="cdn/images/<?= $row['produk'] ?>.jpg" width="135" /></td>
                        <td><strong><?= str_replace('_', ' ', $row['produk']) ?></strong><br />
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
                                        <div class="rating-box-2" > 
                                                                        <div style="margin-left: 7%;margin-top:5%">
                                        <p>Rating dari pengunjung lain.</p>
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
                            
                            <div></td>
                        </td>
                    </tr>
                    <?php  $id++; }?>
                </tbody>
            </table>
            <div>
                <div class="rating-box" id="give-rating">
                    <h1>Rate Laptop ini?</h1>
                    <p>Rating anda bermanfaat bagi pengunjung lain.</p>
                    <div class="stars">
                    <i class="rtg bx bxs-star"></i>
                    <i class="rtg bx bxs-star"></i>
                    <i class="rtg bx bxs-star"></i>
                    <i class="rtg bx bxs-star"></i>
                    <i class="rtg bx bxs-star"></i>
                    </div>
                    <div class="yloading" id="loading-img">
                        <div class="loader-container">
                            <div class="circle"></div>
                            <div class="circle1"></div>
                            <div style="text-align:center; color:#fff">Sedang Dalam Proses</div>
                        </div>
                    </div>
                    <button type="button" onclick="giveRating()" class="show-details btn btn-info mt-5">Submit <i class="fa fa-paper-plane"></i></button>
                </div>
                <div class="rating-box" id="has-rated">
                    <h1>Kamu sudah memberikan rating</h1>
                </div>
                <script>
                    const stars = document.querySelectorAll('.stars .rtg');
                    var ratingValue = 0;
                    <?php 
                        if($result[0]['is_rated']){
                            echo "$('#give-rating').hide();";
                            echo "$('#has-rated').show();";
                        } else {
                            echo "$('#give-rating').show();";
                            echo "$('#has-rated').hide();";
                        }
                    ?>
                    for (let i = 0; i < stars.length; i++) {
                        stars[i].addEventListener('click', function () {
                            ratingValue = i + 1;
                            sessionStorage.setItem('rating', ratingValue);
                            stars.forEach((star, index) => {
                                if (index < ratingValue) {
                                    star.classList.add('active');
                                } else {
                                    star.classList.remove('active');
                                }
                            });
                        });
                    }

                    function giveRating(product_id) {
                        if (ratingValue == 0) {
                            alert('Anda belum memberikan rating');
                        } else {
                            $.ajax({
                                url:'fr/give_rating',
                                global:false,
                                async:false,
                                type:'POST',
                                data: {product: '<?= $result[0]['produk'] ?>', rating: ratingValue},
                                success: function(e) {
                                    $('#give-rating').hide();
                                    $('#has-rated').show();
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                },
                                beforeSend : function() {
                                    $('#loading-img').show();
                                },
                                complete : function() {
                                    $('#loading-img').hide();
                                }
                            });	
                        }
                        
                    }
                </script>
                <!-- <a href="https://forms.gle/CrCvdzoPLsfMcFVX9" target="_blank">Silahkan isi form ini terlebih dahulu click here</a> -->
            </div>
            </form>
    	</div>
  
    </div>
</div>

