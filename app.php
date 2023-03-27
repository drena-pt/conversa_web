<?php require('head.php');?>
    <style>
    #conversa{
        max-height: calc(100vh - 200px);
        height: calc(100vh - 200px);
        overflow-x:hidden;
    }

    /* Scrollbar */
    #conversa::-webkit-scrollbar {
        width: 6px;
    }
    #conversa::-webkit-scrollbar-track {
        background: transparent;
    }
    #conversa::-webkit-scrollbar-thumb {
        background-color: rgba(255,255,255,0.2);
        border-radius: 8px;
        border: none;
    }
    </style>
    <script>
        function Som(){
            var audio = document.getElementById("notification_sound");
            audio.play();
        }
    </script>
</head>
<body>

<audio id="notification_sound"><source src='sounds/sons_mod1.mp3'></audio>

<div id="erro_offline" class="position-absolute w-100 h-100 bg-opacity-75 bg-dark d-none" style="z-index: 10;">
    <section class="position-absolute top-50 start-50 translate-middle alert bg-opacity-75 bg-dark border-vermelho p-0">
        <div class="alert text-center bg-opacity-10 bg-vermelho m-0 px-5">
            <text><i class="h4 bi bi-exclamation-triangle"></i><br>Estás disconectado</text>
        </div>
    </section>
</div>

<div class="col-xl-6 offset-xl-3 bg-dark"><div class="p-0 bg-conversa bg-opacity-10 vh-100">

<?php
if ($_GET["id"]){
    echo '
    
    <div class="d-flex flex-row p-3 align-items-center bg-opacity-25 bg-dark">
        <a href="/app" class="text-light"><i class="h4 bi bi-arrow-left"></i></a>
        <img id="conversa_icon" class="mt-1 me-2 rounded-circle" height="64">
        <span class="col"><h3 id="conversa_title" class="mt-1 mb-0"></h3>
        <small> </small></span>
    </div>
    
    <section class="pe-2">
        <div id="conversa" class="p-4"></div>
    </section>
    
    <section class="row">
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
    </section>

    ';
} else {
    echo "
    <div class='p-4'>
        <h1>as tuas conversas</h1>

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

$mensagem2 = '
<div class="d-flex flex-row">
    <img src="`+fpe[f_user]+`" class="mt-4 me-2 rounded-circle" height="32">
    <span class="col" id="`+f_id+`">
        <small>`+f_user+`</small><br>
        <text>`+f_msg+`</text><br>
    </span>
</div>
';
?>

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
} */


//startChat = api('https://conversa.drena.pt:3000/startChat', JSON.stringify({'receivers': ['Devas','phi19','Leonor'],'text': 'Olá!'}), true, 'application/json');


//Obter conversas
conversas = api('https://conversa.drena.pt:3000/getChat', null, true, null);

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
            img_conversa = "/img/grupo.jpg";
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
    // FUNÇÕES (Início)
    var ultimo_uti;
    var ultimo_id;
    var fpe = [];

    function carregar_fpe(f_user){
        api_res = api('https://drena.pt/api/uti', {'uti': f_user});
        fpe[f_user] = api_res.fpe;
    }

    function renderizarMensagem(f_id,f_msg,f_user){
        if (f_user==uti.nut){
            $('#conversa').append("<div id='"+f_id+"' class='text-end'>"+f_msg+"<b><div>");
        } else {
            if (ultimo_uti==f_user){
                $('#'+ultimo_id).append(`<text>`+f_msg+`</text><br>`);
            } else {
                $('#conversa').append(`<?php echo preg_replace( "/\r|\n/", "", $mensagem2); ?>`);
                ultimo_id = f_id;
            }
        }
        ultimo_uti = f_user;
    }

    function irParaBaixo(){
        $("#conversa").stop().animate({ scrollTop: $("#conversa")[0].scrollHeight}, 0);
    }
    // FUNÇÕES (Fim)


    chatID = '<?php echo $_GET['id'];?>';
    const socket = io('https://conversa.drena.pt:3000');

    socket.on('connect', () => {
        socket.emit('enterChat', {'id': chatID, 'token': token});
        $("#erro_offline").addClass("d-none");
        console.debug('Connected to server');

        ultimas_mensagens = api('https://conversa.drena.pt:3000/getMessages', JSON.stringify({"chatId": chatID}), true, 'application/json');
        console.debug("Ultimas mensagens:");
        console.debug(ultimas_mensagens);

        
        conversa_info = api('https://conversa.drena.pt:3000/getChat', JSON.stringify({"chatId": chatID}), true, 'application/json');
        conversa_info = conversa_info[0];
        console.debug("Info da conversa:");
        console.debug(conversa_info);

        //Carrega as fotos de utilizador
        $.each(conversa_info.users, function (k, d) {
            carregar_fpe(d.username);
        });

        //Escolhe o icon e o nome da conversa
        if (conversa_info.type=="DIRECT_MESSAGE"){
            conversa_title = conversa_info.users[0].username;
            conversa_icon = fpe[conversa_info.users[0].username];
        } else {
            conversa_title = "Eu";
            $.each(conversa_info.users, function (k, d) {
                conversa_title += ", "+d.username;
            });
            conversa_icon = "/img/grupo.jpg";
        }
        $("#conversa_title").html(conversa_title);
        $("#conversa_icon").attr("src", conversa_icon);

        //Renderiza as mensagens
        $.each(ultimas_mensagens.reverse(), function (k, d) {
            renderizarMensagem(d.id,d.content,d.username);
        });
        irParaBaixo()
    });

    socket.on('disconnect', () => {
        $("#erro_offline").removeClass("d-none");
        console.debug('Disconnected to server');
    });

    socket.on('message', (data) => {
        console.log('message:', data);

        renderizarMensagem(data.id,data.content,data.username);
        irParaBaixo()
        Som()
    });

    $('#form_mensagem').on('submit', function(e) {
		e.preventDefault();
		var mensagem = $('#input_mensagem').val();

        socket.emit('message', mensagem);

        ultimo_uti = null;

        $("#conversa").append("<div class='text-end'>"+mensagem+"<b><div>");

		$('#input_mensagem').val('');

        irParaBaixo()
	});
</script>
<?php
if (!$_GET["id"]){
    echo "-->";
}
?>

</body>
</html>