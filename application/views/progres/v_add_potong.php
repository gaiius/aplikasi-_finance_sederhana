				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>


    <link rel="stylesheet" href="<?=$base_url?>public/css/jquery.ui.all.css">
	<script src="<?=$base_url?>public/js_plugin/jquery-1.9.1.js"></script>
	<script src="<?=$base_url?>public/js_plugin/ui/jquery.ui.core.js"></script>
	<script src="<?=$base_url?>public/js_plugin/ui/jquery.ui.widget.js"></script>
	<script src="<?=$base_url?>public/js_plugin/ui/jquery.ui.position.js"></script>
	<script src="<?=$base_url?>public/js_plugin/ui/jquery.ui.menu.js"></script>
	<script src="<?=$base_url?>public/js_plugin/ui/jquery.ui.autocomplete.js"></script>
	<link rel="stylesheet" href="<?=$base_url?>public/css/demo.css">
    <link rel="stylesheet" href="<?=$base_url?>public/css/jquery.ui.autocomplete.css">
    <link rel="stylesheet" href="<?=$base_url?>public/css/jquery.ui.menu.css">
    
    
		<script>
	$(function() {
		var availableTags = [
		<?php   
	    $noUrut=0;
		$qpelanggan=mysql_query("SELECT kode FROM po_out");
		while ($b=mysql_fetch_array($qpelanggan)){	
	      $noUrut++;
     ?>
			"<?php echo $b['kode'];?>",
			<?php } ?>
		];
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( "#tags" )
			// don't navigate away from the field on tab when selecting an item
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "ui-autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				minLength: 0,
				source: function( request, response ) {
					// delegate back to autocomplete, but extract the last term
					response( $.ui.autocomplete.filter(
						availableTags, extractLast( request.term ) ) );
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
				}
			});
	});
	</script>

	
	<input id="tags" size="50">


	
							
        <!-- Bootstrap -->
        <script src="<?=$base_url?>public/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?=$base_url?>public/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?=$base_url?>public/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?=$base_url?>public/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?=$base_url?>public/js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
  
       
	