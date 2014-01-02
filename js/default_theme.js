$(document).ready(function(){
$.ajaxSetup ({
    // Disable caching of AJAX responses */
    cache: false
});
	
//footer bar
$("#bottom-bar").jixedbar();
//end footer bar


$("#modalbox-index").fancybox({

        autoSize: false,
        height: 'auto',
        width: 'auto'
      
});//endfancybox






// login select section
$("#modalbox2").fancybox({
		closeBtn : false,
		modal: false,
        autoSize: false,
        height: 'auto',
        width: 'auto',
        closeClick  : false, // prevents closing when clicking INSIDE fancybox 
	    openEffect  : 'none',
		closeEffect : 'none',
		helpers   : { 
		overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
		},
		keys: { close  : [] }
	
      
});//endfancybox2


$('.logout_button').click(function() { 
var url = window.location.href.split('?')[0]; 
//alert(url);
	$.ajax({
            type: 'POST',
            url: url,
            data:  $('#foo').serialize(),
            success: function(data){
						//var $response=$(data); //mis datos de ajax
						//var formulario = $response.find('#data'); //filtro lo que busco 
						//$("#contenido").html(formulario);// lo meto en el div 
						$('#modalbox-index').trigger('click'); //abro el div con fancybox 
					
			},
			error: function(){   //the status returned will be "timeout" 
					alert('Error!');
			} 
			});   
			
return false;             		
});




$('#save_section').click(function() { 
	
	
//var section = $("input:checkbox[name=id_section]:checked").toString();
var matches = [];
$(".id_section_member:checked").each(function() {
    matches.push(this.value);
});
var section = matches.toString();

var id_section = $('#id_section').val();

var urlsave = '?action=save_section&id='+ userId + '&id_section_member=' + section + '&id_section=' + id_section; 

$.ajax({
           type: 'POST',
           url: urlsave,
           data:  $('#foo2').serialize(),
           success: 
				function(data){
		
                $.fancybox.close();

			},
           error: function(){
				alert('error!');
			   }
			});
            return false;

});


});
//end document ready


// Datepicker 
jQuery(function($){ 
        $.datepicker.regional['es'] = { 
                closeText: 'Cerrar', 
                prevText: 'Anterior', 
                nextText: 'Proximo', 
                currentText: 'Texto', 
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 
                'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'], 
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun', 
                'Jul','Ago','Sep','Oct','Nov','Dic'], 
                dayNames: 
['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'], 
                dayNamesShort: ['Dom','Lun','Mar','Mir','Jue','Vie','Sab'], 
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'], 
                weekHeader: 'Sem', 
                dateFormat: 'dd/mm/yy', 
                firstDay: 1, 
                isRTL: false, 
                showMonthAfterYear: false, 
                yearSuffix: ''}; 
        $.datepicker.setDefaults($.datepicker.regional['es']); 
}); 


$(function() {
	$( "#datefrom" ).datepicker({
	    dateFormat: 'dd-mm-yy', 
            changeMonth: true,
            changeYear: true,
	    currentText: 'Today'
        });
	 $( "#dateto" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            currentText: 'Today'
        });

        
    });


