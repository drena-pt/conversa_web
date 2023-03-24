<!doctype html>
<!-- Desenvolvido por João Sá, João Devesa e Guilherme Albuquerque em 2023 -->
<html lang="pt">
<head>
	<!-- Coisas básicas -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="/img/favicon.png"/>
	<meta property="og:site_name" content="conversa"/>
	<title>conversa Beta</title>
    <meta name="theme-color" content="#150f29"/>
	<!-- jQuery, jQuery form, JS Cookie -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.min.js"></script>
	<!-- DateJS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js" integrity="sha512-/n/dTQBO8lHzqqgAQvy0ukBQ0qLmGzxKhn8xKrz4cn7XJkZzy+fAtzjnOQd5w55h4k1kUC+8oIe6WmrGUYwODA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="https://testes.altadrena.com/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<script>
		if(!('ontouchstart' in window)){
			$(function (){ $('[data-toggle="tooltip"]').tooltip() })
		}
	</script>
	<!-- SocketIO -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <!-- Estilos -->
    <style>
        @font-face{font-family:"MADE TOMMY Regular";src:url("/fontes/MADE TOMMY Regular.otf")}
        @font-face{font-family:"MADE TOMMY Bold";src:url("/fontes/MADE TOMMY Bold.otf")}
        @font-face{font-family:"MADE TOMMY Bold Outline";src:url("/fontes/MADE TOMMY Bold Outline.otf")}
        @font-face{font-family:"SourceSansPro";src:url("/fontes/SourceSansPro.ttf")}
        body{
            background-image: linear-gradient(-90deg,rgb(0,0,0),rgb(12, 0, 53),rgb(12, 0, 53),rgb(0,0,0));
        }
        small{
            font-size: 13px;
            color: #d4c7ff;
        }
    </style>
	<script>
	//Função decodificadora do token
	function decodeJWT(token) {
			const base64Url = token.split('.')[1];
			const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
			const jsonPayload = decodeURIComponent(
				atob(base64)
				.split('')
				.map(function (c) {
					return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
				})
				.join('')
			);
			return JSON.parse(jsonPayload);
	}
	//Função ligação à API
	function api(api_url, api_data, api_token=false, api_contentType) {
		var err;
		var jqXHR = $.ajax({
			url: api_url,
			method: 'post',
			contentType: api_contentType,
			data: api_data,
			processData: true,
			async: false,
			beforeSend: function(xhr) {
				if (api_token==true){
					xhr.setRequestHeader ('Authorization', Cookies.get('drena_token'));
				}
			},
			error: function (jqXHR, exception) {
				if (jqXHR.status === 0) {
					err = 'Not connect. Verify Network.';
				} else if (exception === 'parsererror') {
					err = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					err = 'Time out error.';
				} else if (exception === 'abort') {
					err = 'Ajax request aborted.';
				} else {
					err = 'Uncaught Error.' + jqXHR.responseText;
				}
				if (err){console.error(err);}
			}
		});
		var result = JSON.parse(jqXHR.responseText);
		if (err){
			return "error";
		} else {
			return result;
		}
	}
	//TOKEN
	token = Cookies.get('drena_token');
	if (token){
		uti = api("https://drena.pt/api/uti", {"uti":decodeJWT(token).sub});
		console.debug("Utilizador logado:");
		console.debug(uti);
	} else {
		window.location.replace("https://drena.pt/entrar");
	}
	
	//Função para obter o tempo passado
	function tempoPassado(isoDate) {
		const date = new Date(isoDate);
		const now = new Date();
		const timePassed = now - date;
		const seconds = Math.floor(timePassed / 1000);
		const minutes = Math.floor(seconds / 60);
		const hours = Math.floor(minutes / 60);
		const days = Math.floor(hours / 24);
		const months = now.getMonth() - date.getMonth() + (12 * (now.getFullYear() - date.getFullYear()));
		const years = Math.floor(months / 12);
		if (years > 0) {
			return `Há ${years} ${years === 1 ? 'ano' : 'anos'}`;
		} else if (months > 0) {
			return `Há ${months} ${months === 1 ? 'mês' : 'meses'}`;
		} else if (days > 0) {
			return `Há ${days} ${days === 1 ? 'dia' : 'dias'}`;
		} else if (hours > 0) {
			return `Há ${hours} ${hours === 1 ? 'hora' : 'horas'}`;
		} else if (minutes > 0) {
			return `Há ${minutes} ${minutes === 1 ? 'minuto' : 'minutos'}`;
		} else {
			return `Há ${seconds} ${seconds === 1 ? 'segundo' : 'segundos'}`;
		}
	}
	</script>