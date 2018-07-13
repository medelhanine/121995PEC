
///SEARCH parents************.....................................
//DAD Info **************
$('form.searchDadForm').on('submit',function(){
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
		dataType: 'json',
		success: function(data){
 //console.log(data);
$('#nom_pere').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom_pere">
	 <label class="control-label m-label-form">Nom</label>
	 <input type="text" name="nom_pere" value="`+data["prenom"]+" "+data["nom"]+`"  class="form-control">
</div>`);

$('#nom_pere_ar').replaceWith(`<div class="form-group label-floating" id="nom_pere_ar">
		 <label class="control-label m-label-form droid-arabic-kufi">الإسم </label>
		 <input type="text" name="nom_pere_ar" value="`+data["prenom_ar"]+" "+data["nom_ar"]+`"  class="form-control">
	</div>`);

$('#nom_pere_tora').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom_pere_tora">
	 <label class="control-label m-label-form">Nom(marge)</label>
	 <input type="text" name="nom_pere_tora" value="`+data["nom_tora"]+`"  class="form-control">
</div>`);

$('#nom_pere_tora_ar').replaceWith(`<div class="form-group label-floating" id="nom_pere_tora_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">الاسم في الطرة</label>
	 <input type="text" name="nom_pere_tora_ar" value="`+data["nom_tora_ar"]+`"  class="form-control">
</div>`);

$('#date_naiss_pere_hijri_number').replaceWith(`<div class="form-group label-floating " id="date_naiss_pere_hijri_number">
	 <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
	 <input type="text" name="date_naiss_pere_hijri" value="`+data["date_naiss_hijri"]+`"  class="form-control " value="1439-02-25">
</div>`);

$('#date_naiss_pere_miladi_number').replaceWith(`<div class="form-group label-floating" id="date_naiss_pere_miladi_number">
	 <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
	 <input type="text" name="date_naiss_pere_miladi" value="`+data["date_naiss_miladi"]+`"  class="form-control datepicker" value="2018-02-25">
</div>`);

$('#date_naiss_pere_hijri').replaceWith(`<div class="form-group label-floating " id="date_naiss_pere_hijri">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_pere_hijri_ar" value="`+data["date_naiss_hijri_ar"]+`"  class="form-control">
</div>`);

$('#date_naiss_pere_miladi').replaceWith(`<div class="form-group label-floating" id="date_naiss_pere_miladi">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_pere_miladi_ar" value="`+data["date_naiss_miladi_ar"]+`"  class="form-control">
</div>`);

$('#date_naiss_pere_hijri_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_pere_hijri_fr">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
	 <input type="text" name="date_naiss_pere_hijri_fr" value="`+data["date_naiss_hijri_fr"]+`"  class="form-control">
</div>`);

$('#date_naiss_pere_miladi_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_pere_miladi_fr">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
	 <input type="text" name="date_naiss_pere_miladi_fr" value="`+data["date_naiss_miladi_fr"]+`"  class="form-control">
</div>`);

$('#lieu_naiss_pere_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="lieu_naiss_pere_fr">
	 <label class="control-label m-label-form">Lieu de naissance</label>
	 <input type="text" name="lieu_naiss_pere" value="`+data["lieu_naiss"]+`"  class="form-control">
</div>`);

$('#lieu_naiss_pere').replaceWith(`<div class="form-group label-floating" id="lieu_naiss_pere">
	 <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
	 <input type="text" name="lieu_naiss_pere_ar" value="`+data["lieu_naiss_ar"]+`"  class="form-control">
</div>`);

$('#nationalite_pere_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="nationalite_pere_fr">
	 <label class="control-label m-label-form">Nationalité</label>
	 <input type="text" name="nationalite_pere" value="`+data["nationalite"]+`"  class="form-control">
</div>`);

$('#nationalite_pere').replaceWith(`<div class="form-group label-floating" id="nationalite_pere">
	 <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
	 <input type="text" name="nationalite_pere_ar" value="`+data["nationalite_ar"]+`" class="form-control">
</div>`);



			$('#parentsModal').modal('hide');
			if(data["prenom_ar"] != "" || data["nom_ar"] != "")
				{
					$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important"> تمت إضافة بيانات الأب </h6>'

        			},
					 {
				type: 'success',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}
			else
				{

						$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">فشل البحث </h6>'

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

// MOM INFO**************
$('form.searchMotherForm').on('submit',function(){
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
		dataType: 'json',
		success: function(data){
 //console.log(data);
 $('#nom_mere').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom_mere">
	 <label class="control-label m-label-form">Nom</label>
	 <input type="text" name="nom_mere" value="`+data["prenom"]+" "+data["nom"]+`"  class="form-control">
 </div>`);

 $('#nom_mere_ar').replaceWith(`<div class="form-group label-floating" id="nom_mere_ar">
		 <label class="control-label m-label-form droid-arabic-kufi">الإسم </label>
		 <input type="text" name="nom_mere_ar" value="`+data["prenom_ar"]+" "+data["nom_ar"]+`"  class="form-control">
	</div>`);

 $('#nom_mere_tora').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom_mere_tora">
	 <label class="control-label m-label-form">Nom(marge)</label>
	 <input type="text" name="nom_mere_tora" value="`+data["nom_tora"]+`"  class="form-control">
 </div>`);

 $('#nom_mere_tora_ar').replaceWith(`<div class="form-group label-floating" id="nom_mere_tora_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">الاسم في الطرة</label>
	 <input type="text" name="nom_mere_tora_ar" value="`+data["nom_tora_ar"]+`"  class="form-control">
 </div>`);

 $('#date_naiss_mere_hijri_number').replaceWith(`<div class="form-group label-floating " id="date_naiss_mere_hijri_number">
	 <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
	 <input type="text" name="date_naiss_mere_hijri" value="`+data["date_naiss_hijri"]+`"  class="form-control " value="1439-02-25">
 </div>`);

 $('#date_naiss_mere_miladi_number').replaceWith(`<div class="form-group label-floating" id="date_naiss_mere_miladi_number">
	 <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
	 <input type="text" name="date_naiss_mere_miladi" value="`+data["date_naiss_miladi"]+`"  class="form-control datepicker" value="2018-02-25">
 </div>`);

 $('#date_naiss_mere_hijri_ar').replaceWith(`<div class="form-group label-floating " id="date_naiss_mere_hijri_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_mere_hijri_ar" value="`+data["date_naiss_hijri_ar"]+`"  class="form-control">
 </div>`);

 $('#date_naiss_mere_miladi_ar').replaceWith(`<div class="form-group label-floating" id="date_naiss_mere_miladi_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_mere_miladi_ar" value="`+data["date_naiss_miladi_ar"]+`"  class="form-control">
 </div>`);

 $('#date_naiss_mere_hijri_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_mere_hijri_fr">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
	 <input type="text" name="date_naiss_mere_hijri_fr" value="`+data["date_naiss_hijri_fr"]+`"  class="form-control">
 </div>`);

 $('#date_naiss_mere_miladi_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_mere_miladi_fr">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
	 <input type="text" name="date_naiss_mere_miladi_fr" value="`+data["date_naiss_miladi_fr"]+`"  class="form-control">
 </div>`);

 $('#lieu_naiss_mere_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="lieu_naiss_mere_fr">
	 <label class="control-label m-label-form">Lieu de naissance</label>
	 <input type="text" name="lieu_naiss_mere" value="`+data["lieu_naiss"]+`"  class="form-control">
 </div>`);

 $('#lieu_naiss_mere_ar').replaceWith(`<div class="form-group label-floating" id="lieu_naiss_mere_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
	 <input type="text" name="lieu_naiss_mere_ar" value="`+data["lieu_naiss_ar"]+`"  class="form-control">
 </div>`);

 $('#nationalite_mere_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="nationalite_mere_fr">
	 <label class="control-label m-label-form">Nationalité</label>
	 <input type="text" name="nationalite_mere" value="`+data["nationalite"]+`"  class="form-control">
 </div>`);

 $('#nationalite_mere').replaceWith(`<div class="form-group label-floating" id="nationalite_mere">
	 <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
	 <input type="text" name="nationalite_mere_ar" value="`+data["nationalite_ar"]+`" class="form-control">
 </div>`);
			$('#parentsModal').modal('hide');
			if(data["prenom_ar"] != "" ||  data["nom_ar"] != "")
				{
					$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">تم إضافة بيانات الأم </h6>'

        			},
					 {
				type: 'success',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}
			else
				{

						$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important"> فشل البحث </h6>'

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

/******************************** Solb Birth **********************************************************************/



// INSERT **********************

$('form.sBirthForm').on('submit',function(){
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
			if(data=="successSBirthsuccessExtrait")
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
            window.setTimeout(function(){window.location.replace("index.php");},2000);
		}
	});

	return false;
});



// ADD TO ETAT CIVIL///////////////////////////
$('form.insert_to_etat_civil').on('submit',function(){
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
		if(data=="fatherAlreadyExists")
		{
			$.notify({
			icon: "notifications",
			message: ' <h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">معلومات موجودة مسبقا </h6>'

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

		if(data=="father inserted")
		{
			$.notify({
			icon: "notifications",
			message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">تم إضافة الأب لكناش الحالة المدنية </h6>'

					},
			 {
		type: 'success',
		timer: 3000,
		placement: {
			from: 'top',
			align: 'left'
		}
	});

		}


		if(data=="son inerted")
		{
			$.notify({
			icon: "notifications",
			message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">تم إضافة الابن لكناش الحالة المدنية </h6>'

					},
			 {
		type: 'success',
		timer: 3000,
		placement: {
			from: 'top',
			align: 'left'
		}
	});

		}


		if(data=="sonAlreadyExists")
		{
			$.notify({
			icon: "notifications",
			message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">معلومات موجودة مسبقا </h6>'

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
		$('#add_to_etat_civil').modal('hide');
		}

	});

	return false;
});




//SEARCH*************************
//form search Birth with numero
$('form.searchSBNum').on('submit',function(){
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
			$('#divResultSBrith').html(data);

			$("#tableSBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   //var url = "selectedBirth.php?numero=" +value+ "&annee=" + value2;
			 var url = "selectedBirth.php";
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
$('form.searchSBName').on('submit',function(){
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
			$('#divResultSBrith').html(data);

			$("#tableSBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedBirth.php";
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

// UPDATE *********
$('form.sBirthFormUpdate').on('submit',function(){
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


//DELETE **********
$(document).ready(function(){

    $(document).on('click', '#delSBirth', function(e){

	var numero = $(this).data('numero');
	var annee = $(this).data('annee');
	swalDelete(numero,annee);

 		e.preventDefault();

    });

});

function swalDelete(numero,annee)
{

			swal({
			title: 'متأكد من هذه العملية؟',
			text: "سيتم حذف جميع الوثائق المتعلقة به ",
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
			   		url: 'delSBirthDB.php',
			    	type: 'POST',
			       	data: {'numero' : numero,'annee' : annee},
			       	dataType: 'html'
			     })
			     .done(function(response){
			     	swal( 'تمت العملية بنجاح ', response.message, response.status);
					$('#listTora').html(response);
					window.setTimeout(function(){window.location.replace("index.php");},2000);
			     })
			     .fail(function(){
			     	swal('Oops...', 'quelque chose ca marche pas!', 'error');
			     });
			  });
		    },
			allowOutsideClick: false
		});

}

//validate Birth **************
$(document).ready(function(){

    $(document).on('click', '#validateBirth', function(e){

     e.preventDefault();
  	var numero = $(this).data('numero');
		var annee = $(this).data('annee');



     $.ajax({
          url: 'valdidateSBirthDB.php',
          type: 'POST',
          data: {numero:numero,annee:annee},
          dataType: 'html'
     })
     .done(function(data){
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
 					window.setTimeout(function(){location.reload()},1000);
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

     })
     .fail(function(){

     });

    });
});





/***************************************************** SOLB DEATH******************************/



//search *****************
//form search Birth with numero
$('form.searchSDNum').on('submit',function(){
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
			$('#divResultSDeath').html(data);

			$("#tableSDeath tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedDeath.php";
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
$('form.searchSDName').on('submit',function(){
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
			$('#divResultSDeath').html(data);
			//console.log(data);
			$("#tableSDeath tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedDeath.php";
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



// ADD***************************
$(document).ready(function(){

    $(document).on('click', '#addSDeath', function(e){



     e.preventDefault();
		 var regex=/^[0-9]+$/;
		 var numeroSDeath = document.getElementById('numeroSDeath').value;
		 var anneeSDeath = document.getElementById('anneeSDeath').value;
		if((numeroSDeath=="" || !numeroSDeath.match(regex)) || (anneeSDeath=="" || !anneeSDeath.match(regex)) )
			 {
				 swal({
								title: "المرجو إدخال الرقم و السنة معا(أعداد)",
								buttonsStyling: false,
								confirmButtonClass: "btn btn-success"
							});


			 }
		else
			{
				var numero = document.getElementById('numeroSDeath').value;
				var annee = document.getElementById('anneeSDeath').value;
				window.location = "insertSDeath.php?numero="+numero+"&annee="+annee;
			}


    });
});


//INSERT ***************
///insert s dead
$('form.sDeathForm').on('submit',function(){
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
		dataType:'html',
		success: function(data){
			//console.log(data);
			if(data=="successSDeathsuccessExtrait")
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
				window.setTimeout(function(){window.location.replace("index.php");},2000);
		}
	});
	return false;
});

/// update ******************
$('form.sDeathFormUpdate').on('submit',function(){
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
			
			if(data=="success")
				{
					$.notify({
					icon: "notifications",
					message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important"> تم التغيير بنجاح </h6>'

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
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">فشلت العملية </h6'

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


//DELETE **********
$(document).ready(function(){

    $(document).on('click', '#delSDeath', function(e){

	var numero = $(this).data('numero');
	var annee = $(this).data('annee');
	swalDelete(numero,annee);

 		e.preventDefault();

    });

});

function swalDelete(numero,annee)
{

			swal({
			title: 'متأكد من هذه العملية؟',
			text: "سيتم حذف جميع الوثائق المتعلقة به ",
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
			   		url: 'delSDeathDB.php',
			    	type: 'POST',
			       	data: {'numero' : numero,'annee' : annee},
			       	dataType: 'html'
			     })
			     .done(function(response){
			     	swal( 'تمت العملية بنجاح ', response.message, response.status);
					$('#listTora').html(response);
					window.setTimeout(function(){window.location.replace("index.php");},3000);
			     })
			     .fail(function(){
			     	swal('Oops...', 'quelque chose ca marche pas!', 'error');
			     });
			  });
		    },
			allowOutsideClick: false
		});

}

//validate death **************
$(document).ready(function(){

    $(document).on('click', '#validateDeath', function(e){

     e.preventDefault();
  	var numero = $(this).data('numero');
		var annee = $(this).data('annee');



     $.ajax({
          url: 'validateSDeathDB.php',
          type: 'POST',
          data: {numero:numero,annee:annee},
          dataType: 'html'
     })
     .done(function(data){
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
 					window.setTimeout(function(){location.reload()},2000);
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

     })
     .fail(function(){

     });

    });
});
