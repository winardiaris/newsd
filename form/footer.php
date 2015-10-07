			</div>
				</div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
	<!-- jQuery -->
	<script src="static/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="static/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- Metis Menu Plugin JavaScript -->
	<script src="static/bower_components/metisMenu/dist/metisMenu.min.js"></script>
	<!-- Morris Charts JavaScript -->
	<script src="static/bower_components/raphael/raphael-min.js"></script>
	<script src="static/bower_components/morrisjs/morris.min.js"></script>
	<!-- Custom Theme JavaScript -->
	<script src="static/js/sb-admin-2.js"></script>
	<script src="static/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="static/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	<script src="static/js/bootstrap-datepicker.js"></script>
<script >
$(document).ready(function() {
		$('#media-table').DataTable({responsive: true});
		$('#media-table2').DataTable({responsive: true});
		$('#rss-table').DataTable({responsive: true});
		$('#priority-table').DataTable({responsive: true});
      
		$('#UbahXXX').change(function() {
			locations = $(location).attr('href');
			val = $(this).val();
			datanya = '&op=UbahXXX&data='+val;
			$.ajax({url: '<?php echo __BASE_URL__;?>action.php' ,data: datanya,cache: false,
				success: function(msg){
					$('#UbahXXX').val(msg)
				}
			});
		});
	$('.clear').focus(function() {
		$(this).val("");
	});
});
</script>
</body>
</html>
