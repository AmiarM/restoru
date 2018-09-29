function emoticones() {

	$("#em_oui").click(function () {var present = $('#message').val();	$('#message').val(present+" :) ");});
	$("#em_p").click(function () {var present = $('#message').val();	$('#message').val(present+" :P ");});
	$("#em_non").click(function () {var present = $('#message').val();	$('#message').val(present+" :( ");});
	$("#em_loveit").click(function () {var present = $('#message').val();	$('#message').val(present+" [love] ");});
	$("#em_bigsmile").click(function () {var present = $('#message').val();	$('#message').val(present+" :D ");});
	$("#em_wink").click(function () {var present = $('#message').val();	$('#message').val(present+" [wink] ");});
	
}

function lire(page) {

	var lecture = $.ajax({
						type: "GET",
						url: "activebook/actions/select.php",
						data : "page="+page,
						async: false
					}).responseText;
						$('#letout').hide();
						$('#letout').html(lecture) ;
						$('#letout').fadeIn("slow");

// PAGINATION
$('.changepage').click(function () {						 
	id = $(this).attr('id');
	lire (id);
});


// post click function
$('#poster').click(function () {
	$(this).toggleClass("poster2");		 						 
	if ($(".divpost:first").is(":hidden")) {
        $(".divpost").slideDown("slow");
		$(this).html("Ovrir le panel");
	}
	else {
       $(this).html("Fermer le panel");
	   $(".divpost").slideUp();
	}
});

emoticones();

// When Form is submitted
$('#menu1').bind('click', function() {

	// Loading
	$("#result").ajaxStart(function(){
		
		document.getElementById('loading').innerHTML="<img src='activebook/img/loader.gif'> Loading..." ;
	 });
	// Hide loading
	$("#result").ajaxStop(function(){
		
		document.getElementById('loading').innerHTML=" " ;
	 });
	
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	var pseudo = $('#pseudo').val();
	var message = $('#message').val();
	var email = $('#email').val();

	if (email == 'Your email') {
		$('#formulaire .erreur').html('Your address email must be specified ! (Gravatar)');
		$('#formulaire .erreur').fadeIn().delay(4000).fadeOut();
		return false;
	}
	else if(!emailReg.test(email)) {
		$('#formulaire .erreur').html('This email address is invalide ! (Gravatar)');
		$('#formulaire .erreur').fadeIn().delay(3000).fadeOut();
		return false;
	}
	if (pseudo == 'Your name') {
		$('#formulaire .erreur').html('Your name must be specified !');
		$('#formulaire .erreur').fadeIn().delay(3000).fadeOut();
		return false;
	}
	if (message == 'Write your comment here...'){
		$('#formulaire .erreur').html('You can not insert an empty comment !');
		$('#formulaire .erreur').fadeIn().delay(3000).fadeOut();
		return false;
	}
	else {
		// Send data variaple to insert.php
		var insert = $.ajax({
							type: "POST",
							url: "activebook/actions/insert.php",
							data: "message="+message+"&pseudo="+pseudo+"&email="+email,
							async: false,
							dataType: "text",
							success: function(data){
								
								if (data == 'flood') {
			
									$('#formulaire .erreur').html('Antiflood measure, you must wait a few minute before posting again.');
									$('#formulaire .erreur').fadeIn().delay(8000).fadeOut();
									return false;
								}
								else if (data == 'trop') {
								
									$('#formulaire .erreur').html('Your message is too long, shorten him !');
									$('#formulaire .erreur').fadeIn().delay(4000).fadeOut();
									return false;
								}
								else {
									
									lire(page);
								}
							}
		}).responseText;
	}
});

//

//FONCTIONS ADMINISTRATIONS
// Show admin panels
$("#deco").click(function () {
	$.ajax({
			type: "POST",
			url: "activebook/actions/deco.php",
			success: function(){
				lire(page); // Reload select.php   
			}
	});	  
});


$("#admin").click(function () {

// Emptied fields
$('#formulaire').html('<div class="administration" id="poster">Administration </div><div><input name="admin" type="text" class="ib_input" id="admin" value="Username" onblur="if(this.value == "") { this.value="Username"}" onfocus="if (this.value=="Username") {this.value=""} else {(this.value=="Username")}"/><input name="passe" type="password" class="ib_input" id="passe" value="Password"  /><br /><input type="button" class="ib_button" id="adminpost" value="Login" /> <input type="button" class="ib_button" onclick="history.go(0)" value="Cancel" /></div>') ;


// Emptied fields (onfocus)
var etatPseudoAdm = 0 ;
var etatMdpAdm = 0 ;
$('#admin').bind('focus',function(){
if (etatPseudoAdm==0){
    etatPseudoAdm=1;
    $(this).val("");
}
});
$('#passe').bind('focus',function(){
if (etatMdpAdm==0){
    etatMdpAdm=1;
    $(this).val("");
}

});

$('#adminpost').bind('click',function(){
login = $('#admin').val();
mdp = $('#passe').val();
var html = $.ajax({
  type: "POST",
  url: "activebook/actions/log.php",
  data : "login="+login+"&mdp="+mdp,
  async: false
 }).responseText;
$('#admin').val("");
$('#passe').val("");
if (html=="1"){
$('#formulaire').html('<div class="administration" id="poster">Administration </div><div class="success">You have successfully logged in</div><div><input name="admin" type="text" class="ib_input" id="admin" value="Pseudo"  /><input name="passe" type="text" class="ib_input" id="passe" value="Mot de passe"  /><br /><input type="button" class="ib_button" id="adminpost" value="Login" /> <input type="button" class="ib_button" onclick="history.go(0)" value="Cancel" /></div>') ;
lire(1);
}else if (html=="2"){
	$('#formulaire').html('<div class="administration" id="poster">Administration </div><div class="erreur">Wrong username or password !</div><div><input name="admin" type="text" class="ib_input" id="admin" value="Pseudo"  /><input name="passe" type="text" class="ib_input" id="passe" value="Mot de passe"  /><br /><input type="button" class="ib_button" id="adminpost" value="Login" /> <input type="button" class="ib_button" onclick="history.go(0)" value="Cancel" /></div>') ;
}
										  });
								 });
							//
// Remove comment
$(".delete").click(function () {

	id = $(this).attr("id");				    
	$.ajax({
		   type: "POST",
		   url: "activebook/actions/delete.php",
		   data: "id="+id,
		   success: function(){ 
			lire(page); // reload select.php  
		   }
	});	  
});

// Update comment
$(".update").click(function () {
							 
id = $(this).attr("id");
 var html = $.ajax({
  url: "activebook/actions/select.php",
  data: "id="+id+"&page="+page,
  async: false
 }).responseText;
 
// Emptied text field
$('#letout').html(html);
 $(".updatemes").blur(function () { 
	id = $(this).attr("id");
	message = $(this).val();
	
	//
	 $.ajax({
   type: "POST",
   url: "activebook/actions/update.php",
   data: "message="+message+"&id="+id,
   success: function(){
//On actualise select.php   
 lire(page);

document.getElementById('message').value = "" ;
document.getElementById('pseudo').value = "" ;
document.getElementById('email').value = "" ;
   }
   
 });
								});
							 });

// Tooltip
$(".tooltips").hover(
	function() {$(this).contents("span:last-child").css({display: "block"});},
	function() {$(this).contents("span:last-child").css({display: "none"});}
);
$(".tooltips").mousemove(function(e) {
	var mousex = e.pageX + 10;
	var mousey = e.pageY + 5;
	$(this).contents("span:last-child").css({top: mousey, left: mousex});
});

$(".main .textinput").bind("change keyup", function (e) {
		key = e.which+" ";
		badkeys = "224 16 17 18 37 38 39 40 ";
		if ((badkeys.indexOf(key) == "-1") && ($("#submit_new").val() !== "Modifier *")) {
				$("#submit_new").val("Modifier *");
		}
});	

}

// Let's see the result
$(document).ready(function() {
	
	lire(1);
   
});