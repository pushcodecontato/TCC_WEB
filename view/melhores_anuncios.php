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

    /* LISTA TIPO VEICULO */
    require_once('controller/controllerTipo_veiculo.php');
    require_once('controller/controllerAnuncios.php');
    $controllerAnuncio = new ControllerAnuncios();

    $anuncios = $controllerAnuncio->listar_anunciosProcesssados();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mob'Share - Melhores Anuncios</title>
        <link rel="stylesheet" type="text/css" media="screen" href="view/css/melhores_anuncios.css"/>
        <script src="view/js/libs/jquery/jquery-3.3.1.js"></script>
        <script src="view/js/notify.js"></script>
        <script src="view/js/main.js"></script>
        <script src="view/js/melhores_anuncios.js"></script>
        <link rel="stylesheet" href="view/cms/font/awesome/all.css">
    </head>
    <body>
        <div id="principal">
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
                        <h1 class="texto_primario_h1">Veículos em Destaques</h1>
                        <p class="texto_secundario_p"> Os Melhores Anúncios</p>
                    </div>
                </div>
            </header>
            <div id="conteudo">
                <?php
                    require_once("controller/controllerTipo_veiculo.php");

                    $controllerTipo = new ControllerTipoVeiculo();

                    $tipos = $controllerTipo->listar_tipo();
                ?>
                <form id="pesquisa">
                    <div id="explicao_como_alugar">
                        <div class="combo_box">
                            <label>Tipo de veículo</label><br>
                            <select name="tipo" onchange="getMarcas(this.value)">
                                <option value="0">Selecione o tipo</option>
                                <?php if(count($tipos) > 0){?>
                                    <?php foreach($tipos as $tipo){?>
                                        <option value="<?=@$tipo->getId()?>"><?=@$tipo->getNome()?></option>
                                    <?php }?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="combo_box">
                            <label>Marca</label><br>
                            <select name="marcas" onchange="getModelos(this.value)">
                                <option value="0">Selecione a marca</option>
                            </select>
                        </div>
                        <div class="combo_box">
                            <label>Modelo</label><br>
                            <select name="modelos" onchange="anuncios_filtrar()">
                                <option value="0">Selecione o modelo</option>
                            </select>
                        </div>
                        <div class="combo_box">
                            <input type="button" onclick="anuncios_filtrar()" class="btn_filtro" value="Filtrar">
                        </div>
                    </div>
                </form>
                <div id="segura_anuncios">
                    <?php

                        require_once('controller/controllerAnuncios.php');
                        $controllerAnuncio =  new ControllerAnuncios();

                        $anuncios = $controllerAnuncio->listar_anunciosProcesssados();
        
                    ?>
                        <?php foreach($anuncios as $anuncio){ ?>
                       
                                <a href="?visualizar_anuncios.php&id_anuncio=<?=@ $anuncio->getId()?>">
                                    <div class="anuncios">
                                            <img class="img_anuncio" src="view/upload/<?=@ $anuncio->getVeiculo()->getFotos()[0];?>" alt="<?=@ $anuncio->getVeiculo()->getModelo()->getNome()?>" title="<?=@ $anuncio->getVeiculo()->getModelo()->getNome()?>">
                                        <div class="info_anuncio">
                                            <p class="nome_veiculo">R$ <?=@ $anuncio->getValor();?>/hora</p>
                                            <p class="info_veiculo" style="margin-top:10px;"><?=@ $anuncio->getVeiculo()->getMarca()->getNome(). " " .$anuncio->getVeiculo()->getModelo()->getNome()?></p>
                                            <p class="info_veiculo"><?=@ $anuncio->getVeiculo()->getAno() . " | " . $anuncio->getVeiculo()->getQuilometragem() . " KM" ?></p>
                                            <p class="info_veiculo" >
                                                Matheus Vieira | <?=@((isset($_SESSION['cliente']))?$anuncio->getVeiculo()->getCliente()->getCidade() . " " . $anuncio->getVeiculo()->getCliente()->getUf():'')?>
                                            </p>

                                            <div class="stars_avaliacao">
                                                <img src="view/imagem/star1.png" alt="star">
                                                <img src="view/imagem/star1.png" alt="star"><img src="view/imagem/star1.png" alt="star"><img src="view/imagem/star1.png" alt="star"><img src="view/imagem/star1.png" alt="star">
                                                <p class="percentual_avaliacao">4.5%</p>
                                            </div>

                                        </div>
                                    </div>
                                </a>
                         
                        <?php } ?>
                </div>
                <div id="paginate">
                    <div class="paginate-prev">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    
                    <div class="paginate-next">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
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
                        <img class="center" style="display:block;" src="view/imagem/googleplay.png" alt="image" title="image">
                    </div>
                </div>
            </div>
        </footer>
    <script src="view/js/main.js"></script>
    <script src="view/js/libs/jquery/jquery-3.3.1.js"></script>
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