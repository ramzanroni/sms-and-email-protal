
<div class="row mt-3" id="content1">
	
</div>

<script type="text/javascript">
	$( document ).ready(function() {
		//alert("page loaded");
		loadDashboard();
		setInterval(loadDashboard, 3000);
		function loadDashboard() {
			$.ajax({
				url: "./reports/dashboard-data.php",
				success: function (result) {
					//console.log(result);
					$("#content1").html(result);
				}
			});
		}
	});
</script>