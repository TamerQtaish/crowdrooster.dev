$(document).ready(function(){
	
	;
	$(".selected").click(function(){
		$(this).parent(".select-holder").css('overflow', 'visible');	
	});
	
	$(".select-holder span").click(function(){
		
		var currentHeight = $(".select-holder").height();
		if(currentHeight < 45 ){
			$(this).parent(".select-holder").css('overflow', 'visible');
			//$(".select-holder").height(500);
		}
		else{
			$(".select-holder").css('overflow', 'hidden');
			$(".select-holder").height(40);
		}
	});
	
	$(".select-holder").mouseleave(function(){
		$(this).css('overflow', 'hidden');
	});
	

	
	$(".option").click(function(){
		var value = $(this).html();
		var inputId = $(this).parent(".select-holder").data("real-input-id");
		$(this).parent(".select-holder").find(".selected").html(value)
		$(inputId).val(value);
		$(this).parent(".select-holder").css('overflow', 'hidden');
	});
	
	$("#upload").click(function(){
		$("#fileBrowser").click();
	});
	
});


function CloseLogin(){
	$('#login-overlay').hide();	
}

function ShowLogin(){
	$('#login-overlay').show();	
}


/******/

$(document).ready(function(){
	
	;
	$(".selected-re").click(function(){
		$(this).parent(".select-holder-re").css('overflow', 'visible');	
	});
	
	$(".select-holder-re span").click(function(){
		
		var currentHeight = $(".select-holder-re").height();
		if(currentHeight < 45 ){
			$(this).parent(".select-holder-re").css('overflow', 'visible');
			//$(".select-holder-re").height(500);
		}
		else{
			$(".select-holder-re").css('overflow', 'hidden');
			$(".select-holder-re").height(40);
		}
	});
	
	$(".select-holder-re").mouseleave(function(){
		$(this).css('overflow', 'hidden');
	});
	

	
	$(".option-re").click(function(){
		var value = $(this).html();
		var inputId = $(this).parent(".select-holder-re").data("real-input-id");
		$(this).parent(".select-holder-re").find(".selected-re").html(value)
		$(inputId).val(value);
		$(this).parent(".select-holder-re").css('overflow', 'hidden');
	});
	
	$("#upload").click(function(){
		$("#fileBrowser").click();
	});
	
});


function CloseLogin(){
	$('#login-overlay').hide();	
}

function ShowLogin(){
	$('#login-overlay').show();	
}
