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
    <!-- Socket -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
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


<div class="col-xl-6 offset-xl-3 bg-dark"><div class="p-4 bg-conversa bg-opacity-10 vh-100">

<?php
if ($_GET["id"]){
    echo '
    <div class="row">
        <h1><a href="/app" class="text-light"><i class="h4 bi bi-arrow-left"></i></a> conversa</h1>
    
        <section id="erro_offline" class="w-50 mx-auto alert text-center bg-opacity-10 bg-vermelho border-vermelho d-none">
            <text><i class="h4 bi bi-exclamation-triangle"></i><br>Estás disconectado</text>
        </section>
    
        <div id="conversa" class="mh-100 overflow-visible">
        </div>
    
        <form id="form_mensagem" class="position-absolute bottom-0 start-50 translate-middle-x">
            <div class="d-flex p-3 col-xl-6 offset-xl-3">
                <div class="flex-grow-1 me-2">
                    <input id="input_mensagem" autocomplete="off" autofocus class="form-control border-0 bg-dark" placeholder="Mensagem">
                </div>
                <div>
                    <button class="btn btn-conversa"><i class="bi bi-send"></i></button>
                </div>
            </div>
        <form>

    </div>
    ';
} else {
    echo "
    <div class='row'>
        <h1>as tuas conversas</h1>

        <section id='erro_offline' class='w-50 mx-auto alert text-center bg-opacity-10 bg-vermelho border-vermelho d-none'>
            <text><i class='h4 bi bi-exclamation-triangle'></i><br>O sistema está offline</text>
        </section>

        <section id='carregando' class='text-center p-4'>
            <div class='spinner-border' role='status'>
                <span class='sr-only'></span>
            </div>
        </section>

        <section>
            <button onclick='alert(`Ainda não funciona :)`)' class='btn btn-conversa'>Nova conversa <i class='bi bi-chat-left-text'></i></button>
        </section>

        <div id='lista_conversas'>
        </div>

        <div id='lista_utilizadores' class='row row-cols-1 row-cols-md-2'>
        </div>

    </div>
    ";
    
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
}
?>

</div></div>


<?php

$mensagem = '
<div class="d-flex flex-row">
    <img src="`+fpe[data.username]+`" class="mt-4 me-2 rounded-circle" height="32">
    <span class="col" id="`+data.id+`">
        <small>`+data.username+`</small><br>
        <text>`+data.content+`</text><br>
    </span>
</div>
';

?>

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
//TOKEN
token = Cookies.get('drena_token');
if (token){
    uti = decodeJWT(token).sub;
} else {
    window.location.replace("https://drena.pt/entrar");
}
uti = decodeJWT(Cookies.get('drena_token')).sub;
//Função ligação à API
function api(api_url, api_data, api_token=false) {
    var err;
    var jqXHR = $.ajax({
        url: api_url,
        method: 'post',
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

<?php
if ($_GET["id"]){
    echo "<!--";
}
?>
<script>
//LISTA CONHECIDOS
/* if (uti){
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
//criar_chat();


//Obter conversas
conversas = api('https://conversa.drena.pt:3000/getChatsByUser', null, true);
$("#carregando").addClass("d-none");
if (conversas=="error"){
    $("#erro_offline").removeClass("d-none");
} else {
    console.debug(conversas);
    //Ordena a array por data da última mensagem em cada conversa
    conversas.sort((a, b) => {
        const aDate = new Date(a.lastMessages[0].date);
        const bDate = new Date(b.lastMessages[0].date);
        return bDate - aDate;
    });
    $.each(conversas, function (k, d) {
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
}
</script>
<?php
if ($_GET["id"]){
    echo "-->";
}
?>


<?php
if (!$_GET["id"]){
    echo "<!--";
}
?>
<script>
    const socket = io('https://conversa.drena.pt:3000');

    socket.on('connect', () => {
        socket.emit('enterChat', {'id': '<?php echo $_GET['id'];?>', 'token': token});
        console.debug('Connected to server');
        $("#erro_offline").addClass("d-none");
    });

    socket.on('getMessages', (data) => {
        console.log('getMessages:', data);
    });

    socket.on('disconnect', () => {
        $("#erro_offline").removeClass("d-none");
        console.debug('Disconnected to server');
    });

    var ultimo_uti;
    var ultimo_id;
    var fpe = [];

    socket.on('message', (data) => {
        console.log('message:', data);

        if (!fpe[data.username]){
            res_api = api('https://drena.pt/api/uti', {'uti': data.username});
            fpe[data.username] = res_api.fpe;
        }

        if (ultimo_uti==data.username){
            $('#'+ultimo_id).append(`<text>`+data.content+`</text><br>`);
        } else {
            $('#conversa').append(`<?php echo preg_replace( "/\r|\n/", "", $mensagem); ?>`);
            ultimo_id = data.id;
        }

        ultimo_uti = data.username;
    });

    $('#form_mensagem').on('submit', function(e) {
		e.preventDefault();
		var mensagem = $('#input_mensagem').val();

        socket.emit('message', mensagem);

        ultimo_uti = null;

        $("#conversa").append("<div class='text-end'>"+mensagem+"<b><div>");

		$('#input_mensagem').val('');
	});
</script>
<?php
if (!$_GET["id"]){
    echo "-->";
}
?>

</body>
</html>