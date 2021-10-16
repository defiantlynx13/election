
<!-- BEGIN: Vendor JS-->
<script src="<?php echo $dash_assets_url.'vendors/js/vendors.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'fonts/LivIconsEvo/js/LivIconsEvo.defaults.js'?>"></script>
<script src="<?php echo $dash_assets_url.'fonts/LivIconsEvo/js/LivIconsEvo.min.js'?>"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo $dash_assets_url.'vendors/js/extensions/toastr.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/ui/plyr.min.js'?>"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?php echo $dash_assets_url.'js/scripts/configs/vertical-menu-light.js'?>"></script>
<script src="<?php echo $dash_assets_url.'js/core/app-menu.js'?>"></script>
<script src="<?php echo $dash_assets_url.'js/core/app.js'?>"></script>
<script src="<?php echo $dash_assets_url.'js/scripts/components.js'?>"></script>
<script src="<?php echo $dash_assets_url.'js/scripts/footer.js'?>"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="<?php echo $dash_assets_url2.'vendors/validator/validator.min.js'?>"></script>
<script src="<?php echo $dash_assets_url2.'vendors/validator/lang/fa.min.js'?>"></script>

<script type="text/javascript">
    var myData=<?php echo json_encode(
        array(
            'ajax_url'=>admin_url('admin-ajax.php'),
            'auth_nonce'=>wp_create_nonce( 'auth_nonce' ),
            'confirm_code_nonce'=>wp_create_nonce( 'confirm_code_nonce' ),
            'panel_nonce_login'=>wp_create_nonce( 'panel_nonce_login'),
        )
    );?>
</script>


<script src="<?php echo $dash_assets_url.'js/pages/auth.js'?>"></script>

<!-- END: Page JS-->

</body>
<!-- END: Body-->
</html>