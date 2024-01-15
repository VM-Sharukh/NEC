
	$(function(){
		SubmitForm('LoginForm');
		SubmitForm('ManageUserForm');
	});

	function SubmitForm(FormID){
		var myform = $("#"+FormID);
		  $(myform).ajaxForm({
			  beforeSend: function() {
				  $('.error_msg').html('');
				  $('.success_message').html('<br><div class="alert alert-info">Data analyzing...please wait...</div>');
			  },
			  complete: function(response){
				// console.log(response);return false;
				var temp = JSON.parse(response.responseText);
				if(temp.status == 'success'){
					$('.success_message').show().html(temp.message);
					myform.resetForm();
					window.location.href= temp.redirect;
				}
				else if(temp.status == 'error'){
				  $.each(temp.errors, function(key, val){
					  $('.success_message').html('');
					  $('.'+key).html(val);
				  });
				}
			  }
		  });  
	}
