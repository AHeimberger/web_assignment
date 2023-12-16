$(document).ready(function(){
	loadData();

	function loadData(){
		$.get({
			url : "rest/routing_table.php",
			data : { mode: 'load' },
			success : function(data){
				$("body table tbody").html(data);
			},
			error : function(data) {
				$("body table tbody").html("<tr><td colspan=\"6\">Error Loading Data...</td></tr>");
			},
			complete : function(){
				$('#loading').hide();
			}
		});
	};
})