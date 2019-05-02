<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <title>Como ganhar dinheiro</title>
    <link rel="stylesheet" type="text/css" media="screen" href="view/css/como_ganhar_dinheiro.css">
    <link rel="stylesheet" type="text/css" media="screen" href="view/css/header.css">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <script src="view/js/libs/jquery/jquery-3.3.1.js"></script>
    <script src="view/js/notify.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <header>
        <div id="imgPretaRgb">
            <nav class="cor_site_padrao">
                <div id="segura_nav">
                    <div id="logo">
                        <img src="view/imagem/mob.png" alt="logo" title="logo">
                    </div>
                    <div class="segura_menu">
                        <ul>
                            <li><a href="?home">INÍCIO</a></li>
                            <li><a href="?melhores_anuncios">VEÍCULOS EM DESTAQUE</a></li>
                            <li><a href="?principais_anuncios">VEÍCULOS A VENDA</a></li>
                            <li><a href="?como_ganhar_dinheiro">GANHE DINHEIRO</a></li>
                            <li><a href="?parceiros">SEJA UM PARCEIRO</a></li>
                            <li><a href="?sobre">SOBRE NÓS</a></li>
                        </ul>
                    </div>
                    <div class="segura_login">
                        <div class="login_cadastro" id="login" style="width: 110px;">
                            <a href="javascript:getLogin()"><img src="view/imagem/login_amarelo.png" alt="login"><p>LOGIN</p></a>
                        </div>
                        <div class="login_cadastro" style="width: 160px;">
                            <a href="javascript:getCadastro()"><img src="view/imagem/downloads2/cadastrar.png" alt="login"><p>CADATRAR-SE</p></a>
                        </div>
                    </div>
                </div>    
            </nav>
            <div class="caixa_texto_pages_all">
                <h1 class="texto_primario_h1">Ganhe Dinheiro</h1>
                <p class="texto_secundario_p">Como ganhar dinheiro locando seu veículo na Mob'Share</p>
            </div>
        </div>
    </header>
    		
    <div id="principal_conteudo">
    	<?php 
					require_once('controller/controllerComo_ganhar_dinheiro.php');

					$controller_como_ganhar_dinheiro = new ControllerComo_ganhar_dinheiro();

					$listComo_ganhar_dinheiro =  $controller_como_ganhar_dinheiro->listar_como_ganhar_dinheiro();


					if(count($listComo_ganhar_dinheiro) < 1){
					  echo "<img class='img_not_find alt='Nada encontrado' src='view/imagem/magnify.gif'>";
					  echo " <p class='aviso_tabela'> Nenhum registro encontrado!</p> ";
					}

					foreach($listComo_ganhar_dinheiro as $registro){
				?>
        <!-- ************************CADASTRAR VEICULOS******************** --> 
		<section id="sessao_cadastrar_veiculo">
			<div id="titulo_cadastrar_veiculo">
				<h2><?=@$registro->getTitulo_sessao1()?></h2>
			</div>
			<div class="lista_cadastrar_veiculo">
				<ul>
					<br>
					<li><?=@$registro->getLista1_sessao1()?></li>
				</ul>
			</div>
			<div  class="lista_cadastrar_veiculo">
				<figure height="300px" width="400px" style=" background-image: url(view/upload/<?=@$registro->getImg1_sessao1()?>);"> </figure>
			</div>
			<div class="lista_cadastrar_veiculo">
				<ul>
					<br>
					<li><?=@$registro->getLista2_sessao1()?></li>
				</ul>
			</div>
		</section>
         <!-- ************************CADASTRAR ANUNCIO******************** --> 
		<section id="sessao_cadastrar_anuncio">
			<div id="titulo_cadastrar_anuncio">
				<h2><?=@$registro->getTitulo_sessao2()?></h2>
			</div>
			<div  class="lista_cadastrar_anuncio">
				<figure height="300px" width="400px" style=" background-image: url(view/upload/<?=@$registro->getImg1_sessao2()?>);"> </figure>
			</div>
			<div class="lista_cadastrar_anuncio">
				<ul>
					<br>
					<li><?=@$registro->getLista1_sessao2()?></li>
				</ul>
			</div>
			<div  class="lista_cadastrar_anuncio">
				<figure height="300px" width="400px" style=" background-image: url(view/upload/<?=@$registro->getImg1_sessao1()?>);"> </figure>
			</div>
			<div class="lista_cadastrar_anuncio">
				<ul>
					<br>
					<li><?=@$registro->getLista2_sessao2()?></li>
				</ul>
			</div>
		</section>
		 <!-- ************************TABELA DE PERCENTUAL******************** --> 
		<section class="tabela_percentual">
                <h2><?=@$registro->getTitulo_sessao3()?></h2>
                <div class="hold_tabela">
                    <div class="texto_como_funciona">
                        <p><?=@$registro->getTexto_sessao3()?>
                        </p>
                    </div>
                    <div class="tabela">
                        <div class="linha_titulos">
                            <div class="col_titulo">
                                <p>Tipo veículo</p>
                            </div>
                            <div class="col_titulo">
                                <p>Percentual</p>
                            </div>
                            <div class="col_titulo">
                                <p>Data atualizado</p>
                            </div>
                        </div>

                        <div class="linha_resultados">
                            <div class="col_titulo">
                                <p>Carro esportivo</p>
                            </div>
                            <div class="col_titulo">
                                <p>15%</p>
                            </div>
                            <div class="col_titulo">
                                <p>12/02/2019</p>
                            </div>
                        </div>
                        <div class="linha_resultados">
                            <div class="col_titulo">
                                <p>Motocross</p>
                            </div>
                            <div class="col_titulo">
                                <p>12%</p>
                            </div>
                            <div class="col_titulo">
                                <p>12/02/2019</p>
                            </div>
                        </div>
                        <div class="linha_resultados">
                            <div class="col_titulo">
                                <p>Bicicleta-bike</p>
                            </div>
                            <div class="col_titulo">
                                <p>8%</p>
                            </div>
                            <div class="col_titulo">
                                <p>12/02/2019</p>
                            </div>
                        </div>
                        <div class="linha_resultados">
                            <div class="col_titulo">
                                <p>Carro esportivo</p>
                            </div>
                            <div class="col_titulo">
                                <p>15%</p>
                            </div>
                            <div class="col_titulo">
                                <p>12/02/2019</p>
                            </div>
                        </div>
                        <div class="linha_resultados">
                            <div class="col_titulo">
                                <p>Motocross</p>
                            </div>
                            <div class="col_titulo">
                                <p>12%</p>
                            </div>
                            <div class="col_titulo">
                                <p>12/02/2019</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
					}
            ?>
	</div>
    <footer class="cor_site_padrao">
        <!--  Caixas que contem o contato e o navegar pelo site -->
        <div class="newsletter">
            <div class="logo_mob">
                <img src="view/imagem/mob.png" alt="logo">
            </div>
            <div class="segura_newsletter">
                <form id="frmEmail">
                    <h3>Quer receber noticias?</h3>
                    <input type="text" placeholder="Insira seu email" class="input_newsletter">
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
                    <img class="center" style="display:block;" src="view/imagem/googleplay.png">
                </div>
            </div>
        </div>
    </footer>
</body>
</html>