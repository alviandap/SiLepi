// JavaScript Document
// $(document).ready(function () {
//     $('.mask_currency').inputmask('999,999,999', {
//         numericInput: true,
//         placeholder: " ",
//         showMaskOnHover: false
//     });
// });

var table;

function start()
{
	$.ajax({
		url:'fr/start',
		global:false,
		async:false,
		type:'post',
		data: $('#inf').serialize(),
		success: function(e) {
			if(e == 'ok;')
			{
				u1();	
			}
			else
			{
				alert("Terjadi kesalahan sistem \n"+e);	
			}
		},
		error : function() {
			alert('Unexpected error happened..!!');	 
		},
		beforeSend : function() {
			$('#loading-img').show();
		},
		complete : function() {
			$('#loading-img').hide();
		}
	});	
}


function u1()
{		
	$.ajax({
		url:'fr/ui_question_u1',
		global:false,
		async:false,
		success: function(e) {
			$('#viewport').html(e);
			$('input:radio, input:checkbox').uniform();
			$(".mask_currency").inputmask('99.999.999', {
				numericInput: true
			});	
		},
		error: function(xhr, status, error) {
			console.log(xhr.responseText);
		},
		beforeSend : function() {
			$('#loading-img').show();
		},
		complete : function() {
			$('#loading-img').hide();
		}
	});	
}

function u2(ch)
{		
	$.ajax({
		url:'fr/ui_question_u2',
		global:false,
		async:false,
		type:'post',
		data: ({ product:ch }),
		success: function(e) {
			$('#viewport').html(e);
			$('input:radio, input:checkbox').uniform();
		},
		error : function() {
			alert('Unexpected error happened..!!');	 
		},
		beforeSend : function() {
			$('#loading-img').show();
		},
		complete : function() {
			$('#loading-img').hide();
		}
	});	
}

function u4()
{		
	$.ajax({
		url:'fr/ui_question_u4',
		global:false,
		async:false,
		success: function(e) {
			$('#viewport').html(e);
			$('input:radio, input:checkbox').uniform();
		},
		error : function() {
			alert('Unexpected error happened..!!');	 
		},
		beforeSend : function() {
			$('#loading-img').show();
		},
		complete : function() {
			$('#loading-img').hide();
		}
	});	
}

function u3()
{		
	$.ajax({
		url:'fr/ui_question_u3',
		global:false,
		async:false,
		success: function(e) {
			$('#viewport').html(e);
			$('input:radio, input:checkbox').uniform();
		},
		error : function() {
			alert('Unexpected error happened..!!');	 
		},
		beforeSend : function() {
			$('#loading-img').show();
		},
		complete : function() {
			$('#loading-img').hide();
		}
	});	
}

function u5()
{		
	$.ajax({
		url:'fr/ui_question_u5',
		global:false,
		async:false,
		success: function(e) {
			//alert(e);
			$('#viewport').html(e);
			$('input:radio, input:checkbox').uniform();
			$(".mask_currency").inputmask('99.999.999', {
				numericInput: true
			});	
		},
		error : function() {
			alert('Unexpected error happened..!!');	 
		},
		beforeSend : function() {
			$('#loading-img').show();
		},
		complete : function() {
			$('#loading-img').hide();
		}
	});	
}

function recommend_u1()
{		
	$.ajax({
		url:'fr/ui_recommend_u1',
		global:false,
		async:false,
		type:'post',
		data: $('#frm_fr').serialize(),
		success: function(e) {
			var err = /error;;/
			var err5 = /error;;u5/
			if(err5.test(e))
			{
				//if(confirm(e.replace('error;;','')))
					u5();
			}
			else if(err.test(e))
			{
				if(confirm(e.replace('error;;','')))
					u4();
			}
			else
			{
				$('#viewport').html(e);
				//console.log('aa'+limit_viewed);
				table = $('#table').dataTable({
					"dom": "t<'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'p>>",
					"bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
					"pageLength": limit_viewed,            
					"pagingType": "bootstrap_full_number",
					"language": {
						"search": "My search: ",
						"lengthMenu": "  _MENU_ records",
						"paginate": {
							"previous":"Prev",
							"next": "Next",
							"last": "Last",
							"first": "First"
						}
					}
				});
				
				$('input:radio, input:checkbox').uniform();
			}
		},
		error: function(xhr, status, error) {
			console.log(xhr.responseText);
		},
		beforeSend : function() {
			$('#loading-img').show();
		},
		complete : function() {
			$('#loading-img').hide();
		}
	});	
}

