$(function(){
			$(".efb").click(function(){
				var idd=$(this).attr('id');
				$(".abc").hide();
				var data="form"+idd;
				$("#"+data).css('display','block');
			});
		});