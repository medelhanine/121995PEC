//search etat civil
$(document).ready(function(){
$('form.searchEtatCivil').on('submit',function(){
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
   if(data=="noDataFound")
     {
       swal({
              title: " لا توجد نتائج،المرجو التأكد من الرقم ",
              buttonsStyling: false,
              confirmButtonClass: "btn btn-success"
            });
     }
   else
     {
       window.location = "selectedEtatCivil.php?numero_etat_civil="+data;
     }
   }
});


return false;
});
});
