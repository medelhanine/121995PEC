
//insert etatCivil
$('form.etatCivilInsert').on('submit',function(){
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

			if(data=="alreadyExists")
			{
				swal({
							 title: "المعذرة،هذا الكناش يوجد مسبقا ",
							 buttonsStyling: false,
							 confirmButtonClass: "btn btn-success"
						 });
			}


			if(data=="error father doesn't exist")
			{
				swal({
							 title: " المعذرة،معلومات الأب لا توجد في قاعدة البيانات ",
							 buttonsStyling: false,
							 confirmButtonClass: "btn btn-success"
						 });
			}


			if(data=="fatherAlreadyExists")
			{
				swal({
							 title: " المعذرة،صاحب الكناش موجود مسبقا ",
							 buttonsStyling: false,
							 confirmButtonClass: "btn btn-success"
						 });
			}

			if(data=="child doesn't exist" || data=="child already exists" )
			{
				swal({
							 title: " المعذرة، معلومات أحد الأبناء غير صحيحة ",
							 buttonsStyling: false,
							 confirmButtonClass: "btn btn-success"
						 });

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

		 		window.setTimeout(function(){window.location.replace("index.php");},2000);
			}else {

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

	 window.setTimeout(function(){window.location.replace("index.php");},3000);
			}


		}

	});

	return false;
});



//insert new child
$('form.childInsertForm').on('submit',function(){
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

			if(data=="child does not extist in database")
			{
				swal({
							 title: " المعذرة، لا توجد هذه المعلومات في قاعدة البيانات ",
							 buttonsStyling: false,
							 confirmButtonClass: "btn btn-success"
						 });
			}


			if(data=="error father doesn't exist")
			{
				swal({
							 title: " المعذرة،معلومات الأب لا توجد في قاعدة البيانات ",
							 buttonsStyling: false,
							 confirmButtonClass: "btn btn-success"
						 });
						 window.setTimeout(function(){window.location.reload();},3000);
			}


			if(data=="this child already exist in other etat civil")
			{
				swal({
							 title: " المعذرة،هذا الإبن موجود في كناش آخر ",
							 buttonsStyling: false,
							 confirmButtonClass: "btn btn-success"
						 });
						 window.setTimeout(function(){window.location.reload();},3000);
			}

			if(data=="inserted")
			{

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

		 		window.setTimeout(function(){window.location.reload();},3000);
			}
		}

	});

	return false;
});




//update child/////
$('form.childupdateForm').on('submit',function(){
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

			if(data=="child does not extist in database")
			{
				swal({
							 title: " المعذرة، لا توجد هذه المعلومات في قاعدة البيانات ",
							 buttonsStyling: false,
							 confirmButtonClass: "btn btn-success"
						 });
			}


			if(data=="error father doesn't exist")
			{
				swal({
							 title: " المعذرة،معلومات الأب لا توجد في قاعدة البيانات ",
							 buttonsStyling: false,
							 confirmButtonClass: "btn btn-success"
						 });
						 window.setTimeout(function(){window.location.reload();},3000);
			}


			if(data=="this child already exist in other etat civil")
			{
				swal({
							 title: " المعذرة،هذا الإبن موجود في كناش آخر ",
							 buttonsStyling: false,
							 confirmButtonClass: "btn btn-success"
						 });
						 window.setTimeout(function(){window.location.reload();},3000);
			}

			if(data=="updated")
			{

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

		 		window.setTimeout(function(){window.location.reload();},3000);
			}
		}

	});

	return false;
});

//search etat civil
$('form.searchEtatCivilForm').on('submit',function(){
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
			$('#add').html(data);
			$('#etatCivilModal').modal('hide');
			if(data.indexOf("color:red") > -1 )
				{
					$.notify({
						icon: "notifications",
						message: ' فشل البحث '

								},
						 {
					type: 'danger',
					timer: 3000,
					placement: {
						from: 'top',
						align: 'left'
					}
				});
				window.setTimeout(function(){location.reload();},2000);
				}
			else
				{
			$.notify({
			icon: "notifications",
			message: ' تم إضافة معلومات الحالة المدنية '
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
		}

	});

	return false;
});


