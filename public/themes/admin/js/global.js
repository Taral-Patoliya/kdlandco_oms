/* Nofication Close Buttons */
$('.notification a.close').click(function(e){
	e.preventDefault();

	$(this).parent('.notification').fadeOut();
});

/*
	Check All Feature
	*/
	$(".check-all").click(function(){
		$("table input[type=checkbox]").attr('checked', $(this).is(':checked'));
	});

/*
	Dropdowns
	*/
	$('.dropdown-toggle').dropdown();

/*
	Set focus on the first form field
	*/
	$(":input:visible:first").focus();

/*
	Responsive Navigation
	*/
	$('.collapse').collapse();

/*
 Prevent elements classed with "no-link" from linking
 */
//$(".no-link").click(function(e){ e.preventDefault();	});
$(document).ready(function(){
	$.fn.dataTableExt.sErrMode = 'throw';
	$(".datatable").each(function(){

		var table = $(this).DataTable({
			"aoColumnDefs": [
			{ 'bSortable': false, 'aTargets': [ 'column-check','view_details' ] }
			]
		});
	});

	$(".client-table").each(function(){
		var len = ($("#clients tr:nth-child(2) td").length);

		len = len-1;
		
		var tbl = $(this).DataTable({
			"aoColumnDefs": [
			{ 'bSortable': false, 'aTargets': [ 'column-check','view_details' ] }
			]
		});
	});
	
});

