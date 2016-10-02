$(function(){
	var headerElement = $("#header");
	var topOffset = headerElement.offset().top
	$(document).scroll(function(e){
		// var scroll = $(window).scrollTop();					
		// if(scroll > topOffset){				
		// 	headerElement.css({
		// 		"position":"absolute",
		// 		"top":0
		// 	});
		// }else{
		// 	headerElement.css({
		// 		"position":"static"					
		// 	});
		// }
	});

	$(".modal-trigger").leanModal();
});
function getPasswordPage(){
	this.cred_form_input_el = "#frmpst1";
	this.cred_form_reslt_el = "#frmrst";	
	this.checkCredential = function(url){	
		var obj = this;				
		var credID = $("#cred_id").val();
		$.post(url,{
			cred_id:credID
		},function(data){	
			console.log(obj.cred_form_input_el);
			$(obj.cred_form_input_el).slideUp(300);
			$(obj.cred_form_reslt_el).html(data);
			$(obj.cred_form_reslt_el).slideDown(300);
		});
	}
	this.reverseCredentialForm = function(){
		$(this.cred_form_input_el).slideDown(300);
		$(this.cred_form_reslt_el).slideUp(300).html('');
	}
}
function confirmDeletion(url){
	var ask = confirm("Hapus data?");

	if(ask == true)
		location.href = encodeURI(url);
}