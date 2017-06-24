$(document).ready(function(){
	var testsimadivexiste = $("#ladivdemontableaupouredit").length;
	var testsimadivexiste2 = $("#laDivPourMonTableauDesResultat").length;
	
	if (testsimadivexiste == 1){
		$.ajax({
			url : "form/addform.php", // on donne l'URL du fichier de traitement
			type : "POST", 
			data : "idduformaedit=tableauedit",
			success: function(repmodif) {
				//alert(repmodif);
				$('#ladivdemontableaupouredit').empty();				
				$('#ladivdemontableaupouredit').html(repmodif);	
				$('#montableaudequestion').DataTable();						
			}
		});
	}

	if (testsimadivexiste2 == 1){
		$.ajax({
			url : "form/voirresult.php", // on donne l'URL du fichier de traitement
			type : "POST", 
			data : "showmeyourtabderesult=machinchose",
			success: function(repmodif) {
				//alert(repmodif);
				$('#laDivPourMonTableauDesResultat').empty();				
				$('#laDivPourMonTableauDesResultat').html(repmodif);	
				$('#montableauderesult').DataTable();						
			}
		});
	}

	//alert('test');
	
	
	$('#nbquestion').change(function() {
		var nbquestion = $(this).val();
		if(nbquestion>6 || nbquestion<0){
			$(this).val(1);
		}else{
			$( ".div-question").empty();
			for (var i=1; i<=nbquestion; i++) {
				$( ".div-question" ).append( "<div class='row'>"+
					"<div class='col-lg-6'>"+
						"<div class='input-group'>"+
							"<span class='input-group-addon'>"+
								"<input type='checkbox' id='checkboxreponse"+i+"' aria-label='...'>"+
							"</span>"+
							"<input type='text' name='reponse"+i+"' id='reponse"+i+"' placeholder='Reponse "+i+"' class='form-control' aria-label='...'>"+
						"</div>"+
					"</div>"+
				"</div>");
			}
		}
	});

	$('#selecttype').change(function(){ 
		if( $("#selecttype").val() == 'qcm'){
			$("#divselectbonnereponse").show();
			$(".checkboxmultiple").hide();
		}else if($("#selecttype").val() == 'multiple'){
			$("#divselectbonnereponse").hide();
			$(".checkboxmultiple").show();
		}
	});

    // Lorsque je soumets le formulaire
    $('#formquestion').on('submit', function(e) {
        e.preventDefault(); // J'emp�che le comportement par d�faut du navigateur, c-�-d de soumettre le formulaire
 
		// Je r�cup�re les valeurs
        var niveau = $('#amount').val();
        var typeques = "qcm";
        var question = $('#question').val();
        var reponse1 = $('#reponse1').val();
        var reponse2 = $('#reponse2').val();
        var reponse3 = $('#reponse3').val();
        var reponse4 = $('#reponse4').val();
        var reponse5 = $('#reponse5').val();
        var reponse6 = $('#reponse6').val();
		
		var bonnereponse = "";
		if( $('#checkboxreponse1').is(':checked') ){
			bonnereponse = bonnereponse  + "1e";
		}
		if( $('#checkboxreponse2').is(':checked') ){
			bonnereponse = bonnereponse  + "2e";
		}
		if( $('#checkboxreponse3').is(':checked') ){
			bonnereponse = bonnereponse  + "3e";
		}
		if( $('#checkboxreponse4').is(':checked') ){
			bonnereponse = bonnereponse  + "4e";
		}
		if( $('#checkboxreponse5').is(':checked') ){
			bonnereponse = bonnereponse  + "5e";
		}
		if( $('#checkboxreponse6').is(':checked') ){
			bonnereponse = bonnereponse  + "6e";
		}
		
        // Je v�rifie une premi�re fois pour ne pas lancer la requ�te HTTP
        // si je sais que mon PHP renverra une erreur
        if(niveau === '' || typeques === ''|| question  === '' ||  reponse1 === '' ||reponse2 === '') {
            alert('Les champs doivent etres remplis');
        } 
		else {
          	$.ajax({
				url : "form/addquestion.php", // on donne l'URL du fichier de traitement
				type : "POST", 
				data : "niveau=" + niveau + "&typeques=" + typeques+ "&question=" + question+ "&reponse1=" + reponse1+ "&reponse2=" + reponse2+ "&reponse3=" + reponse3+ "&reponse4=" + reponse4 + "&reponse5=" + reponse5 +  "&reponse6=" + reponse6  + "&bonnereponse=" + bonnereponse,
				success: function(rep) {
					alert("Votre question a bien ete ajoutee a la base de donnee");
				}
			});
        }
    });	
	// Ajout d'un formulaire
/*	$('#formnewform').on('submit', function(e) {
        e.preventDefault(); // J'emp�che le comportement par d�faut du navigateur, c-�-d de soumettre le formulaire
 
        // Je r�cup�re les valeurs
        var nomnewform = $('#nomnewform').val();
		$.ajax({
			url : "form/addform.php", // on donne l'URL du fichier de traitement
			type : "POST", 
			data : "nomnewform=" + nomnewform,
			success: function(repmodif) {
				alert("Votre formulaire a bien �t� cree");
			}
		});	
	});*/
	
	//Edition d'un formulaire
	$('#selectformforedit').change(function(){ 
		var idDuForm= $('#selectformforedit').val();
		$.ajax({
			url : "form/addform.php", // on donne l'URL du fichier de traitement
			type : "POST", 
			data : "idduformaedit=" + idDuForm,
			success: function(repmodif) {
				//alert(repmodif);
				$('#tabledeform').empty();				
				$('#tabledeform').html(repmodif);	
				$('#montableaudequestion').DataTable();						
			}
		});
	});
	
	// ajout d'un assosiation question/formulaire avec rechargement du tableau
	$("body").on( "click", '.bouton-add', function(e) {
		var idDuForm= $('#selectformforedit').val();
		var idDeLaQuestion= $(this).val();
		$.ajax({
			url : "form/addform.php", // on donne l'URL du fichier de traitement
			type : "POST", 
			data : "idDuForm=" + idDuForm + "&idDeLaQuestion=" + idDeLaQuestion,
			success: function(repmodif) {
				$.ajax({								// on rafraichit notre tableau 
					url : "form/addform.php", 
					type : "POST", 
					data : "idduformaedit=" + idDuForm,
					success: function(repmodif) {
						$('#tabledeform').empty();				
						$('#tabledeform').html(repmodif);	
						$('#montableaudequestion').DataTable();						
					}
				});
			}
		});	
	});

	// suppression d'une association d'une question avec un formulaire 
	$("body").on( "click", '.bouton-suppr', function(e) {
		var idDuForm= $('#selectformforedit').val();
		var idDeLaQuestion= $(this).val();
		$.ajax({
			url : "form/addform.php", // on donne l'URL du fichier de traitement
			type : "POST", 
			data : "idDuFormASuppr=" + idDuForm + "&idDeLaQuestionASuppr=" + idDeLaQuestion,
			success: function(repmodif) {
				$.ajax({								// on rafraichit notre tableau 
					url : "form/addform.php", 
					type : "POST", 
					data : "idduformaedit=" + idDuForm,
					success: function(repmodif) {
						$('#tabledeform').empty();				
						$('#tabledeform').html(repmodif);	
						$('#montableaudequestion').DataTable();
					}
				});
			}
		});	
	});
	$("body").on( "click", '.bouton-edit', function(e) {
		var idDeLaQuestion= $(this).val();
		$.ajax({
			url : "form/addquestion.php", // on donne l'URL du fichier de traitement
			type : "POST", 
			data : "idDeLaQuestion=" + idDeLaQuestion,
			success: function(repmodif) {			// on recup toute les infos de notre question sous forme d'un tableau Json
				var objquestion = eval('(' + repmodif + ')');		//on recup notre tableau json pour le transformer en obj js
				
				var nbrepdansecttequestion = 0;
				for (var i = 1; i<7; i++) {			//on regarde combien de reponsse on a dans notre question 
					if(objquestion.rep[i] != "VIDE"){
						nbrepdansecttequestion++;
					}
				}
				$("#question").val(objquestion.quest);
				$("#nbquestion").val(nbrepdansecttequestion);	// on rentre le nombre de question dans le champ prevu a cette effet
				$('#nbquestion').change();						// on dit a notre page que yolo on a changer le champ faut faire le taf !!! 

				for (var i = 1; i <= nbrepdansecttequestion; i++) {	// on rentre nos question dans leurs champ respectif
					$("#reponse"+i).val(objquestion.rep[i]);
				}

				splitbonnereponsse = objquestion.corect.split("e");

				for (var i = 0; i <= splitbonnereponsse.length-2; i++) {	// on coche nos bonnes r�ponsses 
					//alert(splitbonnereponsse[i]);
					$("#checkboxreponse"+splitbonnereponsse[i]).click();
				}

				$('#boutonvaliderform').hide();
				$('#boutonediterquestion').show();
				$('#btnsupprquest').val(objquestion.id);
				$('#btneditquest').val(objquestion.id);
				
				$('html, body').animate({scrollTop:0}, 'slow');
			}
		});	
	});
	
	$('#btnsupprquest').click(function() {
		$.ajax({								
			url : "form/addquestion.php", 
			type : "POST", 
			data : "idDeLaQuestionquonveuxSuppr=" + $(this).val(),
			success: function(repmodif) {
				location.reload();
			}
		});		
	});
	$('#btneditquest').click(function() {
		//alert($(this).val());
		
		// Je r�cup�re les valeurs
		var id = $(this).val();
        var niveau = $('#amount').val();
        var typeques = "qcm";
        var question = $('#question').val();
        var reponse1 = $('#reponse1').val();
        var reponse2 = $('#reponse2').val();
        var reponse3 = $('#reponse3').val();
        var reponse4 = $('#reponse4').val();
        var reponse5 = $('#reponse5').val();
        var reponse6 = $('#reponse6').val();
		
		var bonnereponse = "";
		if( $('#checkboxreponse1').is(':checked') ){
			bonnereponse = bonnereponse  + "1e";
		}
		if( $('#checkboxreponse2').is(':checked') ){
			bonnereponse = bonnereponse  + "2e";
		}
		if( $('#checkboxreponse3').is(':checked') ){
			bonnereponse = bonnereponse  + "3e";
		}
		if( $('#checkboxreponse4').is(':checked') ){
			bonnereponse = bonnereponse  + "4e";
		}
		if( $('#checkboxreponse5').is(':checked') ){
			bonnereponse = bonnereponse  + "5e";
		}
		if( $('#checkboxreponse6').is(':checked') ){
			bonnereponse = bonnereponse  + "6e";
		}
		
        // Je v�rifie une premi�re fois pour ne pas lancer la requ�te HTTP
        // si je sais que mon PHP renverra une erreur
        if(niveau === '' || typeques === ''|| question  === '' ||  reponse1 === '' ||reponse2 === '') {
            alert('Les champs doivent etres remplis');
        } 
		else {
          	$.ajax({
				url : "form/addquestion.php", // on donne l'URL du fichier de traitement
				type : "POST", 
				data : "niveauupdate=" + niveau + "&typeques=" + typeques+ "&question=" + question+ "&reponse1=" + reponse1+ "&reponse2=" + reponse2+ "&reponse3=" + reponse3+ "&reponse4=" + reponse4 + "&reponse5=" + reponse5 +  "&reponse6=" + reponse6  + "&bonnereponse=" + bonnereponse + "&idquestion=" + id,
				success: function(rep) {
					alert(rep + "    Votre question a bien ete modifier a la base de donnee");
				}
			});
        }
	});
	
	
	
	
	//------------- RESULTAT __________
	$("body").on( "click", '.boutoncalcresult', function(e) {
		idresult=$(this).val();

		$.ajax({
			url : "form/voirresult.php", // on donne l'URL du fichier de traitement
			type : "POST", 
			data :"idduresultACalculer=" + idresult,
			success: function(rep) {
				alert(rep);
				$.ajax({
					url : "form/voirresult.php", // on donne l'URL du fichier de traitement
					type : "POST", 
					data : "showmeyourtabderesult=machinchose",
					success: function(repmodif) {
						//alert(repmodif);
						$('#laDivPourMonTableauDesResultat').empty();				
						$('#laDivPourMonTableauDesResultat').html(repmodif);	
						$('#montableauderesult').DataTable();						
					}
				});
			}
		});
	});
	
	$("body").on( "click", '.boutonvoirresult', function(e) {
		idresult=$(this).val();
				
		$.ajax({
			url : "form/voirresult.php", // on donne l'URL du fichier de traitement
			type : "POST", 
			data :"idduresultAAfficher=" + idresult,
			success: function(rep) {
				// alert(rep);
				var monTableauResultat = JSON.parse(rep);
				
				// alert(monTableauResultat);
				
				//	parti qui concerne les reponsses donner par le candidat
				//		$monTableauResultat["result"][0][0] //Nombre de question 
				//		$monTableauResultat["result"][$i][0] //Id de la $i question 
				//		$monTableauResultat["result"][$i][1] //les reponsses donn� true si cocher 
				//	A	$monTableauResultat["result"][$i][6] //les reponsses donn� false si d�cocher 
				//		$monTableauResultat["result"][$i][7] //reponses donn�e sous le meme format que dans les bonnne reponses des question (type "2e4e" pour une question ou les bonne reponses sont la 2 et la 4)
				
				//	Parti concernant les question et reponse de chaque question du test
				// 		$monTableauResultat["result"][$i][8] = $donnees['corect_question'];
				// 		$monTableauResultat["result"][$i][9] = $donnees['quest_question'];	
				// 		$monTableauResultat["result"][$i][10] = $donnees['rep1_question'];		
				// 	A	$monTableauResultat["result"][$i][15] = $donnees['rep6_question'];
				
				$('#visuelresultat').empty();	// on vide pour le cas ou on aurait deja regarder un resultat avant
				$('#visuelresultatJson').empty();	// Idem
				$('#visuelresultatJson').append(rep);	// on ajoute le json avec tout ce qu'il faut dedant 
				
				// ici on va construire notre premiere question avec son bouton next
				var nbdequestion = monTableauResultat["result"][0][0];
				//$('#visuelresultatJson').text()
				


				var idDeLaQuestion = monTableauResultat["result"][1][0];				
				var mesReponse = "<div id='laQuestion1' name='"+idDeLaQuestion+"'><h3>"+monTableauResultat["result"][1][9]+"</h3>";
				var numDeLareponse = 1;
				var reponsesdonnee = monTableauResultat["result"][1][7].split('e');
				var bonneReponses = monTableauResultat["result"][1][8].split('e');
				
				for (var i=1; i<7; i++) {
					if(monTableauResultat["result"][1][9+i] !=  "undefined" ){
						mesReponse = mesReponse + "<div class='intitule-reponse row'> <div class='col-lg-6'><div class='input-group groupreponse"+numDeLareponse+"'><span class='input-group-addon' >";
						mesReponse = mesReponse + "<input ";
						// If il a cocher on checked l'input
						jQuery.each( reponsesdonnee, function( i2, val ) {
							if(parseInt(val) === i)
								mesReponse = mesReponse + "checked";
						});
						//FIN DU  If il a cocher on checked l'input
						mesReponse = mesReponse + " type='checkbox' class='chkresult' id='checkbox1reponse"+numDeLareponse+"' disabled></span>";	
						mesReponse = mesReponse + "<input disabled='true' type='text' name='reponse"+numDeLareponse+"Q1' id='reponse"+numDeLareponse+"Q1' class='form-control resulttest";
						// If bonne reponse on entour en vert !!!!
						jQuery.each( bonneReponses, function( i2, val ) {
							if(parseInt(val) === i)
								mesReponse = mesReponse + " border-vert";
						});
						// FIN If bonne reponse on entour en vert !!!!
						mesReponse = mesReponse + "' value='"+monTableauResultat["result"][1][9+i]+"'>";
						mesReponse = mesReponse + " </div></div> </div>";
					}
				}
				$("#boutonNextQ,#boutonPreviousQ").val("1/"+nbdequestion);
				$('#affichageDuTestDetailler').empty(); 
				$('#affichageDuTestDetailler').append(mesReponse); //  on cconstruit notre premiere question avec differente reponses les question suivante seront construite sur le trigger du bouton next
				$('.visuelresultat').show();	// et on ajoute tout ca !!!
			}
		});
	});
	
	
	$("#boutonNextQ").click(function() {
		var monTableauResultat = JSON.parse($('#visuelresultatJson').text());
		valuedelaquestion = $(this).val().split('/');			// on split la valu de notre bouton qui sert a nous situer dans le quizz
		cbDeQuestionAuTotal = valuedelaquestion[1];				// ici le nombre total de question (?/10)
		numQuestion =  parseInt(valuedelaquestion[0]);						// ici la question en cour  (7/?)
		numQuestion++;

		if(valuedelaquestion[0] === valuedelaquestion[1]){		// si on est a la fin du quizz
			alert("Derniere question")
		}else{
			var idDeLaQuestion = monTableauResultat["result"][numQuestion][0];				
			mesReponse = "<div  name='"+idDeLaQuestion+"'><h3>"+monTableauResultat["result"][numQuestion][9]+"</h3>";
			var numDeLareponse = 1;

			var reponsesdonnee = monTableauResultat["result"][numQuestion][7].split('e');
			var bonneReponses = monTableauResultat["result"][numQuestion][8].split('e');
			for (var i=1; i<7; i++) {
				if(monTableauResultat["result"][numQuestion][9+i] !=  "undefined" ){
					mesReponse = mesReponse + "<div class='intitule-reponse row'> <div class='col-lg-6'><div class='input-group groupreponse"+numDeLareponse+"'><span class='input-group-addon' >";
					mesReponse = mesReponse + "<input ";
					// If il a cocher on checked l'input
					jQuery.each( reponsesdonnee, function( i2, val ) {
						if(parseInt(val) === i)
							mesReponse = mesReponse + "checked";
					});
					//FIN DU  If il a cocher on checked l'input
					mesReponse = mesReponse + " type='checkbox' id='checkbox1reponse"+numDeLareponse+"' aria-label='...'></span>";	
					mesReponse = mesReponse + "<input disabled='true' type='text' name='reponse"+numDeLareponse+"Q1' id='reponse"+numDeLareponse+"Q1' class='form-control";
						// If bonne reponse on entour en vert !!!!
						jQuery.each( bonneReponses, function( i2, val ) {
							if(parseInt(val) === i)
								mesReponse = mesReponse + " border-vert";
						});
						// FIN If bonne reponse on entour en vert !!!!
						mesReponse = mesReponse + "' value='"+monTableauResultat["result"][numQuestion][9+i]+"'>";
					mesReponse = mesReponse + " </div></div> </div>";
				}
			}
			$("#boutonNextQ,#boutonPreviousQ").val(numQuestion+"/"+cbDeQuestionAuTotal);
			$('#affichageDuTestDetailler').empty(); 
			$('#affichageDuTestDetailler').append(mesReponse);
		}
	});	
	$("#boutonPreviousQ").click(function() {
		var monTableauResultat = JSON.parse($('#visuelresultatJson').text());
		valuedelaquestion = $(this).val().split('/');			// on split la valu de notre bouton qui sert a nous situer dans le quizz
		cbDeQuestionAuTotal = valuedelaquestion[1];				// ici le nombre total de question (?/10)
		numQuestion = parseInt(valuedelaquestion[0]);						// ici la question en cour  (7/?)
		numQuestion--;			

		if(valuedelaquestion[0] === "1"){		// si on est a la fin du quizz
			alert("Premiere question")
		}else{
			var idDeLaQuestion = monTableauResultat["result"][numQuestion][0];				
			mesReponse = "<div name='"+idDeLaQuestion+"'><h3>"+monTableauResultat["result"][numQuestion][9]+"</h3>";
			var numDeLareponse = 1;
			var reponsesdonnee = monTableauResultat["result"][numQuestion][7].split('e');
			var bonneReponses = monTableauResultat["result"][numQuestion][8].split('e');
			
			for (var i=1; i<7; i++) {
				if(monTableauResultat["result"][numQuestion][9+i] !=  "undefined" ){
					mesReponse = mesReponse + "<div class='intitule-reponse row'> <div class='col-lg-6'><div class='input-group groupreponse"+numDeLareponse+"'><span class='input-group-addon' >";
					mesReponse = mesReponse + "<input ";
					// If il a cocher on checked l'input
					jQuery.each( reponsesdonnee, function( i2, val ) {
						if(parseInt(val) === i)
							mesReponse = mesReponse + "checked";
					});
					//FIN DU  If il a cocher on checked l'input
					mesReponse = mesReponse + " type='checkbox' id='checkbox1reponse"+numDeLareponse+"' aria-label='...'></span>";	
					mesReponse = mesReponse + "<input disabled='true' type='text' name='reponse"+numDeLareponse+"Q1' id='reponse"+numDeLareponse+"Q1' class='form-control";
					// If bonne reponse on entour en vert !!!!
					jQuery.each( bonneReponses, function( i2, val ) {
						if(parseInt(val) === i)
							mesReponse = mesReponse + " border-vert";
					});
					// FIN If bonne reponse on entour en vert !!!!
					mesReponse = mesReponse + "' value='"+monTableauResultat["result"][numQuestion][9+i]+"'>";
					mesReponse = mesReponse + " </div></div> </div>";				}
			}
			
			$("#boutonNextQ,#boutonPreviousQ").val(numQuestion+"/"+cbDeQuestionAuTotal);
			$('#affichageDuTestDetailler').empty(); 
			$('#affichageDuTestDetailler').append(mesReponse);
		}
	});
	//------------- RESULTAT __________
});