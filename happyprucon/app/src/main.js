$(function() {

	var app_id = '128324841091354';
	var scopes = 'email, user_friends, user_online_presence';

	var btn_login = '<a href="#" type="submit" id="login" class="btn btn-block btn-social  btn-circle blue-steel" style="text-align: center" ><span class="fa fa-facebook"></span> INGRESA CON FACEBOOK </a>';

	var div_session = "<div id='facebook-session'>"+
					  "<strong></strong>"+
					  "<img>"+
					  "<a href='#' type='submit' id='logout' class='btn btn-block btn-social  btn-circle blue-steel' style='text-align: center'  > CERRAR SESIÓN </a>"+
					  "</div>";

	window.fbAsyncInit = function() {

	  	FB.init({
	    	appId      : app_id,
	    	status     : true,
	    	cookie     : true, 
	    	xfbml      : true, 
	    	version    : 'v2.8'
	  	});


	  	FB.getLoginStatus(function(response) {
	    	statusChangeCallback(response, function() {});
	  	});
  	};

  	var statusChangeCallback = function(response, callback) {
  		console.log(response);

    	if (response.status === 'connected') {
      		getFacebookData();
    	} else {
     		callback(false);
    	}
  	}

  	var checkLoginState = function(callback) {
    	FB.getLoginStatus(function(response) {
      		callback(response);
    	});
  	}

  	var getFacebookData =  function() {
  		FB.api('/me', 'GET',
		{"fields":"email,first_name,last_name,id,gender"},
		function(response) {

  			if(response != "") {
                $('#login').after(div_session);
                $('#login').remove();
                usrNombre = response.first_name;
                usrApellidos = response.last_name;
                usrCorreo = response.email;

                document.getElementById("nom-face").value = usrNombre;
                document.getElementById("ape-face").value = usrApellidos;
                document.getElementById("mail").value = usrCorreo;

                document.forms["form-face"].submit();
            }
			
			
	  	});
  	}

  	var facebookLogin = function() {
  		checkLoginState(function(data) {
  			if (data.status !== 'connected') {
  				FB.login(function(response) {
  					if (response.status === 'connected')
  						getFacebookData();
  				}, {scope: scopes});
  			}
  		})
  	}

  	var facebookLogout = function() {
  		checkLoginState(function(data) {
  			if (data.status === 'connected') {
				FB.logout(function(response) {
					$('#facebook-session').before(btn_login);
					$('#facebook-session').remove();
				})
			}
  		})

  	}



  	$(document).on('click', '#login', function(e) {
  		e.preventDefault();

  		facebookLogin();
  	})

  	$(document).on('click', '#logout', function(e) {
  		e.preventDefault();

  		if (confirm("¿Está seguro?"))
  			facebookLogout();
  		else 
  			return false;
  	})

})