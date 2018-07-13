
/// AVIS MARIAGE

//form search Birth with numero
$('form.searchAvisMariageNum').on('submit',function(){
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
			$('#divResultAvisMariage').html(data);

			$("#tableAvisMariage tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   //var url = "selectedBirth.php?numero=" +value+ "&annee=" + value2;
			 var url = "selectedAvisMariage.php";
var form = $('<form action="' + url + '" method="post">' +
  '<input type="text" name="adad" value="' + value + '" />' +
	'<input type="text" name="numero_sijil" value="' + value2 + '" />' +
  '</form>');
	$('body').append(form);
		   form.submit();
});

		}

	});

	return false;
});


/***** AVIS DIVORCE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */

//form search Birth with numero
$('form.searchAvisDivorceNum').on('submit',function(){
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
			$('#divResultAvisDivorce').html(data);
			$("#tableAvisDivorce tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   //var url = "selectedBirth.php?numero=" +value+ "&annee=" + value2;
			 var url = "selectedAvisDivorce.php";
			var form = $('<form action="' + url + '" method="post">' +
			'<input type="text" name="adad" value="' + value + '" />' +
				'<input type="text" name="numero_sijil" value="' + value2 + '" />' +
			'</form>');
				$('body').append(form);
					form.submit();
			});

		}

	});

	return false;
});