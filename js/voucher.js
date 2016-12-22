var currentSelected = -1;
$(function() {
	$("#dropdown_input").focus(function() {
		if($(".dropdown").length==0) {
			$("#dropdown_input").after("<ul class='dropdown'></ul>");
		}
		$.ajax({
			type:"POST",
			url:"voucher_sql.php",
			dataType:"json",
			success:function(resp) {
				for(var i=0; i<resp.length; i++) {
					$(".dropdown").append("<li value='"+resp[i].id+"'>"+resp[i].product+"</li>");
				}
				currentSelected = -1;
				action();
			}
		});
	});
	
	$("#dropdown_input").val("");
	$("#dropdown_input").keyup(function(e){
		if($(".dropdown").length==0) {
			$("#dropdown_input").after("<ul class='dropdown'></ul>");
		}
			var kc = e.keyCode==0 ? e.which : e.keyCode;
			if(kc==38 || kc==40 || kc==13) return;
			
			var val = $(this).val();
			//console.log(val);
			$(".dropdown").html("");
			$.ajax({
				type:"POST",
				url:"voucher_sql.php",
				data:{val:val},
				dataType:"json",
				success:function(resp) {
					for(var i=0; i<resp.length; i++) {
						$(".dropdown").append("<li value='"+resp[i].id+"'>"+resp[i].product+"</li>");
					}
					currentSelected = -1;
					action();
				}
			});	
			//if(val.length==0) $(".dropdown").remove();
		
	});
	
	$(document).unbind('keydown').bind('keydown',function(e) {
		scroller(e);
	}).click(function(e){
		 if(!$(e.target).hasClass("input_field")) {
			$(".dropdown").remove(); 
		 }
	});
	
	
		function scroller(e) {
			var key = e.keyCode || e.which;
			var len = $(".dropdown").find('li').length-1;
			
			if($(".dropdown").length != 0)
			{
				if(key==38 || key==40) {
					if(key==38) {
						if(currentSelected>0) currentSelected--;	
					} else {
						if(currentSelected<len) currentSelected++;
					}
					$(".dropdown").find('li').each(function(i) {
						if(currentSelected==i) {
							$(this).addClass('dropdownItemSelected');
						} else {
							$(this).removeClass('dropdownItemSelected');
						}
					});
				}
				
				else if(key==13) {
					$(".dropdown").find('li').each(function(i){
						if(currentSelected==i) {
							$(".dropdown li").removeClass('dropdownItemSelected');
							
							$("#dropdown_input").val($(this).text());
							$(".dropdown").remove();
							myCustomMethod($(this).attr("value"));
						}
					});
					e.preventDefault();
				}
				
			}
		}
		
		function action() {
			$(".dropdown").find('li').each(function(i) {
				//var cls = $(this).attr('class');
				console.log("test");
				$(this).mouseover(function() {
					console.log(i);
					$(".dropdown li").removeClass('dropdownItemSelected');
					currentSelected = i;
					$(this).addClass('dropdownItemSelected');
				}).mouseout(function() {
					// $(this).removeClass('privacyMenuSelected').addClass(cls);
				}).click(function() {
					$("#dropdown_input").val($(this).html()).focus();
					$(".dropdown").remove();
					myCustomMethod($(this).attr("value"));
				});
			});
		}
});

function myCustomMethod(pid) {
	alert(pid);
}
