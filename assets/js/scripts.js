/// <reference path="../../typings/globals/jquery/index.d.ts" />
// PRECIOS

$(".numero").number(true,2);

function scroll_to_class(element_class, removed_height) {
	var scroll_to = $(element_class).offset().top - removed_height;
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 0);
	}
}

$(".imgbotones").click(function(){
    var valor = this.id;
     $("#listadistrito").empty();
     $("#listatiendas").empty();
      $("#listatiendas").append('<option value="">Seleccione...</option>');
    $.ajax({
        method:'POST',
        url: 'conexion/funciones.php',
        dataType: 'json',
        data: {'banner' : valor, 'entrada':'verDistrito'},
        success : function(respuesta){
            // console.log(respuesta);
            $("#listadistrito").append('<option value="">Seleccione...</option>');
            $.each(respuesta,function(index,value){
                $("#listadistrito").append('<option value="'+value['id']+'">'+value['dsc_ubicacion']+'</option>');
            });//each
        }//success
    });//ajax
    $("#listatiendas").trigger('change');
});

function buscaTienda(){
    var valor = $("#listadistrito").val();
    $("#categoriastiendas").val();
    $("#listatiendas").empty();
    $.ajax({
        method:'POST',
        url: 'conexion/funciones.php',
        dataType: 'json',
        data: {'distrito' : valor, 'entrada':'verTiendas'},
        success : function(respuesta){
            $("#listatiendas").append('<option value="">Seleccione...</option>');
            $.each(respuesta,function(index,value){
                $("#listatiendas").append('<option value="'+value['id']+'">'+value['dsc_tienda']+'</option>');
            });//each
        }//success
    });//ajax
}

