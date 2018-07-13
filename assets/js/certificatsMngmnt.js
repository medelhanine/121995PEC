//fiancaille /////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.fiancailleFormNum').on('submit',function(){
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
			$('#resultnonfiancaille').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "fiancailleInfo.php";
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
$('form.fiancailleFormName').on('submit',function(){
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
			$('#resultfiancaille').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "fiancailleInfo.php";
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





//Non MARRIAGE /////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.nonMariageFormNum').on('submit',function(){
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
			$('#resultnonMariage').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "nonMariageInfo.php";
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
$('form.nonMariageFormName').on('submit',function(){
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
			$('#resultnonMariage').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "nonMariageInfo.php";
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



//Non inscription  /////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.nonInscritFormNum').on('submit',function(){
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
			$('#resultnonInscription').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "nonInscriptionInfo.php";
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
$('form.nonInscritFormName').on('submit',function(){
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
			$('#resultnonInscription').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "nonInscriptionInfo.php";
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






//INDEIVIDUALITE ////////////////////////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.inidividualiteFormNum').on('submit',function(){
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
			$('#resultinidividualite').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "IndividualiteInfo.php";
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
$('form.inidividualiteFormName').on('submit',function(){
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
			$('#resultinidividualite').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "IndividualiteInfo.php" ;
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

//VIE INDIVIDUELLE *::::::::///////////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.vieIndividuFormNum').on('submit',function(){
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
			$('#resultVieIndividu').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "vieIndividuInfo.php";
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
$('form.vieIndividuFormName').on('submit',function(){
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
			$('#resultVieIndividu').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "vieIndividuInfo.php";
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







//NON DIVORCE::::::::::::::://////////////////////////////////////////////////////////
//form search Birth with numero
$('form.nonDivorceFormNum').on('submit',function(){
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
			$('#resultnonDivorce').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "nonDivorceInfo.php";
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
$('form.nonDivorceFormName').on('submit',function(){
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
			$('#resultnonDivorce').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "nonDivorceInfo.php";
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


//VIE COLLECTIVE ////////////////////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.vieCollectFormNum').on('submit',function(){
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
			$('#resultvieCollect').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "vieCollectInfo.php";
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
$('form.vieCollectFormName').on('submit',function(){
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
			$('#resultvieCollect').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "vieCollectInfo.php";
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




//MONOGAMIE ////////////////////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.monogamieFormNum').on('submit',function(){
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
			$('#resultmonogamie').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "monogamieInfo.php";
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
$('form.monogamieFormName').on('submit',function(){
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
			$('#resultmonogamie').html(data);
			console.log(data);
			$("#tablemonogamie tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "monogamieInfo.php";
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


//CELIBAT /////////////////////////////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.celibatFormNum').on('submit',function(){
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
			$('#resultcelibat').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "celibatInfo.php";
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
$('form.celibatFormName').on('submit',function(){
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
			$('#resultcelibat').html(data);
			console.log(data);
			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "celibatInfo.php";
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
