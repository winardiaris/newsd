			</div>

				</div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<script >
$(document).ready(function() {
     $('#media-table').DataTable({
                responsive: true
      });
     $('#media-table2').DataTable({
                responsive: true
      });
     $('#rss-table').DataTable({
                responsive: true
      });
     $('#priority-table').DataTable({
                responsive: true
      });
      
      
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
