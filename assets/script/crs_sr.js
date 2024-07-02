// JavaScript Document
// $(document).ready(function () {
//     $('.mask_currency').inputmask('999,999,999', {
//         numericInput: true,
//         placeholder: " ",
//         showMaskOnHover: false
//     });
// });

var table;

function start_sr()
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

function qsr()
{		
	$.ajax({
		url:'sr/ui_question',
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

function qsr2()
{		
	$.ajax({
		url:'sr/ui_question2',
		global:false,
		async:false,
		type:'post',
		data: $('#frm_fr2').serialize(),
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

function recommend_sr()
{		
	$.ajax({
		url:'sr/ui_recommend',
		global:false,
		async:false,
		type:'post',
		data: $('#frm_fr').serialize(),
		success: function(e) {
			/*var err = /error;;/
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
			{*/
				$('#viewport').html(e);
				//console.log('aa'+limit_viewed);
				table = $('#table').dataTable({
					"dom": "t<'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'p>>",
					"bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
					"pageLength": '1000',            
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
			//}*/
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

function recommend_sr2()
{		
	$.ajax({
		url:'sr/ui_recommend',
		global:false,
		async:false,
		type:'post',
		data: $('#frm_fr').serialize(),
		success: function(e) {
			/*var err = /error;;/
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
			{*/
				$('#viewport').html(e);
				//console.log('aa'+limit_viewed);
				table = $('#table').dataTable({
					"dom": "t<'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'p>>",
					"bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
					"pageLength": '1000',            
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
			//}*/
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

function choosesr(ch)
{		
	$.ajax({
		url:'sr/ui_choose',
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

function chsr()
{
	var count = 0;
	var prod = '';
	$("input:checked", table.fnGetNodes()).each(function(){
		count++;
		prod = prod+$(this).val()+'||';
	});
	
	var prods = prod.slice(0,-2);
	
	if(count == 0)
	{
		qsr2();
		//recommend_sr2();
	}
	else if(count >= 1)
	{
		choosesr(prods);
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