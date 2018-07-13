/****************************************** mention marge Birth ************************************************************/

//SERACH ***************
//form search Birth with numero
$('form.searchTBNum').on('submit',function(){
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
			$('#divResultTBirth').html(data);

			$("#tableSBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedTBirth.php";
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
$('form.searchTBName').on('submit',function(){
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
			$('#divResultTBirth').html(data);
			$("#tableSBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedTBirth.php";
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






///update *****************
$('form.tBirthupdateForm').on('submit',function(){
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
			$('#listTora').html(data);
			//console.log(data);

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
				window.setTimeout(function(){location.reload()},2000);


		}

	});

	return false;
});







///insert*******************
$('form.tBirthInsertForm').on('submit',function(){
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
			$('#listTora').html(data);
			//console.log(data);

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
				window.setTimeout(function(){location.reload()},2000);


		}

	});

	return false;
});


/****************************************** mention marge DEATH ************************************************************/
//SEARCH
$('form.searchTDNum').on('submit',function(){
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
			$('#divResultTDeath').html(data);
			$("#tableSDeath tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedTDeath.php";
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
$('form.searchTDName').on('submit',function(){
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
			$('#divResultTDeath').html(data);

			$("#tableSDeath tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedTDeath.php";
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



//delete tora
	$(document).ready(function(){

    $(document).on('click', '#delTDeath', function(e){

	var id = $(this).data('id');
	/*var annee = $(this).data('annee');
	var content_ar = $(this).data('content_ar');
	var content_fr = $(this).data('content_fr');*/
	swalDelete(id);
	window.setTimeout(function(){location.reload()},3000);
 		e.preventDefault();

    });

});

function swalDelete(id)
{

			swal({
			title: 'متأكد من هذه العملية؟',
			text: "سيتم حذف الطرة بصفة نهائية",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'نعم،متأكد',
			cancelButtonText:'إلغاء',
			showLoaderOnConfirm: true,

			preConfirm: function() {
			  return new Promise(function(resolve) {

			     $.ajax({
			   		url: 'deleteTDeathDB.php',
			    	type: 'POST',
			       	data: {'id' : id},
			       	dataType: 'html'
			     })
			     .done(function(response){
						// console.log(response);
			     	swal('تم حذف الطرة بنجاح!', response.message, response.status);
					$('#listTora').html(response);
			     })
			     .fail(function(){
			     	swal('Oops...', 'quelque chose ca marche pas!', 'error');
			     });
			  });
		    },
			allowOutsideClick: false
		});

}


///update *****************
$('form.tDeathupdateForm').on('submit',function(){
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
			$('#listTora').html(data);
			//console.log(data);

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
				window.setTimeout(function(){location.reload()},2000);


		}

	});

	return false;
});







///insert*******************
$('form.tDeathInsertForm').on('submit',function(){
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
			$('#listTora').html(data);
			//console.log(data);

					$.notify({
        	icon: "notifications",
        	message: 'تم الحفظ بنجاح'

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
				window.setTimeout(function(){location.reload()},2000);


		}

	});

	return false;
});
