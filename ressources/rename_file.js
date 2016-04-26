function rename()
{
	$('#new_names_list').empty();
	$("#editform input:checkbox:checked").each(function() 
	{
    	var id = $(this).attr('value');
    	$('#new_names_list').append('<p>&emsp;Ancien nom : ' + id + '  </br>  &emsp;Nouveau nom : <input id="Names" class="verify_name" type="text" name="newNames[]"></br>');
	});
	$('#new_names_list').append('<input type="submit" id="rename_button" value="Renommer les fichiers" name="rename" disabled/>');
	verify_name(); 
};



function verify_name()
{
	$( ".verify_name" ).keyup(function() {
	
		var isValid=(function(){ 
		var rg1=/^[^\\/:\*\?"<>\|]+$/ ; //"
		var rg2=/^\./; 
		var rg3=/^(nul|prn|con|lpt[0-9]|com[0-9])(\.|$)/i;

		return function isValid(fname){ 
			return rg1.test(fname)&&!rg2.test(fname)&&!rg3.test(fname); } })(); 

		if (isValid($(this).val()) || $(this).val()=="")
			{
				$("#rename_button").prop("disabled",false);
				$(this).css("color","black");
			}
		else
			{
				$("#rename_button").prop("disabled",true);
				$(this).css("color","red");
			};

	})
}

