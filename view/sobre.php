<?php
    
    $cliente = null;
    $boolean = "false";
    require_once('controller/controllerHome.php');
    require_once('model/clienteClass.php');

    $controllerHome = new controllerHome();
    $pagina = $controllerHome->getPage();
    
    // Pegando o Cliente Logado
    if(!isset($_SESSION))session_start();

    if(isset($_POST['logout'])){
        echo "Sucesso";
        $boolean = false;
        session_destroy();
    }
   
    if(isset($_SESSION['cliente'])){
        $cliente = unserialize($_SESSION['cliente']);
        $boolean = true;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Mob'Share - Melhores Anuncios</title>
        <link rel="stylesheet" type="text/css" href="view/css/sobre.css">
        <script src="view/js/libs/jquery/jquery-3.3.1.js"></script>
        <script src="view/js/notify.js"></script>
        <script src="view/js/main.js"></script>
        <link rel="stylesheet" href="view/cms/font/awesome/all.css">
    </head>
    <body>
        <div id="main">
            <div class="container">
                <div class="modal">

                </div>
            </div>
            <header>
                <div id="imgPretaRgb">
                    <nav class="cor_site_padrao">
                        <div id="segura_nav">
                            <div id="logo">
                                <img src="view/imagem/mob.png" alt="logo" title="logo">
                            </div>
                            <i id="menu_icone_reposnsivo" class="fas fa-align-justify"></i>
                            <div class="segura_menu">
                                <ul>
                                    <li><a href="?home">INÍCIO</a></li>
                                    <li><a href="?melhores_anuncios">VEICULOS EM DESTAQUE</a></li>
                                    <li><a href="?principais_anuncios">VEÍCULOS A VENDA</a></li>
                                    <li><a href="?como_ganhar_dinheiro">GANHE DINHEIRO</a></li>
                                    <li><a href="?parceiros">SEJA UM PARCEIRO</a></li>
                                    <li><a href="?sobre">SOBRE NÓS</a></li>
                                </ul>
                            </div>
                            <div class="modoLogin" onload="verificarLogin(<?php $cliente ?>)">
                                <div class="segura_login">
                                    <div class="login_cadastro" id="login" style="width: 110px;">
                                        <a href="javascript:efetuarLogin()"><img src="view/imagem/login_amarelo.png" alt="login"><p>LOGIN</p></a>
                                    </div>
                                    <div class="login_cadastro" style="width: 160px;">
                                        <a href="javascript:getCadastro()"><img src="view/imagem/downloads2/cadastrar.png" alt="login"><p>CADATRAR-SE</p></a>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </nav>
                    <div class="caixa_texto_pages_all">
                        <h1 class="texto_primario_h1">Sobre a empresa</h1>
                        <p class="texto_secundario_p">Sobre a empresa Mob'share</p>
                    </div>
                </div>
            </header>
            <section>

            <?php 
                require_once('controller/controllerSobre.php');

                $controller_sobre = new ControllerSobre();

                $registro =  $controller_sobre->listar_sobre();

            ?>
                <div id="sobreEmpresaImgText">
                    <div id="textSobreEmpresa">
                        <h2><?=@$registro->getTitulo_sobre()?></h2>
                        <br>
                        <p>
                            <?=@$registro->getTexto_sobre()?>
                        </p>  
                    </div>
                    <figure id="imgEmpresa" style="background-image: url(view/upload/<?=@$registro->getFoto_sobre()?>);"> 
                    </figure>
                </div>
            </section>
            <div id="banner">
                 <div id="conteudo_banner">
                     <div id="caixa_banner">
                     </div>
                     <div id="texto_banner">
                         A sustentabilidade é nosso objetivo em conjunto com o compartilhamento de veículos!
                     </div>
                </div>
            </div>
            <section>
                <div id="alignMVV">
                    <div class="imgTextMVV">
                        <h2> MISSÃO</h2>
                        <br>
                        <figure>
                          <img src="view/upload/<?php echo($registro->getFoto_missao_sobre())?>" style="width:200px;height:200px;" alt="imagem">
                        </figure>
                        <p>
                            <?=@$registro->getTexto_missao_sobre()?>
                        </p>
                    </div>
                    <div class="imgTextMVV">
                        <h2> VISÃO</h2>
                        <br>
                        <figure>
                          <img src="view/upload/<?php echo($registro->getFoto_visao_sobre())?>" style="width:200px;height:200px;" alt="imagem">
                        </figure>
                        <p>
                           <?=@$registro->getTexto_visao_sobre()?>
                        </p>
                    </div>
                    <div class="imgTextMVV">
                        <h2> VALORES</h2>
                        <br>
                        <figure>
                          <img src="view/upload/<?php echo($registro->getFoto_valores_sobre())?>" style="width:200px;height:200px;" alt="imagem">
                        </figure>
                        <p>
                           <?=@$registro->getTexto_valores_sobre()?>
                        </p>
                    </div>
                </div>
            </section>
            <footer class="cor_site_padrao">
                <!--  Caixas que contem o contato e o navegar pelo site -->
                <div class="newsletter">
                    <div class="logo_mob">
                        <img src="view/imagem/mob.png" alt="logo">
                    </div>
                    <div class="segura_newsletter">
                        <form id="frmEmail" onsubmit="email_marketing_enviar(this)" action="router.php?controller=EMAIL_MARKETING&modo=INSERIR" method="POST">
                            <h3>Quer receber noticias?</h3>
                            <input type="text" name="txtEmail" placeholder="Insira seu email" class="input_newsletter">
                            <button class="botao_newsletter">Enviar</button>
                        </form>
                    </div>
                </div>

                <div class="contatos">
                    <div class="segura_mapa_contato">
                        <div class="segura_contatos">
                            <h3> Quer entrar em contato? </h3>
                            <div id="telefone_email">
                                <p>Telefone:  0800 755 855</p>
                                <p>Telefone:  0800 755 855</p>
                                <p>E-mail: atendimento@mobshare.com.br</p>
                                <img src="view/imagem/cracha_branco.png" alt="cracha">
                                <a href="?cms/home_cms">Área administrativa</a> 
                            </div>
                        </div>
                        <div class="mapa_site">
                            <h3> Navegue pelo site </h3>
                            <div class="coluna_mapa">
                                <a href="?melhores_anuncios">Melhores avaliações</a><br>
                                <a href="?termos_uso.php">Termos de uso</a><br>
                                <a href="?principais_anuncios.php">Principais anúncio</a><br>
                                <a href="?como_ganhar_dinheiro.php">Ganhe dinheiro</a><br>
                            </div>
                            <div class="coluna_mapa">
                                <a href="?sobre.php">Sobre a empresa</a><br>
                                <a href="?faq.php">F.A.Q</a><br>
                                <a href="?parceiros.php">Seja um parceio</a>                 
                            </div>
                        </div>
                    </div>
                    <!--  Caixas das redes sociais  -->
                    <div class="redes_sociais">
                        <p>Siga nós nas redes</p>
                        <div class="segura_rs" style="text-align: center;">
                            <a href="https://www.instagram.com/?hl=pt-br"><img src="view/imagem/instagram.png" alt="Instagran" title="Instagran"></a>
                            <a href="https://pt-br.facebook.com/"><img src="view/imagem/facebook.png" alt="facebook" title="Facebook"></a>
                            <a href="https://twitter.com/login?lang=pt" ><img src="view/imagem/twitter.png" alt="Twitter" title="Twitter" ></a>
                        </div>
                        <p>Baixe nosso aplicativo na playstore</p>
                        <div class="playstore">
                            <img class="center" style="display:block;" src="view/imagem/googleplay.png" alt="googleplay">
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script>
            $(document).ready(function(){
                if(<?php echo $boolean?>)
                    headerLogado();
                else
                    headerNaoLogado();
            });
        </script>
    </body> 
    
</html>