//BULETTIN INDIVIDU RESULT////////////////////////////////////////////////////////////////////////////
$(document).ready(function(){
 load_data();

 function load_data(numero,annee)
 {
  $.ajax({
   url:"searchBulletin.php",
   method:"POST",
   dataType : "json",
   data:{'numero':numero,'annee':annee},
   success:function(data)
   {

		$("#prenom_ar").replaceWith(`<div class="col-md-6" id="prenom_ar">
      <div class="form-group label-floating " >
      <label class="control-label m-label-form droid-arabic-kufi"> الإسم الشخصي </label>
        <input type="text" name="prenom_ar"  value="`+data["prenom_ar"]+`" class="form-control">
      </div>
    </div>`);

    $("#prenom").replaceWith(`<div class="col-md-6" id="prenom">
      <div class="form-group label-floating m-input-fr" >
        <label class="control-label m-label-form droid-arabic-kufi"> Prènom </label>
        <input type="text" name="prenom"  value="`+data["prenom"]+`" class="form-control">
      </div>
    </div>`);

		$("#nom_ar").replaceWith(`<div class="col-md-6" id="nom_ar">
		<div class="form-group label-floating">
			<label class="control-label m-label-form droid-arabic-kufi"> الإسم العائلي </label>
        <input type="text" name="nom_ar"  value="`+data["nom_ar"]+`" class="form-control">
      </div>
    </div>`);

		$("#nom").replaceWith(`<div class="col-md-6" id="nom">
      <div class="form-group label-floating m-input-fr" >
      <label class="control-label m-label-form droid-arabic-kufi"> Nom </label>
        <input type="text" name="nom"  value="`+data["nom"]+`" class="form-control">
      </div>
    </div>`);

		$("#date_naiss_hijri_ar").replaceWith(`<div class="col-md-6" id="date_naiss_hijri_ar">
		<div class="form-group label-floating">
			<label class="control-label m-label-form droid-arabic-kufi"> تاريخ الإزدياد الهجري </label>
        <input type="text" name="date_naiss_hijri_ar"  value="`+data["date_naiss_hijri_ar"]+`" class="form-control">
      </div>
    </div>`);

		$("#date_naiss_miladi_ar").replaceWith(`<div class="col-md-6" id="date_naiss_miladi_ar">
		<div class="form-group label-floating">
			<label class="control-label m-label-form droid-arabic-kufi"> الميلادي </label>
        <input type="text" name="date_naiss_miladi_ar"  value="`+data["date_naiss_miladi_ar"]+`" class="form-control">
      </div>
    </div>`);

		$("#date_naiss_hijri_fr").replaceWith(`<div class="col-md-6" id="date_naiss_hijri_fr">
      <div class="form-group label-floating m-input-fr" >
          <label class="control-label m-label-form droid-arabic-kufi"> تاريخ الإزدياد الهجري (بالفرنسية) </label>
        <input type="text" name="date_naiss_hijri_fr"  value="`+data["date_naiss_hijri_fr"]+`" class="form-control">
      </div>
    </div>`);

		$("#date_naiss_miladi_fr").replaceWith(`<div class="col-md-6" id="date_naiss_miladi_fr">
      <div class="form-group label-floating m-input-fr" >
        <label class="control-label m-label-form droid-arabic-kufi"> الميلادي (بالفرنسية)</label>
        <input type="text" name="date_naiss_miladi_fr"  value="`+data["date_naiss_miladi_fr"]+`" class="form-control">
      </div>
    </div>`);

		$("#lieu_naiss_ar").replaceWith(`<div class="col-md-6" id="lieu_naiss_ar">
		<div class="form-group label-floating">
			<label class="control-label m-label-form droid-arabic-kufi"> مكان الإزدياد </label>
        <input type="text" name="lieu_naiss_ar"  value="`+data["lieu_naiss_ar"]+`" class="form-control">
      </div>
    </div>`);

		$("#lieu_naiss").replaceWith(`<div class="col-md-6" id="lieu_naiss">
			<div class="form-group label-floating m-input-fr">
				<label class="control-label m-label-form droid-arabic-kufi"> Lieu de naissance </label>
        <input type="text" name="lieu_naiss"  value="`+data["lieu_naiss"]+`" class="form-control">
      </div>
    </div>`);

		$("#nom_pere_ar").replaceWith(`<div class="col-md-6" id="nom_pere_ar">
		<div class="form-group label-floating">
			<label class="control-label m-label-form droid-arabic-kufi"> والده(ها) </label>
        <input type="text" name="nom_pere_ar"  value="`+data["nom_pere_ar"]+`" class="form-control">
      </div>
    </div>`);

		$("#nom_pere").replaceWith(`<div class="col-md-6" id="nom_pere">
		<div class="form-group label-floating m-input-fr">
			<label class="control-label m-label-form droid-arabic-kufi"> Fils ou fille de </label>
        <input type="text" name="nom_pere"  value="`+data["nom_pere"]+`" class="form-control">
      </div>
    </div>`);

		$("#nom_mere_ar").replaceWith(`<div class="col-md-6" id="nom_mere_ar">
		<div class="form-group label-floating">
			<label class="control-label m-label-form droid-arabic-kufi">والدته(ها) </label>
        <input type="text" name="nom_mere_ar"  value="`+data["nom_mere_ar"]+`" class="form-control">
      </div>
    </div>`);

		$("#nom_mere").replaceWith(`<div class="col-md-6" id="nom_mere">
		<div class="form-group label-floating m-input-fr">
			<label class="control-label m-label-form droid-arabic-kufi"> Et de</label>
        <input type="text" name="nom_mere"  value="`+data["nom_mere"]+`" class="form-control">
      </div>
    </div>`);

		$("#domicile_ar").replaceWith(`<div class="col-md-6" id="domicile_ar">
		<div class="form-group label-floating">
			<label class="control-label m-label-form droid-arabic-kufi">القاطن حاليا ب </label>
        <input type="text" name="domicile_ar"  value="`+data["domicile_ar"]+`" class="form-control">
      </div>
    </div>`);

		$("#domicile").replaceWith(`<div class="col-md-6" id="domicile">
		<div class="form-group label-floating m-input-fr">
			<label class="control-label m-label-form droid-arabic-kufi"> Domicilié à</label>
        <input type="text" name="domicile"  value="`+data["domicile"]+`" class="form-control">
      </div>
    </div>`);

		$("#mention_marge_ar").replaceWith(`<div class="col-md-6" id="mention_marge_ar">
		<div class="form-group label-floating">
			<label class="control-label m-label-form droid-arabic-kufi"> البيانات الهامشية </label>
        <input type="text" name="mention_marge_ar"  value="`+data["mention_marge_ar"]+`" class="form-control">
      </div>
    </div>`);

		$("#mention_marge").replaceWith(`<div class="col-md-6" id="mention_marge">
		<div class="form-group label-floating m-input-fr">
			<label class="control-label m-label-form droid-arabic-kufi"> Mentions Marginales</label>
        <input type="text" name="mention_marge"  value="`+data["mention_marge"]+`" class="form-control">
      </div>
    </div>`);


   }
  });
 }
 $('#numeroBulettin,#anneeBulettin').keyup(function(){
  var numero = $("#numeroBulettin").val();
  var annee = $("#anneeBulettin").val();
  console.log(numero+" "+annee);
  if(numero != '' && annee != '')
  {
   load_data(numero,annee);
  }
  else
  {
   load_data();
  }
 });
});
