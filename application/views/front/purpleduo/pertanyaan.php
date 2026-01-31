<div class="container-fluid">
    <div class="row p-2">
        <div class="col-12 col-lg-6 left-cont"><img src="<?php echo base_url('stat/purpleduo/preview/images/title_head_xs.png') ?>" class="logo_main"></div>
        <div class="col-12 col-lg-6 right-cont"><img src="<?php echo base_url('stat/purpleduo/preview/images/logo_pd.png') ?>" class="logo_pd_main"></div>
    </div>
</div>
<div class="container p-4 t-black">
        <!---Form starting----> 
        <div class="row">
            <div class="frame-quis element_glow" style="min-height: auto;">
                <div  class=" col-12 mb-4">
                    <?php echo $pertanyaan['pertanyaan']; ?>
                </div>
                <form action="<?php echo base_url('kirim-pertanyaan/'.$halaman) ?>" role="form" method="post" >
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
	                <div class="col-12">
                        <div class="row">
                            <div class="col-16 col-lg-6">
                                <label class="radiocontainer" id="label1"> <?php echo $pertanyaan['jawaban1']; ?><input type="radio" name="quiz" onclick="pilihJawaban('jawaban1')" value="<?php echo $pertanyaan['jawaban1']; ?>|<?php echo $pertanyaan['parents1']; ?>" required><span class="checkmark"></span></label>
                            </div>
                            <div class="col-16 col-lg-6">
                                <label class="radiocontainer" id="label1"> <?php echo $pertanyaan['jawaban2']; ?><input type="radio" name="quiz" onclick="pilihJawaban('jawaban2')" value="<?php echo $pertanyaan['jawaban2']; ?>|<?php echo $pertanyaan['parents2']; ?>" required><span class="checkmark"></span></label>
                            </div>
                            <div class="col-16 col-lg-6">
                                <label class="radiocontainer" id="label1"> <?php echo $pertanyaan['jawaban3']; ?><input type="radio" name="quiz" onclick="pilihJawaban('jawaban3')" value="<?php echo $pertanyaan['jawaban3']; ?>|<?php echo $pertanyaan['parents3']; ?>" required><span class="checkmark"></span></label>
                            </div>
                            <div class="col-16 col-lg-6">
                                <label class="radiocontainer" id="label1"> <?php echo $pertanyaan['jawaban4']; ?><input type="radio" name="quiz" onclick="pilihJawaban('jawaban4')"  value="<?php echo $pertanyaan['jawaban4']; ?>|<?php echo $pertanyaan['parents4']; ?>"  required><span class="checkmark"></span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div  class=" col-12 mt-4 mb-4 sub-pertanyaan" style="display:none">                        
                        <?php echo $pertanyaan['sub_pertanyaan']; ?>
                    </div>
                    <div class="col-12 sub-pertanyaan" style="display:none">
                        <div class="row bg-purple">
                            <?php foreach($pertanyaan_lanjutan as $row){ ?>
                                <div class="col-16 col-lg-6 <?php echo $row['type']; ?> items-jawaban">
                                    <label class="radiocontainer" id="label1"> <?php echo $row['jawaban1']; ?> <input type="radio" name="sub_quiz" value="1|<?php echo $row['jawaban1']; ?>" required><span class="checkmark"></span></label>
                                </div>
                                <div class="col-16 col-lg-6 <?php echo $row['type']; ?> items-jawaban">
                                    <label class="radiocontainer" id="label1"> <?php echo $row['jawaban2']; ?><input type="radio" name="sub_quiz" value="0|<?php echo $row['jawaban2']; ?>"  required><span class="checkmark"></span></label>
                                </div>
                            <?php } ?>                           
                        </div>
                    </div>
                    <div class="col-sm-12 text-center btn-frame">
                    <input type="submit" class="btn btn-warning" value="Submit">
                    </div> 
                </form> 
            </div>
        </div>	 
    </div>            
            
    </div>
    


<footer id="main-footer" style="">
</footer>