$("#categoriastiendas").change(function(){
    var tienda = $("#listatiendas").find(":selected").text();
    var valor = $("#listatiendas").val();
    var categoria = $(this).find(":selected").text();
    $("#tienda3stg").text(tienda);
    $("#categoria3stg").text(categoria);
    $("#categoria5stg").text(categoria);
    $("#categoria6stg").text(categoria);
    $("#containerProp4stg").empty();
    $.ajax({
        method:'POST',
        url: 'conexion/funciones.php',
        dataType: 'json',
        data: {'tienda' : valor, 'entrada':'stg4Propios'},
        success : function(respuesta){
            // console.log(respuesta);
            $.each(respuesta,function(index,value){
                $("#containerProp4stg").append(
                    '<div class="row">'+
                        '<div class="contador col-2 col-md-2">'+
                            '<label for="">'+(index+1)+'.</label>'+
                          '</div>'+
                          '<div class="col-10 col-md-6">'+
                              '<label for="nombreprod">'+value['dsc_producto']+'</label>'+
                          '</div>'+
                          '<div class="input-group mb-3 col-8 col-md-4">'+
                            '<div class="input-group-prepend">'+
                              '<span class="input-group-text">S/</span>'+
                            '</div>'+
                            '<input type="text" class="form-control numero" id="precio_top_'+(index+1)+'" name="precio_top_'+(index+1)+'" maxlength="10" placeholder="Precio" aria-label="Amount (to the nearest dollar)" onchange="formateonum(this);" >'+
                          '</div>'+
                          '<input type="hidden" name="id_prod_prec_top_'+(index+1)+'" value="'+value['id_producto']+'">'+
                      '</div>');//append
            });//each
        }//success
    });//ajax
    $("#containerComp4stg").empty();
    $.ajax({
        method:'POST',
        url: 'conexion/funciones.php',
        dataType: 'json',
        data: {'tienda' : valor, 'entrada':'stg4Comp'},
        success : function(respuesta){
            // console.log(respuesta);
            $.each(respuesta,function(index,value){
                $("#containerComp4stg").append(
                    '<div class="row">'+
                        '<div class="contador col-2 col-md-2">'+
                            '<label for="">'+(index+1)+'.</label>'+
                          '</div>'+
                          '<div class="col-10 col-md-6">'+
                              '<label for="nombreprod">'+value['dsc_competencia']+'</label>'+
                          '</div>'+
                          '<div class="input-group mb-3 col-8 col-md-4">'+
                            '<div class="input-group-prepend">'+
                              '<span class="input-group-text">S/</span>'+
                            '</div>'+
                            '<input type="hidden" name="id_comp_prec_top_'+(index+1)+'" value="'+value['id']+'">'+
                            '<input type="text" class="form-control numero" id="precio_top_comp_'+(index+1)+'" name="precio_top_comp_'+(index+1)+'" placeholder="Precio" maxlength="10" aria-label="Amount (to the nearest dollar)">'+
                          '</div>'+
                      '</div>');//append
            });//each
        }//success
    });//ajax
    $("#containerProp5stg").empty();
    $.ajax({
        method:'POST',
        url: 'conexion/funciones.php',
        dataType: 'json',
        data: {'tienda' : valor, 'entrada':'stg5Prop'},
        success : function(respuesta){
            // console.log(respuesta);
            $.each(respuesta,function(index,value){
                $("#containerProp5stg").append(
                    '<div class="row">'+
                        '<div class="contador col-1 col-md-2">'+
                          '<label for="">'+(index+1)+'.</label>'+
                        '</div>'+
                       ' <div class="radio col-2 col-md-3">'+
                          '<div class="form-check form-check-inline">'+
                            '<input class="form-check-input radio_vis" type="radio" name="radio_vis_'+(index+1)+'" id="radio_vis_'+(index+1)+'" value="SI" onclick="cargaArchivos(this);"/>'+
                            '<label class="form-check-label" for="radio_vis_'+(index+1)+'">Si</label>'+
                          '</div>'+
                          '<div class="form-check form-check-inline">'+
                            '<input class="form-check-input radio_vis" type="radio" name="radio_vis_'+(index+1)+'" id="radio_vis_'+(index+1)+'" value="NO"  onclick="cargaArchivos(this);"/>'+
                            '<label class="form-check-label" for="radio_vis_'+(index+1)+'">No</label>'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-8 col-md-6">'+
                          '<label for="nombreprod" placeholder="Descripcion">'+value['dsc_exhibicion']+' de '+value['dsc_producto']+'</label>'+
                        '</div>'+
                        '<div class="input-group col-2 col-md-4">'+
                          '<label for="prop_vis1_'+(index+1)+'" class="btn btn-sm btn-primary" id="label_prop_vis1_'+(index+1)+'" hidden>'+
                            '<i class="bx bx-upload" id="texto_prop_vis1_'+(index+1)+'"> Cargar</i>'+
                            '<input id="prop_vis1_'+(index+1)+'" onClick="btncargavis1part(this);" class="form-control-file btnCarga" type="file" accept=".jpeg, .jpg, .png" name="prop_vis_'+(index+1)+'" hidden />'+
                            '</label>'+
                        '</div>'+
                        '<input type="hidden" name="id_produc_prop_vis_'+(index+1)+'" value="'+value['id_producto']+'">'+
                        '<input type="hidden" name="id_elemento_vis_'+(index+1)+'" value="'+value['id_exhibicion']+'">'+
                      '</div>');//append
            });//each
        }//success
    });//ajax
    $("#containerProp6stg").empty();
    $.ajax({
        method:'POST',
        url: 'conexion/funciones.php',
        dataType: 'json',
        data: {'tienda' : valor, 'entrada':'stg6Prop'},
        success : function(respuesta){
            // console.log(respuesta);
            $.each(respuesta,function(index,value){
                $("#containerProp6stg").append(
                    '<div class="row" style="margin-bottom: 0.5rem;">'+
                        '<div class="contador col-1">'+
                            '<label for="">'+(index+1)+'.</label>'+
                        '</div>'+
                        '<div class="radio2 col-3 col-md-3">'+
                            '<div class= "form-check form-check-inline" >'+
                                '<input class= "form-check-input radio2_vis" type= "radio" name= "radio_EXH_'+(index+1)+'" id= "radio_EXH_'+(index+1)+'" value= "SI" onClick="cargaArchivosEx(this);">'+
                                '<label class= "form-check-label" for= "radio_EXH_'+(index+1)+'" >Si</label>'+
                            '</div> '+
                            '<div class= "form-check form-check-inline" >'+
                                '<input class= "form-check-input radio_EXH" type= "radio" name= "radio_EXH_'+(index+1)+'" id= "radio_EXH_'+(index+1)+'" value= "NO" onClick="cargaArchivosEx(this);">'+
                                '<label class= "form-check-label" for= "radio2_vis_'+(index+1)+'" >No</label>'+
                            '</div> '+
                        '</div>'+
                            '<label for="my-input" class="col-7 col-sm-4 txelem">'+value['dsc_exhibicion']+' de '+value['dsc_producto']+'</label>'+
                          '<div class="container col-7 col-md-3" style="margin: 0rem 0rem 0rem 3rem;">'+
                            '<div class="input-group">'+
                              '<div class="input-group-prepend suiche21">'+
                                  '<span class="input-group-text " id="my-addon">S/</span>'+
                              '</div>'+
                              '<input class="form-control suiche21" type="text" id="precio_prop_'+(index+1)+'" name="precio_prop_'+(index+1)+'" placeholder="Precio" aria-label="Recipients " aria-describedby="my-addon">'+
                            '</div>'+
                          '</div>'+
                       ' <div class="input-group col-2 col-md-2">'+
                           ' <label for="prop2_EXH_'+(index+1)+'" class="btn btn-sm btn-primary" id="label_prop2_EXH_'+(index+1)+'" hidden><i class="bx bx-upload" id="texto_prop2_EXH_'+(index+1)+'"> Cargar</i><input id="prop2_EXH_'+(index+1)+'" onClick="btncargaex1part(this);" class="form-control-file btnCarga" type="file" accept=".jpeg, .jpg, .png" name="prop2_EXH_'+(index+1)+'" hidden>'+
                           '</label>'+
                        '</div>'+
                        '<input type="hidden" name="id_produc_prop_exh_'+(index+1)+'" value="'+value['id_producto']+'">'+
                        '<input type="hidden" name="id_elemento_exh_'+(index+1)+'" value="'+value['id_exhibicion']+'">'+
                    '</div>');//append
            });//each
        }//success
    });//ajax
});

