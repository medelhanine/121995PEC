/* ***********************************    EXTRAIT NAISSANCE	********************************/

//ADD****************
	$(document).ready(function(){

    $(document).on('click', '#addExtNaiss', function(e){

		console.log(numero);

     e.preventDefault();
		if(document.getElementById('numeroExtNaiss').value=="" || document.getElementById('anneeExtNaiss').value=="")
			 {
				 swal({
								title: "المرجو إدخال الرقم و السنة",
								buttonsStyling: false,
								confirmButtonClass: "btn btn-success"
							});
			 }
		else
			{
				var numero = document.getElementById('numeroExtNaiss').value;
				var annee = document.getElementById('anneeExtNaiss').value;
				window.location = "insertExtBirth.php?numero="+numero+"&annee="+annee;
			}


    });
});


//SEARCH ***************
$('form.searchExtraitNaissNum').on('submit',function(){
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
			$('#divResultExtBirth').html(data);

			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedExtBirth.php";
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
$('form.searchExtraitNaissName').on('submit',function(){
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
			$('#divResultExtBirth').html(data);

			$("#tableExtBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedExtBirth.php";
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






//ISNERT **********************
$('form.extBirthForm').on('submit',function(){
	//console.log("teststststs");
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
			console.log(data);
			if(data=="success")
				{


					$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">تم الحفظ بنجاح </h6>'

        			},
					 {
				type: 'success',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});
					//document.getElementById('sBirthForm').reset();
				}
			else
				{

						$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">فشلت الاضافة </h6>'

        			},
					 {
				type: 'danger',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}


		}

	});

	return false;
});

///UPDATE *************
$('form.extBirthFormUpdate').on('submit',function(){
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
			//console.log(data);
			if(data=="success")
				{
					$.notify({
							icon: "notifications",
							message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">تم التغيير بنجاح </h6>'

        			},
					 {
				type: 'success',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});
					//document.getElementById('sBirthForm').reset();
					//window.setTimeout(function(){location.reload()},2000);
				}
			else
				{
					$.notify({
					icon: "notifications",
					message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important"> فشلت العملية </h6>'

        			},
					 {
				type: 'danger',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}

		}

	});

	return false;
});



/*************************************  ACTE DECES ***********************************************/

//ADD**************
$(document).ready(function(){

    $(document).on('click', '#addActeDeces', function(e){

		console.log(numero);

     e.preventDefault();
		if(document.getElementById('numeroActeDeces').value=="" || document.getElementById('anneeActeDeces').value=="")
			 {
				 swal({
								title: "المرجو إدخال الرقم و السنة",
								buttonsStyling: false,
								confirmButtonClass: "btn btn-success"
							});
			 }
		else
			{
				var numero = document.getElementById('numeroActeDeces').value;
				var annee = document.getElementById('anneeActeDeces').value;
				window.location = "insertActeDeces.php?numero="+numero+"&annee="+annee;
			}


    });
});


//SEARCH ***************
$('form.searchActeDecesNum').on('submit',function(){
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
			$('#divResultActeDeces').html(data);
			console.log(data);
			$("#tableActeDeces tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedActeDeces.php";
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


$('form.searchActeDecesName').on('submit',function(){
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
			$('#divResultActeDeces').html(data);
			console.log(data);
			$("#tableActeDeces tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedActeDeces.php";
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

//UPDATE
$('form.acteDecesFormUpdate').on('submit',function(){
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
			console.log(data);

			if(data=="success")
				{


					$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">تم التغيير بنجاح </h6>'

        			},
					 {
				type: 'success',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});
					//document.getElementById('sBirthForm').reset();
					//window.setTimeout(function(){location.reload()},2000);
				}
			else
				{

						$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">فشلت العملية </h6>'

        			},
					 {
				type: 'danger',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}

		}

	});

	return false;
});


////insert ***************
$('form.acteDecesForm').on('submit',function(){
	//console.log("teststststs");
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
			console.log(data);
			if(data=="success")
				{


					$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">تم الحفظ بنجاح </h6>'

        			},
					 {
				type: 'success',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});
					//document.getElementById('sBirthForm').reset();
				}
			else
				{

						$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">فشلت الاضافة </h6>'

        			},
					 {
				type: 'danger',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}


		}

	});

	return false;
});
