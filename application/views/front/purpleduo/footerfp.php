<script src="<?php echo base_url('assets/front/js/jquery.js') ?>"></script>
<script>
    function pilihJawaban(jawaban) {
        // Sembunyikan semua elemen jawaban
        $('.sub-pertanyaan').show();
        $('.items-jawaban').hide();

        // Tampilkan elemen berdasarkan pilihan jawaban
        $('.'+jawaban).show('slow');
    }
</script>
<script src="<?php echo base_url() ?>stat/purpleduo/preview/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>stat/purpleduo/preview/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>stat/purpleduo/preview/js/jquery-confirm.min.js"></script>
<script src="<?php echo base_url() ?>stat/purpleduo/preview/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>stat/purpleduo/preview/js/jquery.cookie.js"></script>

</body>
</html>