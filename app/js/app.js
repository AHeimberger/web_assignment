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

	$("body").on("click", ".toggle", function(){
		data_index = $(this).attr("data_index");
		toggleData(data_index);
	});


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
		$('#loading').show();

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
		$.get({
			url : "rest/routing_table.php",
			data : { mode: "reset" },
			success : function(){
				loadData();
			}
		});
	}

	function deleteData(index){
		$(".delete").css("opacity", "0.5");
		$(".delete").attr("disabled", true);

		$.post({
			url : "rest/routing_table.php",
			data : { mode: "delete", index: data_index },

			success : function(){
				loadData();
			}
		});
	}

	function toggleData(index){
		$(".toggle").css("opacity", "0.5");
		$(".toggle").attr("disabled", true);

		$.get({
			url : "rest/routing_table.php",
			data : { mode: "toggle", index: data_index },
			success : function(){
				loadData();
			}
		});
	}
})