function rename()
{
	$('#new_names_list').empty();
	$("#editform input:checkbox:checked").each(function() 
	{
    	var id = $(this).attr('value');
    	var dir = $(this).attr('directory');
    	$('#new_names_list').append('<p>&emsp;Ancien nom : ' + id + '  </br>  &emsp;Nouveau nom : <input id="Names" directory="' + dir + '" type="text" name="newNames[]"></br>');
    	$('#new_names_list').append('<input id="oldNames" type="hidden" name="oldNames[] value=""></p>');
	});
	$('#new_names_list').append('<input type="submit" value="Renommer les fichiers" name="rename"/>');
}