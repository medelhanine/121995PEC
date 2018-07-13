//SEARCH ***************
$('form.gereralSearchNum').on('submit',function(){
	var that = $(this),
	url = that.attr('action'),
	type=that.attr('method'),
	data = {};
	that.find('[name]').each(function(index,value){
		var that = $(this),
		name= that.attr('name'),
		value = that.val();

		data[name] = value;
	});

	$.ajax({
		url :url,
		type:type,
		data:data,
		success: function(data){
			$('#divResultgereralSearch').html(data);

			$("#tablegereralSearch tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedPerson.php";
			 var form = $('<form action="' + url + '" method="post">' +
			   '<input type="text" name="numero" value="' + value + '" />' +
			 	'<input type="text" name="annee" value="' + value2 + '" />' +
			   '</form>');
			 	$('body').append(form);
			 		   form.submit();
});

		}

	});

	return false;
});


//form search Birth with name
$('form.gereralSearchName').on('submit',function(){
	var that = $(this),
	url = that.attr('action'),
	type=that.attr('method'),
	data = {};
	that.find('[name]').each(function(index,value){
		var that = $(this),
		name= that.attr('name'),
		value = that.val();

		data[name] = value;
	});

	$.ajax({
		url :url,
		type:type,
		data:data,
		success: function(data){
			$('#divResultgereralSearch').html(data);

			$("#tablegereralSearch tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedPerson.php";
			 var form = $('<form action="' + url + '" method="post">' +
			   '<input type="text" name="numero" value="' + value + '" />' +
			 	'<input type="text" name="annee" value="' + value2 + '" />' +
			   '</form>');
			 	$('body').append(form);
			 		   form.submit();
});

		}

	});

	return false;
});