<!doctype html>
<!-- Desenvolvido por Guilherme Albuquerque 2023 -->
<html lang="pt">
<head>
	<!-- Coisas básicas -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="/favicon.png"/>
	<meta property="og:site_name" content="conversa - drena"/>
	<title>conversa Beta</title>
    <meta name="theme-color" content="#111111"/>
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
    <style>
        @font-face{font-family:"MADE TOMMY Regular";src:url("/fontes/MADE TOMMY Regular.otf")}
        @font-face{font-family:"MADE TOMMY Bold";src:url("/fontes/MADE TOMMY Bold.otf")}
        @font-face{font-family:"MADE TOMMY Bold Outline";src:url("/fontes/MADE TOMMY Bold Outline.otf")}
        @font-face{font-family:"SourceSansPro";src:url("/fontes/SourceSansPro.ttf")}
    </style>
    <style>
        body{
            background-image: linear-gradient(-90deg,rgb(0,0,0),rgb(12, 0, 53),rgb(12, 0, 53),rgb(0,0,0));
        }
        small{
            font-size: 13px;
            color: #d4c7ff;
        }
    </style>
</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>


<div class="col-xl-6 offset-xl-3 bg-dark"><div class="p-4 bg-conversa bg-opacity-10 vh-100">

    <div class='row'>
        <h1>conversa</h1>

        <section id="erro_offline" class="w-50 mx-auto alert text-center bg-opacity-10 bg-vermelho border-vermelho">
            <text><i class="bi bi-exclamation-triangle"></i> O sistema está offline</text>
        </section>

        <!-- <section id="carregando" class="text-center p-4">
            <div class="spinner-border" role="status">
                <span class="sr-only"></span>
            </div>
        </section> -->
        
        <a href="#" class="text-light text-decoration-none">
            <div class="d-flex flex-row my-2">
                <img src="https://media.drena.pt/fpe/RUiFOcCk.jpg" class="mt-1 me-2 rounded-circle" height="64">
                <span class="col">
                    <text class="h4">guilhae</text><br>
                    Olá amiiiggooo ahaha<br>
                    <small>há 15 horas</small>
                    
                </span>
            </div>
        </a>

    </div>

</div>


</body>
</html>