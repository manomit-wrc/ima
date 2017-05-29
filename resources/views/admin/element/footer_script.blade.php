<script type="text/javascript">
	$(document).ready(function(e){
		$("#inputAvators").change(function(e){
			
			if (this.files && this.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('.profile-user-img').attr('src', e.target.result);
		            $('.header-image').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(this.files[0]);
    		}
		});

		$('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });
	});
</script>
