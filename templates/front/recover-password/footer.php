<!-- Plugin scripts -->
<script src="<?php echo $dash_assets_url.'vendors/bundle.js'?>"></script>

<!-- App scripts -->
<script src="<?php echo $dash_assets_url.'assets/js/app.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/validator/validator.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/validator/lang/fa.min.js'?>"></script>
<script type="text/javascript">
    var myData=<?php echo json_encode(
        array(
            'ajax_url'=>admin_url('admin-ajax.php')
        )
    );?>
</script>
<script src="<?php echo $dash_assets_url.'assets/js/auth.js'?>"></script>
</body>

</html>