function recommend_u5()
{		
	$.ajax({
		url:'fr/ui_recommend_u5',
		global:false,
		async:false,
		type:'post',
		data: $('#frm_fr').serialize(),
		success: function(e) {
			var err = /error;;/
			var err5 = /error;;u5/
			if(err5.test(e))
			{
				//if(confirm(e.replace('error;;','')))
					u5();
			}
			else if(err.test(e))
			{
				if(confirm(e.replace('error;;','')))
					u4();
			}
			else
			{
				$('#viewport').html(e);
				//console.log('aa'+limit_viewed);
				table = $('#table').dataTable({
					"dom": "t<'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'p>>",
					"bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
					"pageLength": limit_viewed,            
					"pagingType": "bootstrap_full_number",
					"language": {
						"search": "My search: ",
						"lengthMenu": "  _MENU_ records",
						"paginate": {
							"previous":"Prev",
							"next": "Next",
							"last": "Last",
							"first": "First"
						}
					}
				});
				
				$('input:radio, input:checkbox').uniform();
			}
		},
		error: function(xhr, status, error) {
			console.log(xhr.responseText);
		},
		beforeSend : function() {
			$('#loading-img').show();
		},
		complete : function() {
			$('#loading-img').hide();
		}
	});	
}

function recommend()
{		
	$.ajax({
		url:'fr/ui_recommend',
		global:false,
		async:false,
		type:'post',
		data: $('#frm_fr').serialize(),
		success: function(e) {
			var err = /error;;/
			var err5 = /error;;u5/
			if(err5.test(e))
			{
				//if(confirm(e.replace('error;;','')))
					u5();
			}
			else if(err.test(e))
			{
				if(confirm(e.replace('error;;','')))
					u4();
			}
			else
			{
				$('#viewport').html(e);				
				//console.log('aa'+limit_viewed);
				table = $('#table').dataTable({
					"dom": "t<'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'p>>",
					"bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
					"pageLength": limit_viewed,            
					"pagingType": "bootstrap_full_number",
					"language": {
						"search": "My search: ",
						"lengthMenu": "  _MENU_ records",
						"paginate": {
							"previous":"Prev",
							"next": "Next",
							"last": "Last",
							"first": "First"
						}
					}
				});
				
				$('input:radio, input:checkbox').uniform();
			}
		},
		error: function(xhr, status, error) {
			console.log(xhr.responseText);
		},
		beforeSend : function() {
			$('#loading-img').show();
		},
		complete : function() {
			$('#loading-img').hide();
		}
	});	
}

function choose(ch)
{		
	$.ajax({
		url:'fr/ui_choose',
		global:false,
		async:false,
		type:'post',
		data: ({ prod:ch }),
		success: function(e) {			
			$('#viewport').html(e);
		},
		error: function(xhr, status, error) {
			console.log(xhr.responseText);
		},
		beforeSend : function() {
			$('#loading-img').show();
		},
		complete : function() {
			$('#loading-img').hide();
		}
	});	
}

function r()
{
	/*var count = $("input[name='product[]']:checked").length;
	if(count == 0)
	{
		u3();	
	}
	else if(count > 1)
	{
		u2();	
	}
	else if(count == 1)
	{
		var prod = $("input[name='product[]']:checked").val();
		choose(prod);
	}*/

	var count = 0;
	var prod = '';
	// $("input:checked", table.fnGetNodes()).each(function(){
		// count++;
		// prod = prod+$(this).val()+'||';
	// });
	$('input[name="product[]"]:checked').each(function() {
    count++;
		prod = prod+$(this).val()+'||';
	});
	var prods = prod.slice(0,-2);
	console.log(prods);
	console.log(count);
	if(count == 0)
	{
		u3();	
	}
	else if(count > 1)
	{
		u2(prods);	
	}
	else if(count == 1)
	{
		choose(prods);
	}
}

function show_details(id)
{
	if($('#txt-'+id).hasClass("details-less")) {
		$('#txt-'+id).removeClass("details-less");
	} else {
		$('#txt-'+id).addClass("details-less");
	}
}