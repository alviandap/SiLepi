<style>
#table_paginate { float:right !important }
#table_paginate ul { margin-top:0px !important }
.details-less { display:none }
</style>

<div class="portlet light">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-globe font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Buat Keputusan Anda disini</span>
        </div>
    </div>
    <div class="portlet-body">
    	<div class="note note-bordered note-info" style="text-align:center">
        	<h4>Kami mencoba memperlihatkan perbandingan dari produk-produk yang anda pilih, untuk membantu anda membuat keputusan.<br>
            Silahkan pilih salah satu produk yang menurut anda paling sesuai.</h4>
        </div>
        <div class="table-container">
        	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="table">
                <thead>
                    <tr>
                    <th width="15%">&nbsp;</th>
                	<?php $w = ceil(85 / count($result)); foreach($result as $name => $row) { ?>
                        <th width="<?= $w ?>%"><?= str_replace('_', ' ', $name) ?></th>
                    <?php } ?>
                    </tr>
                </thead>
                <tbody>
                	<tr>                    
                        <td>Fungsi yang didukung oleh produk</td>
                        <?php $status = true; foreach($result as $name => $row) { ?>
                            <td><ul style="padding-left:15px">
							<?php if(!empty($row['def'])) { $status = false; sort($row['def']); foreach($row['def'] as $fr) { ?>
                                <li><?= str_replace('_', ' ', $fr) ?></li>
                            <?php } } ?>
                            </ul></td>
                        <?php }?>
                    </tr>
                    <?php if($status) { ?>
                    <?php 
						$temp = array(); $co = 0; foreach($result as $name => $row)
						{ 
							if(!empty($row['dec'])) 
							{ 
								$ro = 0; 
								sort($row['dec']); 
								foreach($row['dec'] as $dec) 
								{
									$temp[$ro][$co] = $dec;
									$ro++;
								}
								$co++;
							}
						}
						
						$h = array();
						for($ii=0; $ii<count($temp); $ii++)
						{
							$au = array_unique($temp[$ii]);
							if(count($au) > 1) $h[$ii] = true; else $h[$ii] = false;
						}
						
					?>
                	<tr>                    
                        <td>Komponen</td>
                        <?php foreach($result as $name => $row) { ?>
                            <td><ul style="padding-left:15px">
							<?php if(!empty($row['dec'])) { sort($row['dec']); $aa = 0; foreach($row['dec'] as $c) { ?>
                                <li <?= (isset($h[$aa]) && $h[$aa]) ? 'style="background-color:#bacae7"' : '' ?>><?= str_replace('_', ' ', $c) ?></li>
                            <?php $aa++; } } ?>
                            </ul></td>
                        <?php }?>
                    </tr>
                	<tr>                    
                        <td>Tipe</td>
                        <?php foreach($result as $name => $row) { ?>
                            <td><?= !empty($row['det']) ? str_replace('_', ' ', $row['det'][0]) : '' ?></td>
                        <?php }?>   
                    </tr>
                    <tr>                    
                        <td>Harga</td>
                        <?php foreach ($result as $name => $row) { ?>
                            <td>
                                <?php
                                if (!empty($row['prc'])) {
                                    $price = $row['prc'][0];
                                    // Format the price using number_format
                                    $formattedPrice = 'Rp. ' . number_format($price, 0, ',', '.') . ',-';
                                    echo $formattedPrice;
                                } else {
                                    echo ''; // Handle the case when 'prc' is empty
                                }
                                ?>
                            </td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                	<tr>                    
                        <td>Pilih Produk</td>
                        <?php foreach($result as $name => $row) { ?>
                            <td><button type="button" class="btn btn-info" onclick="choose('<?= $name ?>')">Pilih Produk Ini</button></td>
                        <?php }?>
                    </tr>
                </tbody>
            </table>
    	</div>
    </div>
</div>

<script language="javascript">
var limit_viewed = <?= $this->config->item('limit_viewed') ?>;
</script>