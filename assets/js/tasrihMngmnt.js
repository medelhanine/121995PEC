// INSERT **********************
$('form.tasrihForm').on('submit',function(){
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
			if(data=="successTasrih")
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




//SEARCH*************************
//form search Birth with numero
$('form.searchTasrihBNum').on('submit',function(){
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
			$('#divResultTasrihBrith').html(data);

			$("#tableTasrihBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedTasrihBirth.php";
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
$('form.searchTasrihBName').on('submit',function(){
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
			$('#divResultTasrihBrith').html(data);

			$("#tableTasrihBirth tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedTasrihBirth.php";
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
$('form.tasrihBirthFormUpdate').on('submit',function(){
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



//search data from tasrih
$('form.searchTasrihForm').on('submit',function(){

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
 console.log(data);
			$('#prenom_ar').replaceWith(`<div class="form-group label-floating" id="prenom_ar">
				 <label class="control-label m-label-form droid-arabic-kufi">الاسم الشخصي</label>
				 <input type="text" name="prenom_ar" value="`+data["prenom_naiss"]+`" class="form-control">
			</div>`);

			$('#prenom').replaceWith(`<div class="form-group label-floating m-input-fr" id="prenom">
				 <label class="control-label m-label-form ">Prénom</label>
				 <input type="text" name="prenom" value="`+data["prenom_naiss_fr"]+`" class="form-control">
			</div>`);


$('#nom_ar').replaceWith(`<div class="form-group label-floating" id="nom_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">الاسم العائلي</label>
	 <input type="text" name="nom_ar" value="`+data["nom_naiss"]+`" class="form-control">
</div>`);

$('#nom').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom">
	 <label class="control-label m-label-form">Nom</label>
	 <input type="text" name="nom" value="`+data["nom_naiss_fr"]+`" class="form-control">
</div>`);

$('#lieu_naiss_ar').replaceWith(`<div class="form-group label-floating" id="lieu_naiss_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
	 <input type="text" name="lieu_naiss_ar" value="`+data["lieu_naiss"]+`" class="form-control">
</div>`);

$('#date_naiss_hijri').replaceWith(`<div class="form-group label-floating" id="date_naiss_hijri">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_hijri_ar" value="`+data["date_naiss_hijri"]+" "+data["annee_naiss_hijri"]+`" class="form-control">
</div>`);

$('#date_naiss_miladi').replaceWith(`<div class="form-group label-floating" id="date_naiss_miladi">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_miladi_ar" value="`+data["date_naiss_miladi"]+" "+data["annee_naiss_miladi"]+`"  class="form-control">
</div>`);

$('#heure').replaceWith(`<div class="form-group label-floating" id="heure">
	 <label class="control-label m-label-form droid-arabic-kufi">على الساعة</label>
	 <input type="text" name="heure" value="`+data["heure"]+`" class="form-control">
</div>`);

$('#min').replaceWith(`<div class="form-group label-floating" id="min">
	 <label class="control-label m-label-form droid-arabic-kufi">و الدقيقة</label>
	 <input type="text" name="min_naiss" value="`+data["min"]+`" class="form-control">
</div>`);

$('#nom_pere_ar').replaceWith(`<div class="form-group label-floating" id="nom_pere_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">الإسم </label>
	 <input type="text" name="nom_pere_ar" value="`+data["nom_pere"]+`" class="form-control">
</div>`);

$('#date_naiss_pere_hijri').replaceWith(`<div class="form-group label-floating " id="date_naiss_pere_hijri">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_pere_hijri_ar" value="`+data["date_naiss_pere_hijri"]+" "+data["annee_naiss_pere_hijri"]+`" class="form-control">
</div>`);

$('#date_naiss_pere_miladi').replaceWith(`<div class="form-group label-floating" id="date_naiss_pere_miladi">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_pere_miladi_ar" value="`+data["date_naiss_pere_miladi"]+" "+data["annee_naiss_pere_miladi"]+`" class="form-control">
</div>`);

$('#lieu_naiss_pere').replaceWith(`<div class="form-group label-floating" id="lieu_naiss_pere">
	 <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
	 <input type="text" name="lieu_naiss_pere_ar" value="`+data["lieu_naiss_pere"]+`" class="form-control">
</div>`);

$('#nationalite_pere').replaceWith(`<div class="form-group label-floating" id="nationalite_pere">
	 <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
	 <input type="text" name="nationalite_pere_ar" value="`+data["nationalite_pere"]+`" class="form-control">
</div>`);

$('#profession_pere').replaceWith(`<div class="form-group label-floating" id="profession_pere">
	 <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
	 <input type="text" name="profession_pere_ar" value="`+data["profession_pere"]+`" class="form-control">
</div>`);

$('#niveau_scol_pere').replaceWith(`<div class="form-group label-floating" id="niveau_scol_pere">
	 <label class="control-label m-label-form droid-arabic-kufi">مستواه الدراسي</label>
	 <input type="text" name="niveau_scol_pere_ar" value="`+data["niveau_scol_pere"]+`" class="form-control">
</div>`);

$('#nom_mere_ar').replaceWith(`<div class="form-group label-floating" id="nom_mere_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">الاسم </label>
	 <input type="text" name="nom_mere_ar" value="`+data["nom_mere"]+`" class="form-control">
</div>`);

$('#date_naiss_mere_hijri_ar').replaceWith(`<div class="form-group label-floating " id="date_naiss_mere_hijri_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_mere_hijri_ar" value="`+data["date_naiss_mere_hijri"]+" "+data["annee_naiss_mere_hijri"]+`" class="form-control">
</div>`);

$('#date_naiss_mere_miladi_ar').replaceWith(`<div class="form-group label-floating" id="date_naiss_mere_miladi_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية </label>
	 <input type="text" name="date_naiss_mere_miladi_ar" value="`+data["date_naiss_mere_miladi"]+" "+data["annee_naiss_mere_miladi"]+`" class="form-control">
</div>`);

$('#lieu_naiss_mere_ar').replaceWith(`<div class="form-group label-floating" id="lieu_naiss_mere_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد </label>
	 <input type="text" name="lieu_naiss_mere_ar" value="`+data["lieu_naiss_mere"]+`" class="form-control">
</div>`);

$('#nationalite_mere_ar').replaceWith(`<div class="form-group label-floating" id="nationalite_mere_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">الجنسية </label>
	 <input type="text" name="nationalite_mere_ar" value="`+data["nationalite_mere"]+`" class="form-control">
</div>`);

$('#profession_mere_ar').replaceWith(`<div class="form-group label-floating" id="profession_mere_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
	 <input type="text" name="profession_mere_ar" value="`+data["profession_mere"]+`" class="form-control">
</div>`);

$('#niveau_scol_mer_ar').replaceWith(`<div class="form-group label-floating" id="niveau_scol_mer_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">مستواها الدراسي </label>
	 <input type="text" name="niveau_scol_mer_ar" value="`+data["niveau_scol_mere"]+`" class="form-control">
</div>`);

$('#nationalite_mere_ar').replaceWith(`<div class="form-group label-floating" id="nationalite_mere_ar">
	 <label class="control-label m-label-form droid-arabic-kufi">الجنسية </label>
	 <input type="text" name="nationalite_mere_ar" value="`+data["nationalite_mere"]+`" class="form-control">
</div>`);

$('#ordre_naiss').replaceWith(`<div class="form-group label-floating" id="ordre_naiss">
	 <label class="control-label m-label-form droid-arabic-kufi">رتبة الولادة </label>
	 <input type="text" name="ordre_naiss" value="`+data["ordre_naiss"]+`" class="form-control">
</div>`);

$('#adresse_parent').replaceWith(`<div class="form-group label-floating" id="adresse_parent">
	 <label class="control-label m-label-form droid-arabic-kufi">القاطنان ب </label>
	 <input type="text" name="adresse_parent_ar" value="`+data["adresse_parent"]+`" class="form-control">
</div>`);

$('#selon').replaceWith(`<div class="form-group label-floating" id="selon">
	 <label class="control-label m-label-form droid-arabic-kufi">بناء على </label>
	 <input type="text" name="selon_ar" value="`+data["selon_annonceur"]+`" class="form-control">
</div>`);

$('#annonce_numero').replaceWith(`<div class="form-group label-floating" id="annonce_numero">
	 <label class="control-label m-label-form droid-arabic-kufi"> التصريح عدد</label>
	 <input type="text" name="annonce_numero" value="`+data["numero"]+`" class="form-control">
</div>`);

$('#age_annonceur').replaceWith(`<div class="form-group label-floating" id="age_annonceur">
	 <label class="control-label m-label-form droid-arabic-kufi">عمره </label>
	 <input type="text" name="age_num_ar" value="`+data["age_annonceur"]+`" class="form-control">
</div>`);

$('#adresse_annonceur').replaceWith(`<div class="form-group label-floating" id="adresse_annonceur">
	 <label class="control-label m-label-form droid-arabic-kufi">الساكن ب </label>
	 <input type="text" name="adresse_annonceur_ar" value="`+data["adresse_annonceur"]+`" class="form-control">
</div>`);

$('#date_annonce_hijri').replaceWith(`<div class="form-group label-floating " id="date_annonce_hijri">
	 <label class="control-label m-label-form droid-arabic-kufi"> بالأحرف العربية (هجري) </label>
	 <input type="text" name="date_annonce_hijri_ar" value="`+data["date_ecrit_hijri"]+" "+data["annee_ecrit_hijri"]+`"  class="form-control">
</div>`);

$('#date_annonce_miladi').replaceWith(`<div class="form-group label-floating" id="date_annonce_miladi">
	 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية (ميلادي)</label>
	 <input type="text" name="date_annonce_miladi_ar" value="`+data["date_ecrit_miladi"]+" "+data["annee_ecrit_miladi"]+`" class="form-control">
</div>`);

$('#officier_etat_civil').replaceWith(`<div class="form-group label-floating" id="officier_etat_civil">
	 <label class="control-label m-label-form m-input-fr droid-arabic-kufi">ضابط الحالة المدنية </label>
	 <input type="text" name="officier_etat_civil_ar" value="`+data["officier_etat_civil"]+`" class="form-control">
</div>`);



			$('#parentsModal').modal('hide');
			if(data["prenom_naiss"] != "" || data["nom_naiss"] != "")
				{
					$.notify({
        	icon: "notifications",
        	message: '<h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important"> تم إضافة البيانات </h6>'

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
        	message: ' <h6 class="droid-arabic-kufi" style="margin-right:5%;margin:0!important">فشل البحث </h6>'

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




///TASRIH DECES :////////////////////////////////////////////////////////////////////////////////////////////////////////
//SEARCH*************************
//form search Birth with numero
$('form.searchTasrihDNum').on('submit',function(){
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
			$('#divResultTasrihDeces').html(data);

			$("#tableTasrihDeces tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedTasrihDeces.php";
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
$('form.searchTasrihDName').on('submit',function(){
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
			$('#divResultTasrihDeces').html(data);

			$("#tableTasrihDeces tr").click(function(){
		   $(this).addClass('selected').siblings().removeClass('selected');
		   var value=$(this).find('td:first').html();
		   var value2=$(this).find('td:nth-child(2)').html();
		   var url = "selectedTasrihDeces.php";
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
$('form.tasrihDecesFormUpdate').on('submit',function(){
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
