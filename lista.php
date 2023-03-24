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
        sup{
            font-size: 13px;
            color: #d4c7ff;
        }
    </style>
</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>


<div class="col-xl-6 offset-xl-3 bg-dark"><div class="p-4 bg-conversa bg-opacity-10 vh-100">

    <div class='row'>
        <h1>as tuas conversas</h1>

        <section id="erro_offline" class="w-50 mx-auto alert text-center bg-opacity-10 bg-vermelho border-vermelho d-none">
            <text><i class="h4 bi bi-exclamation-triangle"></i><br>O sistema está offline</text>
        </section>

        <section id="carregando" class="text-center p-4">
            <div class="spinner-border" role="status">
                <span class="sr-only"></span>
            </div>
        </section>



        <div id="lista_conversas">
        </div>


        <?php
        $caixa_utilizador = '
		    <div class="col pt-0 pb-2 p-1">
		    	<div class="alert border-primary bg-primary bg-opacity-25 d-flex align-items-center p-1 m-0" role="alert">
		    		<a class="perfil" href="https://drena.pt/u/\'+d.nut+\'">
		    		<img class="rounded-circle me-2" src="\'+d.fpe+\'" width="64">\'+d.nut+\'</a>
		    		<button onclick="criar_chat(`\'+d.nut+\'`)" class="btn btn-light ms-auto m-0 me-2">Criar <i class="bi bi-chat-left-text-fill"></i></button>
		    	</div>
            </div>
        ';

        $caixa_conversa = '
        <a href="/app?id=\'+d.id+\'" class="text-light text-decoration-none">
            <div class="d-flex flex-row my-2">
                <img src="\'+img_conversa+\'" class="mt-1 me-2 rounded-circle" height="64">
                <span class="col">
                    <text class="h5">\'+nome_conversa+\'</text><br>
                    \'+mensagem+\'<br>
                    <sup>\'+tempoPassado(d.lastMessages[0].date)+\'</sup>
                    
                </span>
            </div>
        </a>
        ';
        ?>

        <script>
        //Função ligação à API
        function api(api_url, api_data) {
            var jqXHR = $.ajax({
                url: api_url,
                method: 'post',
                data: api_data,
                processData: true,
                async: false,
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
            if (result['err']){
                alert(result['err']);
            } else {
                return result;
            }
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

        uti = decodeJWT(Cookies.get('drena_token')).sub;


        //LISTA CONHECIDOS
        /*if (uti){
            $.ajax({
                url: 'https://drena.pt/api/ob_ami',
                type: 'post',
                data: {"uti": uti},
                success: function (data) {
                    console.debug(data);

                    $.each(data, function (k, d) {
                        //console.log(d.nut);
                        $('#lista_utilizadores').append('<?php echo preg_replace( "/\r|\n/", "", $caixa_utilizador); ?>');
                    })

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
        }
        function criar_chat(pessoa){
            $.ajax({
                url: 'https://conversa.drena.pt:3000/startChat',
                type: 'post',
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({'receivers': [pessoa],'text': 'Olá!'}),
                beforeSend: function(xhr) {
                    xhr.setRequestHeader ('Authorization', Cookies.get('drena_token'));
                },
                success: function (data) {
                    console.debug(data);
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
        }
        */

        //Obter conversas
        $.ajax({
            url: 'https://conversa.drena.pt:3000/getChatsByUser',
            type: 'post',
            beforeSend: function(xhr) {
                xhr.setRequestHeader ('Authorization', Cookies.get('drena_token'));
            },
            success: function (data) {
                $("#carregando").addClass("d-none");

                console.debug(data);

                //Ordena a array por data da última mensagem em cada conversa
                data.sort((a, b) => {
                    const aDate = new Date(a.lastMessages[0].date);
                    const bDate = new Date(b.lastMessages[0].date);
                    return bDate - aDate;
                });

                $.each(data, function (k, d) {
                    if (d.type=="DIRECT_MESSAGE"){
                        res_api = api('https://drena.pt/api/uti', {'uti': d.users[0].username});
                        nome_conversa = d.users[0].username;
                        img_conversa = res_api.fpe;
                        mensagem = d.lastMessages[0].content;
                        if (d.lastMessages[0].username==uti){
                            mensagem = "<small>Eu: </small>"+mensagem;
                        }
                    } else {
                        nome_grupo = "Eu";
                        $.each(d.users, function (key, user) {
                            nome_grupo += ", "+user.username;
                        });
                        nome_conversa = nome_grupo;
                        img_conversa = "/grupo.jpg";
                        mensagem = d.lastMessages[0].content;
                        if (d.lastMessages[0].username==uti){
                            mensagem = "<small>Eu: </small>"+mensagem;
                        } else {
                            mensagem = "<small>"+d.lastMessages[0].username+": </small>"+mensagem;
                        }
                    }
                    $('#lista_conversas').append('<?php echo preg_replace( "/\r|\n/", "", $caixa_conversa); ?>');
                });

            },
            error: function (jqXHR, exception) {
                $("#carregando").addClass("d-none");

                if (jqXHR.status === 0) {
                    //err = 'Not connect. Verify Network.';
                    $("#erro_offline").removeClass("d-none");
                } else if (exception === 'parsererror') {
                    err = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    err = 'Time out error.';
                } else if (exception === 'abort') {
                    err = 'Ajax request aborted.';
                } else {
                    err = 'Uncaught Error.' + jqXHR.responseText;
                }
                if (err){alert(err);}
            }
        });
        </script>

        <div id="lista_utilizadores" class="row row-cols-1 row-cols-md-2">
        </div>

    </div>

</div>


</body>
</html>