function bar_progress(progress_line_object, direction) {
	var number_of_steps = progress_line_object.data('number-of-steps');
	var now_value = progress_line_object.data('now-value');
	var new_value = 0;
	if(direction == 'right') {
		new_value = now_value + ( 100 / number_of_steps );
	}
	else if(direction == 'left') {
		new_value = now_value - ( 100 / number_of_steps );
	}
	progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}

jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    // $.backstretch("assets/img/backgrounds/1.jpg");
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*
        Form
    */
    $('.f1 fieldset:first').fadeIn('slow');
    
    $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    // next step
    $('.f1 .btn-next').on('click', function() {
    	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    	
    	// fields validation
    	parent_fieldset.find('input[type="text"], input[type="password"], textarea, select').each(function() {
    		if( $(this).val() == "" ) {
    			$(this).addClass('input-error');
    			next_step = false;
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation
      
      // parent_fieldset.find('input[type="text"], input[type="password"], textarea').each(function() {
    	// 	if( $(this).val() == "" ) {
    	// 		$(this).addClass('input-error');
    	// 		next_step = false;
    	// 	}
    	// 	else {
    	// 		$(this).removeClass('input-error');
    	// 	}
    	// });      
    	if( next_step ) {
    		parent_fieldset.fadeOut(400, function() {
    			// change icons
    			current_active_step.removeClass('active').addClass('activated').next().addClass('active');
    			// progress bar
    			bar_progress(progress_line, 'right');
    			// show next step
	    		$(this).next().fadeIn();
	    		// scroll window to beginning of the form
    			scroll_to_class( $('.f1'), 20 );
	    	});
    	}
    	
    });
    
    // previous step
    $('.f1 .btn-previous').on('click', function() {
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    	
    	$(this).parents('fieldset').fadeOut(400, function() {
    		// change icons
    		current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
    		// progress bar
    		bar_progress(progress_line, 'left');
    		// show previous step
    		$(this).prev().fadeIn();
    		// scroll window to beginning of the form
			scroll_to_class( $('.f1'), 20 );
    	});
    });
    
    // // submit
    $('.f1').on('submit', function(e) {
    	
    	// fields validation
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function() {
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation
    	
    });
       
});

// añadir en visibilidad

function cargaArchivos(obj){
    var id= obj.id;
    var valor = obj.value;
    var aux = id.split('_')[2];
    // console.log('id',id);
    // console.log('valor',valor);
    // console.log('aux',aux);
    if(valor == 'SI'){
        // $('#label_prop_vis1_'+aux).removeClass('btn-secondary');
        // $('#label_prop_vis1_'+aux).removeClass('btn-light');
        // $('#label_prop_vis1_'+aux).addClass('btn-primary');
        // $('#texto_prop_vis1_'+aux).removeClass('bx-refresh');
        // $('#texto_prop_vis1_'+aux).addClass('bx-upload');
        // $("#prop_vis1_"+aux).prop('disabled',false);
        $("#label_prop_vis1_"+aux).prop('hidden',false);
    }else{
        // $('#label_prop_vis1_'+aux).removeClass('btn-primary');
        // $('#label_prop_vis1_'+aux).addClass('btn-light');
        // $("#prop_vis1_"+aux).prop('disabled',true);
        // $('#texto_prop_vis1_'+aux).html(' Cargar');
        // $('#texto_prop_vis1_'+aux).removeClass('bx-upload');
        // $('#texto_prop_vis1_'+aux).addClass('bx-refresh');
        // $("#prop_vis1_"+aux).val();
        $("#label_prop_vis1_"+aux).prop('hidden',true);
    }
    // console.log(aux);
}

function borrarFila(compo){
    Swal.fire({
      title: '',
      text: "¿Eliminar fila?",
      showCancelButton: true,
      type: "question",
      showCancelButton:!0,
      confirmButtonText: "Si",
      cancelButtonText:"No"
    }).then((result) => {
      if (result.value) { 
        $(compo).parents('div .filit').remove();
        var cant = $(".bloqueform2 .filit").length;
        if ((cant) < 5) {
            $(".btn-anadir").prop('hidden',false);
        }
      }
    })
}

$(".btn-anadir").on('click',function(){
    var cant = $(".bloqueform2 .filit").length;
    var fila = '<div class="filit">'+
                  '<div class="row">'+
                        '<div class="col-6 col-lg-4">'+
                          '<input class="form-control texto" placeholder="Descripcion" type="text" name="InpEdvBf2_'+(cant+1)+'">'+
                        '</div>'+
                        '<div class="col-6 col-lg-4 selec">'+
                          '<select id="SelEdvBf2_'+(cant+1)+'" class="custom-select suiche2" name="SelEdvBf2_'+(cant+1)+'">'+
                            '<option value="">Seleccione...</option>'+
                            '<option value="5">Jalavistas</option>'+
                            '<option value="6">Marco de góndola</option>'+
                          '</select>'+
                        '</div>'+
                        '<div class="input-group btn-group btncargaizq col-6 col-md-6 col-lg-2">'+
                          '<label for="carga_'+(cant+1)+'" class="btn btn-sm upcarga btn-primary" id="label_carga_'+(cant+1)+'"><i class="bx bx-upload" id="texto_carga_'+(cant+1)+'"> Cargar</i><input id="carga_'+(cant+1)+'" name="carga_'+(cant+1)+'" onClick="btnCargavis(this);" class="form-control-file btnCarga" type="file" accept=".jpeg, .jpg, .png" hidden></label>'+
                        '</div>'+
                        '<div class="input-group btn-group btncargader col-6 col-md-6 col-lg-2">'+
                          '<label class="btn btn-sm btn-danger bx bxs-x-circle " for="borrarFila_'+(cant+1)+'"> Borrar<button id="borrarFila_'+(cant+1)+'"  type="button" onclick="borrarFila(this);" hidden></button></label>'+
                        '</div>'+  
                    '</div>'+
                '</div>';
    document.getElementById("bloqueform2").insertAdjacentHTML("beforeEnd" ,fila);
    if ((cant+1) >= 5) {
        $(".btn-anadir").prop('hidden',true);
    }
});

// fin añadir visibilidad
// cambio de boton en visibilidad segunda parte
// $(".btnCarga").on('click',function(){
//     var id = this.id;
//     console.log(this.value);
//     if(this.value == ''){
//       console.log(id);
      
//         $('#label_'+id).removeClass('btn-primary');
//         $('#label_'+id).addClass('btn-outline-secondary');
//         $('#texto_'+id).removeClass('bx-upload');
//         $('#texto_'+id).addClass('bx-refresh');
//         $('#texto_'+id).html(' Remplazar');
//     }
// });


function btncargavis1part(obj) {
  var id = obj.id;
  var valor = obj.value;
  // console.log('id',id);
  // console.log('ruta',valor);
  if(valor == ''){
    $('#label_'+id).removeClass('btn-primary');
    $('#label_'+id).addClass('btn-outline-secondary');
    $('#texto_'+id).removeClass('bx-upload');
    $('#texto_'+id).addClass('bx-refresh');
    $('#texto_'+id).html(' Remplazar');
}
  
}




function btnCargavis(obj) {
  var id = obj.id;
  var valor = obj.value;
  // var aux = id.split('_')[1];
  // console.log('id',id);
  // console.log('aux', aux);
  // console.log('ruta',valor);
  if(valor == ''){
    $('#label_'+id).removeClass('btn-primary');
    $('#label_'+id).addClass('btn-outline-secondary');
    $('#texto_'+id).removeClass('bx-upload');
    $('#texto_'+id).addClass('bx-refresh');
    $('#texto_'+id).html(' Remplazar');
}
  
}




// fin cambio de boton visibilidad




// exhibiciones
// parte1

function btncargaex1part(obj) {
  var id = obj.id;
  var valor = obj.value;
  console.log('idboton',id);
  console.log('rutaboton',valor);
  if(valor == ''){
    $('#label_'+id).removeClass('btn-primary');
    $('#label_'+id).addClass('btn-outline-secondary');
    $('#texto_'+id).removeClass('bx-upload');
    $('#texto_'+id).addClass('bx-refresh');
    $('#texto_'+id).html(' Remplazar');
}
  
}

function cargaArchivosEx(obj){
  var id= obj.id;
  var valor = obj.value;
  var aux = id.split('_')[2];
  console.log('idradio',id);
  console.log('valorradio',valor);
  console.log('auxradio',aux);
  if(valor == 'SI'){
      // $('#label_prop_vis1_'+aux).removeClass('btn-secondary');
      // $('#label_prop_vis1_'+aux).removeClass('btn-light');
      // $('#label_prop_vis1_'+aux).addClass('btn-primary');
      // $('#texto_prop_vis1_'+aux).removeClass('bx-refresh');
      // $('#texto_prop_vis1_'+aux).addClass('bx-upload');
      // $("#prop_vis1_"+aux).prop('disabled',false);
      $("#label_prop2_EXH_"+aux).prop('hidden',false);
  }else{
      // $('#label_prop_vis1_'+aux).removeClass('btn-primary');
      // $('#label_prop_vis1_'+aux).addClass('btn-light');
      // $("#prop_vis1_"+aux).prop('disabled',true);
      // $('#texto_prop_vis1_'+aux).html(' Cargar');
      // $('#texto_prop_vis1_'+aux).removeClass('bx-upload');
      // $('#texto_prop_vis1_'+aux).addClass('bx-refresh');
      // $("#prop_vis1_"+aux).val();
      $("#label_prop2_EXH_"+aux).prop('hidden',true);
  }
  // console.log(aux);
}

// parte 2

function btncargaex2part(obj) {
  var id = obj.id;
  var valor = obj.value;
  console.log('idboton',id);
  console.log('rutaboton',valor);
  if(valor == ''){
    $('#label_'+id).removeClass('btn-primary');
    $('#label_'+id).addClass('btn-outline-secondary');
    $('#texto_'+id).removeClass('bx-upload');
    $('#texto_'+id).addClass('bx-refresh');
    $('#texto_'+id).html(' Remplazar');
}
  
}


$(".btnCarga2").on('click',function(){
  var id = this.id;
  console.log(this.value);
  console.log(id);
    if(this.value == ''){
        $('#label2_'+id).removeClass('btn-primary');
        $('#label2_'+id).addClass('btn-outline-secondary');
        $('#texto2_'+id).removeClass('bx-upload');
        $('#texto2_'+id).addClass('bx-refresh');
        $('#texto2_'+id).html(' Remplazar');
    }
    // alert(this.id);
});

function radio(a) {
  var id= a.id;
  var valor= a.value;
  var aux = id.split('_')[2];
  console.log(id);
  console.log(valor);
  console.log(aux);
  if(valor == 'option1'){
    $('#label2_prop_vis_'+aux).removeClass('btn-secondary');
    $('#label2_prop_vis_'+aux).removeClass('btn-light');
    $('#label2_prop_vis_'+aux).addClass('btn-primary');
    $('#texto2_prop_vis_'+aux).removeClass('bx-refresh');
    $('#texto2_prop_vis_'+aux).addClass('bx-upload');
    $("#prop2_vis_"+aux).prop('disabled',false);
    $("#label2_prop_vis_"+aux).prop('hidden',false);
    
}else{
    $('#label2_prop_vis_'+aux).removeClass('btn-primary');
    $('#label2_prop_vis_'+aux).addClass('btn-light');
    $("#prop2_vis_"+aux).prop('disabled',true);
    $('#texto_prop2_vis_'+aux).html(' Cargar');
    $('#texto_prop2_vis_'+aux).removeClass('bx-upload');
    $('#texto2_prop_vis_'+aux).addClass('bx-refresh');
    $("#prop2_vis_"+aux).val();
    $("#label2_prop_vis_"+aux).prop('hidden',true);
}
  
};

// function activafile(a){
//   var id= a.id;
//   console.log(id);
//   var aux = id.split('_')[3];
//   console.log(aux);
//   $("#prop2_vis_"+aux).on('click',
//   $('#texto2_prop_vis_'+aux).append(
//         '<input id="prop2_vis_'+aux+'" class="form-control-file btnCarga" type="file" accept=".jpeg, .jpg, .png" name="prop2_vis_'+aux+'" hidden></label>'
//       ),
//       $("#prop2_vis_"+aux).trigger('click')

//   );
// }

$(".radio2_vis").on('click',function(){
    var id = this.id;
    var valor = this.value;
    aux = id.split('_')[2]
    if(valor == 'option1'){
        $('#label2_prop_vis_'+aux).removeClass('btn-secondary');
        $('#label2_prop_vis_'+aux).removeClass('btn-light');
        $('#label2_prop_vis_'+aux).addClass('btn-primary');
        $('#texto2_prop_vis_'+aux).removeClass('bx-refresh');
        $('#texto2_prop_vis_'+aux).addClass('bx-upload');
        $("#prop2_vis2_"+aux).prop('disabled',false);
        $("#label2_prop_vis_"+aux).prop('hidden',false);
    }else{
        $('#label2_prop_vis_'+aux).removeClass('btn-primary');
        $('#label2_prop_vis_'+aux).addClass('btn-light');
        $("#prop2_vis_"+aux).prop('disabled',true);
        $('#texto_prop2_vis_'+aux).html(' Cargar');
        $('#texto_prop2_vis_'+aux).removeClass('bx-upload');
        $('#texto2_prop_vis_'+aux).addClass('bx-refresh');
        $("#prop2_vis_"+aux).val();
        $("#label2_prop_vis_"+aux).prop('hidden',true);
    }
  // console.log(aux);
  // console.log(valor);
});

function borrarFila2(compo){
    Swal.fire({
      title: '',
      text: "¿Eliminar fila?",
      showCancelButton: true,
      type: "question",
      showCancelButton:!0,
      confirmButtonText: "Si",
      cancelButtonText:"No"
    }).then((result) => {
      if (result.value) { 
        $(compo).parents('div .filit2').remove();
        var cant = $(".bloqueform3 .filit2").length;
        if ((cant) < 5) {
            $(".btn-anadir2").prop('hidden',false);
        }
      }
    })
}

// segunda parte de exhibiciones////////////////////////////////////////////


$(".btn-anadir2").on('click',function(){
    var cant = $(".bloqueform3 .filit2").length;
    var fila = '<div class="filit2">'+
          '<div class="col-12">'+(cant+1)+'.</div>'+
          '<div class="row" style="padding-top: 1rem;">'+
              '<div class="col-6 col-lg-6 txtex">'+
                '<input class="form-control texto2" placeholder="Descripción" type="text" name="InpEdvBf3_'+(cant+1)+'" id="InpEdvBf3_'+(cant+1)+'">'+ 
              '</div>'+
              '<div class="col-6 col-lg-6 selec">'+
                '<select id="SelEdvBf3_'+(cant+1)+'" class="custom-select suiche2" name="SelEdvBf3_'+(cant+1)+'">'+
                  '<option value="">Seleccione...</option>'+
                  '<option value="1">Cabecera</option>'+
                  '<option value="2">Ruma</option>'+
                  '<option value="3">Lateral</option>'+
                  '<option value="4">Cabeceras checkout</option>'+
                '</select>'+
              '</div>'+
              '<div class="input-group precioex col-12 col-lg-6">'+
                  '<div class="input-group-prepend suiche21">'+
                      '<span class="input-group-text " id="my-addon">S/</span>'+
                  '</div>'+
                  '<input class="form-control suiche21" type="text" id="preEdvComp_'+(cant+1)+'" name="preEdvComp_'+(cant+1)+'" placeholder="Precio" aria-label="Recipient" aria-describedby="my-addon">'+
              '</div>'+
              '<div class="input-group btn-group btncargaizq col-6 col-lg-3">'+
                  '<label for="carga2_'+(cant+1)+'" class="btn btn-sm upcarga btn-primary" id="label_carga2_'+(cant+1)+'"><i class="bx bx-upload" id="texto_carga2_'+(cant+1)+'"> Cargar</i>'+
                  '<input id="carga2_'+(cant+1)+'" onClick="btncargaex2part(this);" class="form-control-file btnCarga2" type="file" accept=".jpeg, .jpg, .png" name="carga2_'+(cant+1)+'" hidden />'+
                      '</label>'+
                '</div>'+
                '<div class="input-group btn-group btncargader col-6 col-lg-3">'+
                  '<label class="btn btn-sm btn-danger bx bxs-x-circle" for="borrarFila2_'+(cant+1)+'"> '+
                    'Borrar<button id="borrarFila2_'+(cant+1)+'" type="button" onclick="borrarFila2(this);" hidden ></button>'+
                  '</label>'+
                '</div>'+    
          '</div>'+
    '</div>';

    document.getElementById("bloqueform3").insertAdjacentHTML("beforeEnd" ,fila);
    if ((cant+1) >= 5) {
        $(".btn-anadir2").prop('hidden',true);
    }
});
///////////////////////////////////////////////////////////


// funcion boton animado siguiente pagina
$('.imgbotones').click(function(obj) {
  
  var i= this.id;
  var div = $("#"+i);
  
for ( a = 1; a < 5; a++) {
    
    if (i != a) {
      // console.log(i);
      // console.log(a);
      $('#' + a).fadeOut();
       
    }
      
}
      div.animate({height: '14rem', opacity: '0.4'}, "fast");
      div.animate({width: '8rem', opacity: '0.4'}, "fast");
      div.animate({height: '8rem', opacity: '0.4'}, "fast");
      div.animate({width: '8rem', opacity: '0.4'}, "fast");
      div.animate({height: '8rem', opacity: '0.4'}, "fast");
      div.animate({width: '10rem', opacity: '0.4'}, "fast");
      div.animate({height: '10rem', opacity: '0.4'}, "fast");
      div.animate({width: '10rem', opacity: '0.4'}, "fast");
      $("#bannerbuton").trigger("click");
       
      $("#tycimg").attr('src',div.attr('src'));

      for ( a = 1; a < 5; a++) {
    
        if (i != a) {
          // console.log(i);
          // console.log(a);
          $('#' + a).fadeIn();
           
        }
      } 

});

$("#formSpoc").submit(function(e){
    var valores = $("#formSpoc").serialize();
    var length1 = $("#containerProp4stg .row").length;
    $("#totPrecioTop").val(length1);
     var length2 = $("#containerComp4stg .row").length;
    $("#totPrecioTopComp").val(length2);
     var length3 = $("#containerProp5stg .row").length;
    $("#totEDV").val(length3);
     var length4 = $(".bloqueform2 .filit").length;
    $("#totEDVComp").val(length4);
      var length5 = $("#containerProp6stg .row").length;
    $("#totEXH").val(length5);
     var length6 = $(".bloqueform3 .filit2").length;
    $("#totEXHComp").val(length6);
    // console.log('length1',length1);
    // $.ajax({
    //     method:'POST',
    //     url: 'conexion/funciones.php',
    //     dataType: 'json',
    //     data:  $("#formSpoc").serialize(),
    //     success : function(respuesta){

    //     }//success
    // });//ajax
    // e.preventDefault();
});

////////////////////////////////////////////////////////////////
// funcion boton animado siguiente pagina
// $('.emp').click(function(obj) {
  
//   var i= this.id;
//   var div = $("#tyc"+i);
  
// for ( a = 1; a < 5; a++) {
    
//     if (i != a) {
      
//       $('#tyc' + a).fadeOut();
       
//     }
      
// }
//       div.animate({height: '14rem', opacity: '0.4'}, "fast");
//       div.animate({width: '8rem', opacity: '0.4'}, "fast");
//       div.animate({height: '8rem', opacity: '0.4'}, "fast");
//       div.animate({width: '8rem', opacity: '0.4'}, "fast");
//       div.animate({height: '8rem', opacity: '0.4'}, "fast");
//       div.animate({width: '10rem', opacity: '0.4'}, "fast");
//       div.animate({height: '10rem', opacity: '0.4'}, "fast");
//       div.animate({width: '10rem', opacity: '0.4'}, "fast");
//       $("#bannerbuton").trigger("click");

// });
////////////////////////////////////////////////////////////////


// cambia de estage segun tyc

// $('.tyc').click(function (){
// var a= this.id;
// var b= a.split('tyc');

// $('#id'+b[1]).fadeIn();

//   for ( i = 1; i < 7; i++) {
//     if(('tyc'+i) != a){
//       $('#id'+i).fadeOut();
//     }    
    
//   }
  
// });
///////////////////////////////////////////////////////////////////

// (function($){
//   	/**
// 	 * The (modified) excellent number formatting method from PHPJS.org.
// 	 * http://phpjs.org/functions/number_format/
// 	 *
// 	 * @modified by Sam Sehnert (teamdf.com)
// 	 *	- don't redefine dec_point, thousands_sep... just overwrite with defaults.
// 	 *	- don't redefine decimals, just overwrite as numeric.
// 	 *	- Generate regex for normalizing pre-formatted numbers.
// 	 *
// 	 * @param float number			: The number you wish to format, or TRUE to use the text contents
// 	 *								  of the element as the number. Please note that this won't work for
// 	 *								  elements which have child nodes with text content.
// 	 * @param int decimals			: The number of decimal places that should be displayed. Defaults to 0.
// 	 * @param string dec_point		: The character to use as a decimal point. Defaults to '.'.
// 	 * @param string thousands_sep	: The character to use as a thousands separator. Defaults to ','.
// 	 *
// 	 * @return string : The formatted number as a string.
// 	 */
// 	$.number = function( number, decimals, dec_point, thousands_sep ){
// 		// Set the default values here, instead so we can use them in the replace below.
// 		thousands_sep	= (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
// 		dec_point		= (typeof dec_point === 'undefined') ? '.' : dec_point;
// 		decimals		= !isFinite(+decimals) ? 0 : Math.abs(decimals);
		
// 		// Work out the unicode representation for the decimal place and thousand sep.	
// 		var u_dec = ('\\u'+('0000'+(dec_point.charCodeAt(0).toString(16))).slice(-4));
// 		var u_sep = ('\\u'+('0000'+(thousands_sep.charCodeAt(0).toString(16))).slice(-4));
		
// 		// Fix the number, so that it's an actual number.
// 		number = (number + '')
// 			.replace('\.', dec_point) // because the number if passed in as a float (having . as decimal point per definition) we need to replace this with the passed in decimal point character
// 			.replace(new RegExp(u_sep,'g'),'')
// 			.replace(new RegExp(u_dec,'g'),'.')
// 			.replace(new RegExp('[^0-9+\-Ee.]','g'),'');
		
// 		var n = !isFinite(+number) ? 0 : +number,
// 		    s = '',
// 		    toFixedFix = function (n, decimals) {
// 		        var k = Math.pow(10, decimals);
// 		        return '' + Math.round(n * k) / k;
// 		    };
		
// 		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
// 		s = (decimals ? toFixedFix(n, decimals) : '' + Math.round(n)).split('.');
// 		if (s[0].length > 3) {
// 		    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, thousands_sep);
// 		}
// 		if ((s[1] || '').length < decimals) {
// 		    s[1] = s[1] || '';
// 		    s[1] += new Array(decimals - s[1].length + 1).join('0');
// 		}
// 		return s.join(dec_point);
// 	}
	
// })(jQuery);





function formateonum(obj){
  var id= obj.id;
  // var valor= obj.value;
  $("#"+id).number(true,2);
  // $("#"+id).val()=$("#"+id).number($("#"+id),2);
  // var nanaco= $("#"+id).val();
  // $("#"+id)
  // $("#"+id).attr('value',newvalor);
  // $("#"+id).val(newvalor);
  // console.log('id',id);
  // console.log('valor',valor);
  // console.log('newvalor',newvalor);
  // console.log('nanaco',nanaco);
}