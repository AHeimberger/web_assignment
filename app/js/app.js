$(document).ready(function(){
	loadData();

	$("[name='reset']").click(function(){
		mode = "reset";
		var temp = confirm("Are you sure?");
		if(!temp) {
			return false;
		} else{
			resetData();
		}
	})

	$("body").on("click", ".delete", function(){
		data_index = $(this).attr("data_index");
		var temp = confirm("Are you sure?");
		if(!temp) {
			return false;
		} else{
			deleteData(data_index);
		}
	});

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

	function resetData() {
		$('#loading').show();

		$.get({
			url : "rest/routing_table.php",
			data : { mode: "reset" },
			success : function(){
				loadData();
			},
			complete : function(){
				$('#loading').hide();
			}
		});
	}

	function deleteData(index){
		$('#loading').show();

		$.get({
			url : "rest/routing_table.php",
			data : { mode: "delete", index: data_index },
			success : function(){
				loadData();
			},
			complete : function(){
				$('#loading').hide();
			}
		});
	}
})