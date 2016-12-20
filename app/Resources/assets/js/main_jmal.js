function showNotAffected(){
	$('#app_session_soutenances_student option[data-affected=0]').css('display', "inherit");
}

function mydelete(id, where){
	if (where==1){
		$.ajax({
			url: '../../soutenance/'+id,
			type: 'DELETE'
		});
		$(".soutenance"+id).remove();
	}else{
		$.ajax({
			url: '../soutenance/'+id,
			type: 'DELETE'
		});
		$(".soutenance"+id).hide();
		var student_id = $(".soutenance"+id+" select[name*='student']").val();
		$("select[name*='student'] option[value="+student_id+"]").attr('data-affected', 0);
		showNotAffected();
	}
}

function myedit(id, student, stime, examinateur, where){
	if (where==1){
		var loc = window.location.href;
		if(loc.indexOf("newSession") > -1  ){
			$.ajax({
				url: '../soutenance/'+id,
				type: 'DELETE'
			});
		}else{
			$.ajax({
				url: '../../soutenance/'+id,
				type: 'DELETE'
			});
		}
		$("select[name*='student'] option[value="+student+"]").attr('data-affected', 0);
		showNotAffected();
		$(".btn-add").click();
		var h = parseInt(stime.substring(0, stime.indexOf(':')), 10);
		var m = parseInt(stime.substring(stime.indexOf(':')+1),10);
		$("#app_session_soutenances_student").val(student);
		$("#app_session_soutenances_examinateur").val(examinateur);
		$("#app_session_soutenances_stime_hour").val(h);
		$("#app_session_soutenances_stime_minute").val(m);
		$("#app_session_soutenances_student").trigger("change");
		$(".soutenance"+id).remove();
	}
}
$(document).ready(function(){
	nbr=-1;
	session_id='';
	$("#app_session_president").val($("#app_session_president option:first").val());
	$("#app_session_classroom").val($("#app_session_classroom option:first").val());
	$("#app_session_section").val($("#app_session_section option:first").val());
	$(document).on('click','.btn-add',function(){
		nbr++;
		$(this).hide('slide');
		if(nbr>1){
			$(".body-table:eq(-1)").clone().appendTo("#soutenance_list");
			$(".body-table:eq(-2) #app_session_soutenances_stime_hour").attr('id', 'old0');
			$(".body-table:eq(-2) #app_session_soutenances_stime_minute").attr('id', 'old1');
			$(".body-table:eq(-2) #app_session_soutenances_student").attr('id', 'old2');
			$(".body-table:eq(-2) #app_session_soutenances_subject").attr('id', 'old3');
			$(".body-table:eq(-2) #app_session_soutenances_company").attr('id', 'old4');
			$(".body-table:eq(-2) #app_session_soutenances_eTuteur").attr('id', 'old5');
			$(".body-table:eq(-2) #app_session_soutenances_encadrant").attr('id', 'old6');
			$(".body-table:eq(-2) #app_session_soutenances_examinateur").attr('id', 'old7');
			
			$(".body-table:eq(-1) #app_session_soutenances_stime_hour").prop("disabled", false);
			$(".body-table:eq(-1) #app_session_soutenances_stime_minute").prop("disabled", false);
			$(".body-table:eq(-1) #app_session_soutenances_student").prop("disabled", false);
			$(".body-table:eq(-1) #app_session_soutenances_examinateur").prop("disabled", false);
			$(".body-table:eq(-1) .btn-danger").remove();
			$(".body-table:eq(-1) .btn-primary").remove();
			$('.body-table:eq(-1)').attr('class', 'table table-condensed body-table');
			showNotAffected();
		}
		$(".body-table:last").show('slide');
		$(".btn-confirm").show('slide');
		$(".btn-cancel").show('slide');
	});
	
	$(document).on('click','.btn-cancel',function(){
		if(nbr==-1){
			return;
		}
		else if(nbr==1){
			$(".body-table:first").hide('slide');
		}else{
			$(".body-table:last").remove();
			$(".body-table:eq(-1) #old0").attr('id', 'app_session_soutenances_stime_hour');
			$(".body-table:eq(-1) #old1").attr('id', 'app_session_soutenances_stime_minute');
			$(".body-table:eq(-1) #old2").attr('id', 'app_session_soutenances_student');
			$(".body-table:eq(-1) #old3").attr('id', 'app_session_soutenances_subject');
			$(".body-table:eq(-1) #old4").attr('id', 'app_session_soutenances_company');
			$(".body-table:eq(-1) #old5").attr('id', 'app_session_soutenances_eTuteur');
			$(".body-table:eq(-1) #old6").attr('id', 'app_session_soutenances_encadrant');
			$(".body-table:eq(-1) #old7").attr('id', 'app_session_soutenances_examinateur');
		}
		nbr--;
		$(".btn-cancel").hide('slide');
		$(".btn-confirm").hide('slide');
		$(".btn-add").show('slide');
	});
	
	$(document).on('click','.btn-confirm',function(){
		disp = false;
		if(nbr==-1){
			var type = $("#stype").val();
			var salle = $("#app_session_classroom").val();
			var filiere = $("#app_session_section").val();
			var date = $("#session_date").val();
			var president_id = $("#app_session_president").val();
			var month_val = $("#month").val();
			$.ajax({
			  type: "GET",
			  url: "http://localhost/pppservice/createSession.php",
			  data: { stype: type, classroom: salle, section: filiere, sdate: date, president: president_id, month: month_val },
			  dataType: "json",
			  success: function( result ) {
				  
				  session_id = result.response;
				  
				$("#stype").attr('disabled', 'disabled');
				$("#app_session_classroom").attr('disabled', 'disabled');
				$("#app_session_section").attr('disabled', 'disabled');
				$("#session_date").attr('disabled', 'disabled');
				$("#app_session_president").attr('disabled', 'disabled');
				$("#month").attr('disabled', 'disabled');
				$(".btn-confirm").hide('slide');
				$(".btn-cancel").hide('slide');
				$(".btn-add").show('slide');
				$("#preview_session").attr("href", window.location.href+"/../viewSession/"+session_id);
				  $("#preview_session").show();
				nbr=0;
			  },
			  error: function(xhr) {
				console.log(xhr);
			  }
			});
			
		}else{
			var time = $("#app_session_soutenances_stime_hour").val()+":"+$("#app_session_soutenances_stime_minute").val();
			var student_id = $("#app_session_soutenances_student").val();
			var subject_id = $("#app_session_soutenances_subject").val();
			var company_id = $("#app_session_soutenances_company").val();
			var etuteur_id = $("#app_session_soutenances_eTuteur").val();
			var encadrant_id = $("#app_session_soutenances_encadrant").val();
			var examinateur_id = $("#app_session_soutenances_examinateur").val();
			$.ajax({
			  type: "GET",
			  url: "http://localhost/pppservice/createSoutenance.php",
			  data: { stime: time, student: student_id, subject: subject_id, company: company_id, etuteur: etuteur_id, encadrant: encadrant_id, examinateur: examinateur_id, session: session_id },
			  dataType: "json",
			  success: function( result ) {
				  if(isNaN(result.response))
					{
						alert(result.response);
					}else{
						$("#app_session_soutenances_stime_hour").attr('disabled', 'disabled');
						$("#app_session_soutenances_stime_minute").attr('disabled', 'disabled');
						$("#app_session_soutenances_student").attr('disabled', 'disabled');
						$("#app_session_soutenances_examinateur").attr('disabled', 'disabled');
						$('#app_session_soutenances_student option[value='+student_id+']').attr('data-affected', "1");
						hideAffected();
						var myclass="soutenance"+result.response;
						$(".btn-confirm").hide('slide');
						$(".btn-cancel").hide('slide');
						$(".btn-add").show('slide');
						$(".body-table:last").addClass(myclass);
						$("#app_session_soutenances_stime_minute").after('&nbsp;<button type="button" class="btn btn-danger" onclick=mydelete('+result.response+')>Supprimer</button>&nbsp;<button type="button" class="btn btn-primary" onclick="myedit('+result.response+', '+student_id+', \''+time+'\', '+examinateur_id+', 1)">Editer</button>');
					}
					
			  },
			  error: function(xhr) {
				console.log(xhr);
			  }
			});
			
		}
	});
	
	
	$(document).on('click','.btn-confirm2',function(){
			var type = $("#stype").val();
			var salle = $("#app_session_classroom").val();
			var filiere = $("#app_session_section").val();
			var date = $("#session_date").val();
			var president_id = $("#app_session_president").val();
			var month_val = $("#month").val();
			$.ajax({
			  type: "GET",
			  url: "http://localhost/pppservice/updateSession.php",
			  data: { stype: type, classroom: salle, section: filiere, sdate: date, president: president_id, month: month_val, id:session_id },
			  dataType: "json",
			  success: function( result ) {
				  session_id = $("#my_id").val();
				$("#stype").attr('disabled', 'disabled');
				$("#app_session_classroom").attr('disabled', 'disabled');
				$("#app_session_section").attr('disabled', 'disabled');
				$("#session_date").attr('disabled', 'disabled');
				$("#app_session_president").attr('disabled', 'disabled');
				$("#month").attr('disabled', 'disabled');
				$(".body-table:not(:last-child)").show();
				nbr = $("#my_nbr").val();
				$(".btn-confirm2").attr("class", "btn btn-default btn-confirm");
				changeSection();
			  },
			  error: function(xhr) {
				console.log(xhr);
			  }
			});
			
		$(this).hide('slide');
		$(".btn-cancel").hide('slide');
		$(".btn-add").show('slide');
	});
	
	/* generate pdf session */
	$(document).on('click','#btn-pdf-session',function(){
		var contents = $("#to-print").html();
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                frame1.css({ "position": "absolute", "top": "-1000000px" });
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                //Create a new HTML document.
                frameDoc.document.write('<html><head><title>DIV Contents</title>');
                frameDoc.document.write('</head><body>');
                //Append the external CSS file.
                frameDoc.document.write('<link href="../../../../../css/main.css" rel="stylesheet" type="text/css" />');
                //Append the DIV contents.
                frameDoc.document.write(contents);
                frameDoc.document.write('</body></html>');
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    frame1.remove();
                }, 500);	
		
	});
	$(document).on('change', '#app_session_soutenances_student', function(){
		changeSubject();
		changeEncadrant();
		changeCompany();
		changeEtuteur();
    });
	
	$(document).on('change', '#app_session_section', function(){
		changeSection();
    });
	
	function changeSection(){
		var sectionID = $( "#app_session_section option:selected" ).val();
		$('#app_session_soutenances_student option[data-section='+sectionID+']').css('display', "inherit");
		$('#app_session_soutenances_student option[data-section!='+sectionID+']').css('display', "none");
		hideAffected();
	}
	
	function changeSubject(){
		var studentID = $( "#app_session_soutenances_student option:selected" ).val();
		$('#app_session_soutenances_subject option[data-student='+studentID+']').prop('selected', true).trigger('change');
	}
	
	function changeEncadrant(){
		var encadrantID = $( "#app_session_soutenances_subject option:selected" ).attr('data-encadrant');
		$('#app_session_soutenances_encadrant option[value='+encadrantID+']').prop('selected', true).trigger('change');
	}
	
	function changeCompany(){
		var companyID = $( "#app_session_soutenances_subject option:selected" ).attr('data-company');
		$('#app_session_soutenances_company option[value='+companyID+']').prop('selected', true).trigger('change');
	}
	
	function changeEtuteur(){
		var etuteurID = $( "#app_session_soutenances_subject option:selected" ).attr('data-etuteur');
		$('#app_session_soutenances_eTuteur option[value='+etuteurID+']').prop('selected', true).trigger('change');
	}
	
	function initSection(){
		$('#app_session_soutenances_student option').css('display', "none");
	}
	
	function hideAffected(){
		$('#app_session_soutenances_student option[data-affected=1]').css('display', "none");
	}
	
	initSection();
	changeSection();
	
	function sortTable(){
	  var rows = $('#single-session tr').get();

	  rows.sort(function(a, b) {

	  var A = $(a).children('td').eq(0).text().toUpperCase();
	  var B = $(b).children('td').eq(0).text().toUpperCase();

	  if(A < B) {
		return -1;
	  }

	  if(A > B) {
		return 1;
	  }

	  return 0;

	  });

	  $.each(rows, function(index, row) {
		$('#single-session').append(row);
	  });
	}
	sortTable();
	
	function sortTable2(nbr){
	  var rows = $('#single-list-teacher tbody tr').get();

	  rows.sort(function(a, b) {

	  var A = $(a).children('td').eq(nbr).text().toUpperCase();
	  var B = $(b).children('td').eq(nbr).text().toUpperCase();

	  if(A < B) {
		return -1;
	  }

	  if(A > B) {
		return 1;
	  }

	  return 0;

	  });

	  $.each(rows, function(index, row) {
		$('#single-list-teacher tbody').append(row);
	  });
	}
	
	function sortTable3(nbr){
	  var rows = $('#single-list-teacher tbody tr').get();

	  rows.sort(function(a, b) {
		
	  var A = $(a).children('td').eq(nbr).text().toUpperCase();
	  var B = $(b).children('td').eq(nbr).text().toUpperCase();

	  var f = A.split("-");
	  var x = new Date(from[2], from[1] - 1, from[0]);
	  var f = B.split("-");
	  var y = new Date(from[2], from[1] - 1, from[0]);
	  console.log("hi--");
	  console.log(x);
	  console.log("hi--");
	  return ((x < y) ? 1 : ((x > y) ?  -1 : 0));

	  return 0;

	  });

	  $.each(rows, function(index, row) {
		$('#single-list-teacher tbody').append(row);
	  });
	}
	sortTable2(6);
	sortTable2(5);
	
	if($("#my_salle")!=undefined){
		$("#app_session_classroom").val($("#my_salle").val());
		$("#app_session_section").val($("#my_section").val());
		$("#app_session_president").val($("#my_president").val());
		$("#app_session_president").val($("#my_president").val());
		session_id = $("#my_id").val();
	}
	
    // Setup - add a text input to each footer cell
    $('#sessions_list tfoot th:not(:last-child)').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Filtrer '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#sessions_list').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
});




