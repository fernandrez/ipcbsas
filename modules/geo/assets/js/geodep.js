$("#"+paisIdField).on('change',paisChanged);
$("#"+regionIdField).on('change',regionChanged);
if(paisId){getRegiones(paisId);}
if(regionId){getCiudades(regionId);}
function paisChanged(){
	paisId=$("#"+paisIdField).val();
	if(paisId){getRegiones(paisId);}
	else{$("#"+regionIdField).html('<p>Seleccione primero país</p>');}
}
function regionChanged(){
	regionId=$("#"+regionIdField).val();
	if(regionId){getCiudades(regionId);}
	else{$("#"+ciudadIdField).html('<p>Seleccione primero región</p>');}
}
function getRegiones(pais_id){
	$.ajax(
		{
			'url':regionesAjaxUrl,
			'success':function(data){$("#"+regionIdField).html(data);$("#"+regionIdField).val(regionId);},
			'error':function(a,b,c){alert(c);},
			'data':{'pais_id':pais_id}
		}
	);
}
function getCiudades(region_id){
	$.ajax(
		{
			'url':ciudadesAjaxUrl,
			'success':function(data){$("#"+ciudadIdField).html(data);$("#"+ciudadIdField).val(ciudadId);},
			'error':function(a,b,c){alert(c);},
			'data':{'region_id':region_id}
		}
	);
}