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
                            '<input type="text" class="form-control numero" maxlength="10" aria-label="Amount (to the nearest dollar)">'+
                          '</div>'+
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
                            '<input type="text" class="form-control numero" maxlength="10" aria-label="Amount (to the nearest dollar)">'+
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
                            '<input class="form-check-input radio_vis" type="radio" name="radio_'+(index+1)+'" id="radio_vis_'+(index+1)+'" value="option1" onclick="cargaArchivos(this.id);"/>'+
                            '<label class="form-check-label" for="radio_vis_'+(index+1)+'">Si</label>'+
                          '</div>'+
                          '<div class="form-check form-check-inline">'+
                            '<input class="form-check-input radio_vis" type="radio" name="radio_'+(index+1)+'" id="radio_vis_'+(index+1)+'" value="option2"  onclick="cargaArchivos(this.id);"/>'+
                            '<label class="form-check-label" for="radio_vis_'+(index+1)+'">No</label>'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-8 col-md-6">'+
                          '<label for="nombreprod">'+value['dsc_exhibicion']+' de '+value['dsc_producto']+'</label>'+
                        '</div>'+
                        '<div class="input-group col-2 col-md-4">'+
                          '<label for="prop_vis_'+(index+1)+'" class="btn btn-sm btn-light" id="label_prop_vis_'+(index+1)+'" hidden>'+
                            '<i class="bx bx-upload" id="texto_prop_vis_'+(index+1)+'"> Cargar</i>'+
                            '<input id="prop_vis_'+(index+1)+'" disabled class="form-control-file btnCarga" type="file" accept=".jpeg, .jpg, .png" name="" hidden /></label>'+
                        '</div>'+
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
                    '<div class="row">'+
                        '<div class="contador col-1">'+
                            '<label for="">'+(index+1)+'.</label>'+
                        '</div>'+
                        '<div class="radio2 col-3 col-md-3">'+
                            '<div class= "form-check form-check-inline" >'+
                                '<input class= "form-check-input radio2_vis" type= "radio" name= "radio2_'+(index+1)+'" id= "radio2_vis_'+(index+1)+'" value= "option1" >'+
                                '<label class= "form-check-label" for= "radio2_vis_'+(index+1)+'" >Si</label>'+
                            '</div> '+
                            '<div class= "form-check form-check-inline" >'+
                                '<input class= "form-check-input radio2_vis" type= "radio" name= "radio2_'+(index+1)+'" id= "radio2_vis_'+(index+1)+'" value= "option2" >'+
                                '<label class= "form-check-label" for= "radio2_vis_'+(index+1)+'" >No</label>'+
                            '</div> '+
                        '</div>'+
                            '<label for="my-input" class="col-7 col-sm-4 txelem">'+value['dsc_exhibicion']+' de '+value['dsc_producto']+'</label>'+
                        '<div class="input-group col-7 col-md-3">'+
                            '<div class="input-group-prepend suiche21">'+
                                '<span class="input-group-text " id="my-addon">S/</span>'+
                            '</div>'+
                            '<input class="form-control suiche21" type="text" id="precio_prop_'+(index+1)+'" name="precio_prop_'+(index+1)+'" placeholder="Precio" aria-label="Recipients " aria-describedby="my-addon">'+
                        '</div>'+
                       ' <div class="input-group col-2 col-md-2">'+
                           ' <label for="prop_vis_1" class="btn btn-sm btn-light" id="label2_prop_vis_1" hidden><i class="bx bx-upload" id="texto2_prop_vis_1"> Cargar</i><input id="prop2_vis_1" class="form-control-file btnCarga" type="file" accept=".jpeg, .jpg, .png" name="" hidden></label>'+
                        '</div>'+
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
    	parent_fieldset.find('input[type="text"], input[type="password"], textarea').each(function() {
    		if( $(this).val() == "" ) {
    			$(this).addClass('input-error');
    			next_step = false;
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation
    	
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
    
    // submit
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

function cargaArchivos(id){
    var valor = $("#"+id).val();
    aux = id.split('_')[2];
    // console.log('id',id);
    // console.log('valor',valor);
    // console.log('aux'.aux);
    if(valor == 'option1'){
        $('#label_prop_vis_'+aux).removeClass('btn-secondary');
        $('#label_prop_vis_'+aux).removeClass('btn-light');
        $('#label_prop_vis_'+aux).addClass('btn-primary');
    // $('#texto_prop_vis_'+aux).removeClass('bx-refresh');
        // $('#texto_prop_vis_'+aux).addClass('bx-upload');
        $("#prop_vis_"+aux).prop('disabled',false);
        $("#label_prop_vis_"+aux).prop('hidden',false);
    }else{
        $('#label_prop_vis_'+aux).removeClass('btn-primary');
        $('#label_prop_vis_'+aux).addClass('btn-light');
        $("#prop_vis_"+aux).prop('disabled',true);
        $('#texto_prop_vis_'+aux).html(' Cargar');
    // $('#texto_prop_vis_'+aux).removeClass('bx-upload');
        // $('#texto_prop_vis_'+aux).addClass('bx-refresh');
        $("#prop_vis_"+aux).val();
        $("#label_prop_vis_"+aux).prop('hidden',true);
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
                          '<input class="form-control texto" type="text" name="">'+
                        '</div>'+
                        '<div class="col-6 col-lg-5 selec">'+
                          '<select id="my-select" class="custom-select suiche2" name="">'+
                            '<option value="">Seleccione...</option>'+
                            '<option value="5">Jalavistas</option>'+
                            '<option value="6">Marco de góndola</option>'+
                          '</select>'+
                        '</div>'+
                        '<div class="input-group btn-group filefot col-8 col-md-6 col-lg-3">'+
                          '<label for="carga_'+(cant+1)+'" class="btn btn-sm upcarga btn-primary" id="label_carga_'+(cant+1)+'"><i class="bx bx-upload" id="texto_carga_'+(cant+1)+'"> Cargar</i><input id="carga_'+(cant+1)+'" class="form-control-file btnCarga" type="file" accept=".jpeg, .jpg, .png" name="carga_'+(cant+1)+'" hidden></label>'+
                          '<label class="btn btn-sm upcarga btn-danger bx bxs-x-circle " for="borrarFila_'+(cant+1)+'"> Borrar<button id="borrarFila_'+(cant+1)+'"  type="button" onclick="borrarFila(this);" hidden></button></label>'+
                        '</div>'+                                 
                  '</div>'+
                '</div>';
    document.getElementById("bloqueform2").insertAdjacentHTML("beforeEnd" ,fila);
    if ((cant+1) >= 5) {
        $(".btn-anadir").prop('hidden',true);
    }
});

// fin añadir visibilidad
// cambio de boton en visibilidad
$(".btnCarga").on('change',function(){
    var id = this.id;
    console.log(this.value);
    if(this.value != ''){
        $('#label_'+id).removeClass('btn-primary');
    $('#label_'+id).addClass('btn-secondary');
    // $('#texto_'+id).removeClass('bx-upload');
        // $('#texto_'+id).addClass('bx-refresh');
        $('#texto_'+id).html(' ');
    }
    // alert(this.id);
});


// fin cambio de boton visibilidad

$('#label_prop_vis_')


// exhibiciones

$(".btnCarga2").on('change',function(){
  var id = this.id;
  console.log(this.value);
    if(this.value != ''){
        $('#label2_'+id).removeClass('btn-primary');
    $('#label2_'+id).addClass('btn-secondary');
    $('#texto2_'+id).removeClass('bx-upload');
        $('#texto2_'+id).addClass('bx-refresh');
        $('#texto2_'+id).html(' ');
    }
    // alert(this.id);
});

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

$(".btn-anadir2").on('click',function(){
    var cant = $(".bloqueform3 .filit2").length;
    var fila = '<div class="filit2">'+
                  '<div class="row">'+
                        '<div class="col-6 col-lg-4">'+
                          '<input class="form-control texto2" type="text" name="">'+
                        '</div>'+
                        '<div class="col-6 col-lg-3 selec">'+
                          '<select id="my-select" class="custom-select suiche2" name="">'+
                            '<option value="">Seleccione...</option>'+
                            '<option value="">Cabecera</option>'+
                            '<option value="">Ruma</option>'+
                            '<option value="">Lateral</option>'+
                            '<option value="">Cabeceras checkout</option>'+
                          '</select>'+
                        '</div>'+


                        '<div class="input-group col-6 col-md-3 col-lg-3">'+

                            '<div class="input-group-prepend suiche21">'+
                              '<span class="input-group-text " id="my-addon">S/</span>'+
                            '</div>'+

                            '<input class="form-control suiche21" type="text" name="" placeholder="Precio" aria-label="" aria-describedby="my-addon">'+

                          '</div>'+


                        '<div class="input-group btn-group filefot col-5 col-md-6 col-lg-3">'+
                          '<label for="carga2_'+(cant+1)+'" class="btn btn-sm upcarga btn-primary" id="label_carga2_'+(cant+1)+'"><i class="bx bx-upload" id="texto_carga2_'+(cant+1)+'"> Cargar</i><input id="carga2_'+(cant+1)+'" class="form-control-file btnCarga2" type="file" accept=".jpeg, .jpg, .png" name="" hidden></label>'+
                          '<label class="btn btn-sm upcarga btn-danger bx bxs-x-circle" for="borrarFila2_'+(cant+1)+'"> Borrar<button id="borrarFila2_'+(cant+1)+'" onclick="borrarFila2(this);" type="button" hidden></button></label>'+
                    '</div>'+                                 
              '</div>';
    document.getElementById("bloqueform3").insertAdjacentHTML("beforeEnd" ,fila);
    if ((cant+1) >= 5) {
        $(".btn-anadir2").prop('hidden',true);
    }
});


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