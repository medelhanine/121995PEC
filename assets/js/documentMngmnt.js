//Extrait Birth /////////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.searchExtBirthNumP').on('submit',function(){
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
			$('#resultExtBirthP').html(data);

			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedExtBirthP.php?numero=" +value+ "&annee=" + value2;
		   window.location.href = url;
});

		}

	});

	return false;
});




//form search Birth with name
$('form.searchExtBirthNameP').on('submit',function(){
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
			$('#resultExtBirthP').html(data);

			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedExtBirthP.php?numero=" +value+ "&annee=" + value2;
		   window.location.href = url;
});

		}

	});

	return false;
});


/// Acte DECES //////////////////////////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.searchActeDecesNumP').on('submit',function(){
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
			$('#resultActeDecesP').html(data);
			console.log(data);
			$("#tableActeDeces tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedActeDecesP.php?numero=" +value+ "&annee=" + value2;
		   window.location.href = url;
});

		}

	});

	return false;
});


//form search Birth with name
$('form.searchActeDecesNameP').on('submit',function(){
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
			$('#resultActeDecesP').html(data);
			console.log(data);
			$("#tableActeDeces tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedActeDecesP.php?numero=" +value+ "&annee=" + value2;
		   window.location.href = url;
});

		}

	});

	return false;
});


// Copie integgrale de Naissanece //////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.searchSBNumP').on('submit',function(){
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
			$('#resultSBirthP').html(data);

			$("#tableSBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedBirthP.php?numero=" +value+ "&annee=" + value2;
		   window.location.href = url;
});

		}

	});

	return false;
});




//form search Birth with name
$('form.searchSBNameP').on('submit',function(){
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
			$('#resultSBirthP').html(data);

			$("#tableSBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedBirthP.php?numero=" +value+ "&annee=" + value2;
		   window.location.href = url;
});

		}

	});

	return false;
});


//Copie intgrale de DECES ///////////////////////////////////////////////////////////////////////////////////////
//form search Birth with numero
$('form.searchSDNumP').on('submit',function(){
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
			$('#resultSDeathP').html(data);

			$("#tableSDeath tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedDeathP.php?numero=" +value+ "&annee=" + value2;
		   window.location.href = url;
});

		}

	});

	return false;
});


//form search Birth with name
$('form.searchSDNameP').on('submit',function(){
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
			$('#resultSDeathP').html(data);
			console.log(data);
			$("#tableSDeath tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedDeathP.php?numero=" +value+ "&annee=" + value2;
		   window.location.href = url;
});

		}

	});

	return false;
});
