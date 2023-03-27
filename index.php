<?php require('head.php'); ?>
    <style>
        .jumbotron1{
            height:90vh;
            background-image: linear-gradient(-90deg,rgb(12, 0, 53),rgb(0,0,0),rgb(9, 0, 37));
        }
        .jumbotron2{
            background-image: linear-gradient(90deg,rgba(255,255,255,0.2),rgba(0,0,0,0.2));
        }
    </style>
</head>
<body>
	<header class='sticky-top bg-dark shadow'>
        <nav class="px-4 px-xl-0 col-xl-6 offset-xl-3 navbar navbar-dark navbar-expand-sm">
            <a class="navbar-brand" href="/">
                <div class="row">
                    <img class="col pe-0" src="/img/logo.png" height="32" alt="" loading="lazy">
                </div>
            </a>
        </nav>
    </header>
		
    <div class="jumbotron1 d-flex justify-content-center align-items-center">

        <div class='row col-xl-6 p-xl-0 p-4'>
            <div class='col-xl-6 row'>
                <div class="col-7 col-xl-12">
                    <text>Conversa <span class="badge badge-pill bg-light text-dark">Beta</span></text>
                    <h1 class="display-4">
                        Junta-te à<br>
                        conversa<br>
                    </h1><br>
                </div>
                <div class="col-5 p-0 col-xl-12 d-flex justify-content-xl-start justify-content-end align-items-center">
                    <a href='/app' role='button' class='btn btn-conversa'>Entrar <i class="bi bi-arrow-right-circle"></i></a>
                </div>
            </div>
            <div class='col-xl-6 col-12 d-flex align-items-center'>
                <div class="bg-primary bg-gradient rounded-xl shadow text-light p-4 w-100">
                    <div class="d-flex justify-content-between align-items-center my-2">
                        <div class="d-flex flex-row">
                            <img id="img_uti_fpe" class="me-3 rounded-circle" height="64">
                            <span>
                                <h3 id="text_uti_nut" class="mb-0"></h3>
                                <small>Conectado</small>
                            </span>
                        </div>
                        <a href="https://drena.pt/definicoes">
                            <i class="bi bi-gear h5 text-light"></i>
                        </a>
                    </div>
                    <!-- <a class="float-sm-end btn btn-light" href='https://drena.pt/pro/sair'>Terminar sessão <i class="bi bi-box-arrow-right"></i></a> -->
                </div>
                <!-- <img style='height:60vh;' src="/img/chat-03.png"> -->
                <script>
                    if (uti){
                    $("#text_uti_nut").html(uti.nut);
                    $("#img_uti_fpe").attr("src", uti.fpe);
                    }
                </script>
            </div>
        </div>

    </div>

    <div id='sobre' class="bg-conversa jumbotron2">
        <div class='row px-xl-0 p-4 col-xl-6 offset-xl-3'>
            <div class='col-xl-6 col-12 pb-2 p-0 text-center'>
                <img style='height:80vh' src="/img/telemovel.png">
            </div>
            <div class='col-xl-6 col-12 row d-flex justify-content-start align-items-center'>
                <div>
                    <h1 class='display-4'>
                        <span class='text-outline'>A forma mais </span>drena
                        <span class='text-outline'> de conversar.</span>
                    </h1>
                    <p>Uma aplicação de chat como as outras,<br>mas melhor.<br><br>
                    Alojada em Portugal com a missão de manter a integridade e segurança das conversas.</p>
                    <!-- <a href='#download' role='button' class='btn btn-light'>Descarrega agora <i class="bi bi-file-arrow-down"></i></a> -->
                </div>
                
            </div>
        </div>
    </div>

    <!-- <div id='download' class='p-5 col-xl-6 offset-xl-3 text-center'>
        <h2 class='display-5 m-4'>
            Descarrega a aplicação
        </h2>
        <p>Versão atual 1.1.3</p>
        <a href='download.html#android' role='button'><img src="/img/google_play.png" width="200"></a><br>
        <p>ou</p>
        <a href='download.html#apk' role='button' class='btn btn-conversa'>Descarregar .APK <i class="bi bi-file-arrow-down"></i></a>
    </div> -->

    <footer class="footer m-auto p-5 bg-dark text-center">
        <div class="row">
            <div class="col-sm">
                <img src="https://drena.pt/imagens/logo.png" height="32" title="drena" loading="lazy"><br>
                <text>Copyright © 2023 | drena</text><br>
                <a class="small text-light" href="https://drena.pt/politicas.php">Termos e condições</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm">
                <a class="text-light" href="https://facebook.com/drena.pt"><i class="bi bi-facebook"></i></a>
                <a class="text-light" href="https://instagram.com/drena.pt"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>