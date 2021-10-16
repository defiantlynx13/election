
<!-- BEGIN: Vendor JS-->
<script src="<?php echo $dash_assets_url.'vendors/js/vendors.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'fonts/LivIconsEvo/js/LivIconsEvo.defaults.js'?>"></script>
<script src="<?php echo $dash_assets_url.'fonts/LivIconsEvo/js/LivIconsEvo.min.js'?>"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo $dash_assets_url.'vendors/js/extensions/jquery.steps.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/forms/validation/jquery.validate.min.js'?>"></script>
<!---->
<script src="<?php echo $dash_assets_url.'vendors/js/tables/datatable/datatables.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/tables/datatable/dataTables.bootstrap4.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/tables/datatable/dataTables.buttons.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/tables/datatable/buttons.html5.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/tables/datatable/buttons.print.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/tables/datatable/buttons.bootstrap.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/tables/datatable/pdfmake.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/tables/datatable/vfs_fonts.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/extensions/toastr.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/extensions/sweetalert2.all.min.js'?>"></script>
<script src="<?php echo $dash_assets_url.'vendors/js/extensions/polyfill.min.js'?>"></script>
<!-- END: Page Vendor JS-->


<!-- BEGIN: Theme JS-->
<script src="<?php echo $dash_assets_url.'js/core/app-menu.js'?>"></script>
<script src="<?php echo $dash_assets_url.'js/core/app.js'?>"></script>
<script src="<?php echo $dash_assets_url.'js/scripts/components.js'?>"></script>
<script src="<?php echo $dash_assets_url.'js/scripts/footer.js'?>"></script>
<script src="<?php echo $dash_assets_url.'js/scripts/customizer.js'?>"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="<?php echo $dash_assets_url.'js/scripts/pages/dashboard-ecommerce.js'?>"></script>
<!-- END: Page JS-->

<script type="text/javascript">
    var myData=<?php echo json_encode(
        array(
            'ajax_url'=>admin_url('admin-ajax.php'),
            'panel_url'=>home_url('panel'),
            'user_id'=>get_current_user_id(),
            'dash_assets_url'=>trailingslashit( PLUGIN_NAME_URL ) . 'assets/dashboard/',
            'save_my_candidate_nonce'=>wp_create_nonce( 'save_my_candidate_nonce'),
        )
    );?>
</script>

<script src="<?php echo $dash_assets_url.'js/pages/panel.js'?>"></script>

<!-- END: Page JS-->
<!--<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M-1 908.5714285714286L-1 908.5714285714286C-1 908.5714285714286 49.2 908.5714285714286 49.2 908.5714285714286C49.2 908.5714285714286 98.4 908.5714285714286 98.4 908.5714285714286C98.4 908.5714285714286 147.6 908.5714285714286 147.6 908.5714285714286C147.6 908.5714285714286 196.8 908.5714285714286 196.8 908.5714285714286C196.8 908.5714285714286 246 908.5714285714286 246 908.5714285714286C246 908.5714285714286 295.2 908.5714285714286 295.2 908.5714285714286C295.2 908.5714285714286 344.40000000000003 908.5714285714286 344.40000000000003 908.5714285714286C344.40000000000003 908.5714285714286 393.6 908.5714285714286 393.6 908.5714285714286C393.6 908.5714285714286 442.8 908.5714285714286 442.8 908.5714285714286C442.8 908.5714285714286 492 908.5714285714286 492 908.5714285714286C492 908.5714285714286 492 908.5714285714286 492 908.5714285714286 "></path></svg>-->
</body>
<!-- END: Body-->
</html>
