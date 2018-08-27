$(document).ready(function() {
  load_data();
  load_data_death();
  //SBirth datatables
  function load_data(
    is_gender,
    is_age_start,
    is_age_end,
    is_valid,
    is_annee,
    is_numero,
    is_prenom_ar,
    is_nom_ar,
    is_lieu_naiss,
    is_nom_mere,
    is_nom_pere,
    is_profession_pere,
    is_niveau_scol_pere,
    is_profession_mere,
    is_niveau_scol_mer,
    is_ordre_naiss,
    is_officier_etat_civil //function to filter data
  ) {
    var datatable = $("#datatables_sBirth").DataTable({
      columnDefs: [
        { width: "5%", targets: 0 },
        { width: "8%", targets: 1 },
        { width: "18%", targets: 2 },
        { width: "18%", targets: 3 },
        { width: "10%", targets: 4 }
      ],

      lengthChange: false,
      bPaginate: true,
      bFilter: true,
      bInfo: false,
      ordering: false,
      pageLength: 10,
      pagingType: "simple_numbers",
      language: {
        processing:
          "<img style='width:100px; height:100px;opacity : 0.8' src='assets/img/loader.gif' />",
        search: "_INPUT_",
        searchPlaceholder: "بحث",
        lengthMenu: "Aficher &nbsp&nbsp_MENU_ &nbsp linges par page",
        info: "page _PAGE_ sur _PAGES_ - _MAX_ lignes",
        emptyTable: "لا توجد نتائج",
        paginate: {
          previous: "<div class='droid-arabic-kufi'> السابقة </div>",
          next: "<div class='droid-arabic-kufi'> التالية </div>",
          first: "<div class='droid-arabic-kufi'> الأولى </div>",
          last: "<div class='droid-arabic-kufi'> الأخيرة </div> "
        }
      },

      processing: true,
      serverSide: true,
      ajax: {
        url: "filterDB.php",
        type: "post",
        crossDomain: true,
        data: {
          is_gender: is_gender,
          is_age_start: is_age_start,
          is_age_end: is_age_end,
          is_valid: is_valid,
          is_annee: is_annee,
          is_numero: is_numero,
          is_prenom_ar: is_prenom_ar,
          is_nom_ar: is_nom_ar,
          is_lieu_naiss: is_lieu_naiss,
          is_nom_mere: is_nom_mere,
          is_nom_pere: is_nom_pere,
          is_profession_pere: is_profession_pere,
          is_niveau_scol_pere: is_niveau_scol_pere,
          is_profession_mere: is_profession_mere,
          is_niveau_scol_mer: is_niveau_scol_mer,
          is_ordre_naiss: is_ordre_naiss,
          is_officier_etat_civil: is_officier_etat_civil
        },
        dataFilter: function(response) {
          // console.log(response+"////////////////////////////////////////////////////////////////////////////");
          // this to see what exactly is being sent back
          $("#datatables_sBirth tbody").on("click", "tr", function() {
            var data = datatable.row(this).data();
            var numero = data[0].substring(
              data[0].lastIndexOf("em") + 5,
              data[0].lastIndexOf("</")
            );
            var annee = data[1].substring(
              data[1].lastIndexOf("em") + 5,
              data[1].lastIndexOf("</")
            );
            window.location.href =
              "selectedBirth.php?numero=" + numero + "&annee=" + annee;
            //var folder  = "solbBirth";
            //var table = "sbirth";
            //send data for search scans of the clicked row
            /*  $.ajax({
          		url :"filterInfoDB.php",
          		type:"POST",
          		data:{"numero":numero,"annee":annee,"table":table,"folder":folder},
          		success: function(data){
          			//console.log(data);
                $("#scans").html(data);
          		}
          	});*/
          });
          return response;
        }
      }
    });
  } //end filter function
  var gender = $("#gender").val("all");
  var age_start = $("#age_start").val("all");
  var age_end = $("#age_end").val("all");
  var validate = $("#validate").val("all");
  var annee = $("#annee").val("all");

  var numero = $("#numero").val("all");
  var prenom_ar = $("#prenom_ar").val("all");
  var nom_ar = $("#nom_ar").val("all");
  var lieu_naiss = $("#lieu_naiss").val("all");
  var nom_mere = $("#nom_mere").val("all");
  var nom_pere = $("#nom_pere").val("all");
  var profession_pere = $("#profession_pere").val("all");
  var niveau_scol_pere = $("#niveau_scol_pere").val("all");
  var profession_mere = $("#profession_mere").val("all");
  var niveau_scol_mer = $("#niveau_scol_mer").val("all");
  var ordre_naiss = $("#ordre_naiss").val("all");
  var officier_etat_civil = $("#officier_etat_civil").val("all");
  $(document).on(
    "change",
    "#gender,#age_start,#age_end,#validate,#annee,#numero,#prenom_ar,#nom_ar,#lieu_naiss,#nom_pere,#profession_pere,#niveau_scol_pere,#profession_mere,#niveau_scol_mer,#nom_mere,#ordre_naiss,#officier_etat_civil",
    function() {
      gender = $("#gender").val();
      age_start = $("#age_start").val();
      age_end = $("#age_end").val();
      validate = $("#validate").val();
      annee = $("#annee").val();

      numero = $("#numero").val();
      prenom_ar = $("#prenom_ar").val();
      nom_ar = $("#nom_ar").val();
      lieu_naiss = $("#lieu_naiss").val();
      nom_mere = $("#nom_mere").val();
      nom_pere = $("#nom_pere").val();
      profession_pere = $("#profession_pere").val();
      niveau_scol_pere = $("#niveau_scol_pere").val();
      profession_mere = $("#profession_mere").val();
      niveau_scol_mer = $("#niveau_scol_mer").val();
      ordre_naiss = $("#ordre_naiss").val();
      officier_etat_civil = $("#officier_etat_civil").val();
      $("#datatables_sBirth")
        .DataTable()
        .destroy();
      if (
        gender != "" &&
        age_start != "" &&
        age_end != "" &&
        validate != "" &&
        annee != "" &&
        numero != "" &&
        prenom_ar != "" &&
        nom_ar != "" &&
        lieu_naiss != "" &&
        nom_pere != "" &&
        profession_pere != "" &&
        niveau_scol_pere != "" &&
        profession_mere != "" &&
        niveau_scol_mer != "" &&
        nom_mere != "" &&
        ordre_naiss != "" &&
        officier_etat_civil != ""
      ) {
        load_data(
          gender,
          age_start,
          age_end,
          validate,
          annee,
          numero,
          prenom_ar,
          nom_ar,
          lieu_naiss,
          nom_mere,
          nom_pere,
          profession_pere,
          niveau_scol_pere,
          profession_mere,
          niveau_scol_mer,
          ordre_naiss,
          officier_etat_civil
        );
      } else {
        load_data();
      }
    }
  );

  //SDEATH DATATABLES**********************************************************************************************
  function load_data_death(
    is_gender,
    is_age_start,
    is_age_end,
    is_annee,
    is_numero,
    is_prenom_ar,
    is_nom_ar,
    is_lieu_naiss,
    is_lieu_deces,
    is_nom_mere,
    is_nom_pere,
    is_profession_pere,
    is_profession_mere,
    is_officier_etat_civil //function to filter data
  ) {
    var datatable = $("#datatables_sDeath").DataTable({
      lengthChange: false,
      bPaginate: true,
      bFilter: true,
      bInfo: false,
      ordering: false,
      pageLength: 10,
      pagingType: "simple_numbers",
      language: {
        processing:
          "<img style='width:100px; height:100px;' src='assets/img/loader.gif' />",
        search: "_INPUT_",
        searchPlaceholder: "بحث",
        lengthMenu: "Aficher &nbsp&nbsp_MENU_ &nbsp linges par page",
        info: "page _PAGE_ sur _PAGES_ - _MAX_ lignes",
        emptyTable: "لا توجد نتائج",
        paginate: {
          previous: "<div class='droid-arabic-kufi'> السابقة </div>",
          next: "<div class='droid-arabic-kufi'> التالية </div>",
          first: "<div class='droid-arabic-kufi'> الأولى </div>",
          last: "<div class='droid-arabic-kufi'> الأخيرة </div> "
        }
      },

      processing: true,
      serverSide: true,
      ajax: {
        url: "filterDB_death.php",
        type: "post",
        crossDomain: true,
        data: {
          is_gender: is_gender,
          is_age_start: is_age_start,
          is_age_end: is_age_end,

          is_annee: is_annee,
          is_numero: is_numero,
          is_prenom_ar: is_prenom_ar,
          is_nom_ar: is_nom_ar,
          is_lieu_naiss: is_lieu_naiss,
          is_lieu_deces: is_lieu_deces,
          is_nom_mere: is_nom_mere,
          is_nom_pere: is_nom_pere,
          is_profession_pere: is_profession_pere,
          is_profession_mere: is_profession_mere,

          is_officier_etat_civil: is_officier_etat_civil
        },
        dataFilter: function(response) {
          // console.log(response+"////////////////////////////////////////////////////////////////////////////");
          // this to see what exactly is being sent back
          $("#datatables_sDeath tbody").on("click", "tr", function() {
            var data = datatable.row(this).data();
            var numero = data[0].substring(
              data[0].lastIndexOf("em") + 5,
              data[0].lastIndexOf("</")
            );
            var annee = data[1].substring(
              data[1].lastIndexOf("em") + 5,
              data[1].lastIndexOf("</")
            );
            window.location.href =
              "selectedDeath.php?numero=" + numero + "&annee=" + annee;
            //var folder  = "solbBirth";
            //var table = "sbirth";
            //send data for search scans of the clicked row
            /*  $.ajax({
          		url :"filterInfoDB.php",
          		type:"POST",
          		data:{"numero":numero,"annee":annee,"table":table,"folder":folder},
          		success: function(data){
          			//console.log(data);
                $("#scans").html(data);
          		}
          	});*/
          });
          return response;
        }
      }
    });
  } //end filter function
  var gender = $("#gender_death").val("all");
  var age_start = $("#age_start_death").val("all");
  var age_end = $("#age_end_death").val("all");

  var annee = $("#annee_death").val("all");
  var numero = $("#numero_death").val("all");
  var prenom_ar = $("#prenom_ar_death").val("all");
  var nom_ar = $("#nom_ar_death").val("all");
  var lieu_naiss = $("#lieu_naiss_death").val("all");
  var lieu_deces = $("#lieu_deces_death").val("all");
  var nom_mere = $("#nom_mere_death").val("all");
  var nom_pere = $("#nom_pere_death").val("all");
  var profession_pere = $("#profession_pere_death").val("all");
  var profession_mere = $("#profession_mere_death").val("all");
  var officier_etat_civil = $("#officier_etat_civil_death").val("all");

  $(document).on(
    "change",
    "#gender_death,#age_start_death,#age_end_death,#validate_death,#annee_death,#numero_death,#prenom_ar_death,#nom_ar_death,#lieu_naiss_death,#lieu_deces_death,#nom_pere_death,#profession_pere_death,#niveau_scol_pere_death,#profession_mere_death,#niveau_scol_mer_death,#nom_mere_death,#officier_etat_civil_death",
    function() {
      gender = $("#gender_death").val();
      age_start = $("#age_start_death").val();
      age_end = $("#age_end_death").val();
      validate = $("#validate_death").val();
      annee = $("#annee_death").val();

      numero = $("#numero_death").val();
      prenom_ar = $("#prenom_ar_death").val();
      nom_ar = $("#nom_ar_death").val();
      lieu_naiss = $("#lieu_naiss_death").val();
      lieu_deces = $("#lieu_deces_death").val();
      nom_mere = $("#nom_mere_death").val();
      nom_pere = $("#nom_pere_death").val();
      profession_pere = $("#profession_pere_death").val();
      profession_mere = $("#profession_mere_death").val();
      officier_etat_civil = $("#officier_etat_civil_death").val();

      $("#datatables_sBirth")
        .DataTable()
        .destroy();
      if (
        gender != "" &&
        age_start != "" &&
        age_end != "" &&
        annee != "" &&
        numero != "" &&
        prenom_ar != "" &&
        nom_ar != "" &&
        lieu_naiss != "" &&
        lieu_deces != "" &&
        nom_pere != "" &&
        profession_pere != "" &&
        profession_mere != "" &&
        nom_mere != "" &&
        officier_etat_civil != ""
      ) {
        load_data(
          gender,
          age_start,
          age_end,
          annee,
          numero,
          prenom_ar,
          nom_ar,
          lieu_naiss,
          lieu_deces,
          nom_mere,
          nom_pere,
          profession_pere,
          profession_mere,
          officier_etat_civil
        );
      } else {
        load_data();
      }
    }
  );

  $(".card .material-datatables label").addClass("form-group");
});
