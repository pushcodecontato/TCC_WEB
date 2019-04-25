<link rel="stylesheet" type="text/css" href="view/cms/css/pagina_faq.css">
<script src="view/cms/pagina_faq/modal.js"></script>

<div class="segura_text_button">
    <h2>TABELA FAQ</h2>
    <button class="adicionar_nivel" id="abrir_cadastro">ADICIONAR FAQ</button>
</div>
<div class="segura_tabela">
    <div class="tabela_niveis">
        <div class="linha_titulo">
            <div class="col_titulo" style="width:400px; border-left: 1px solid black;">Pergunta</div>
            <div class="col_titulo" style="width:400px; border-left: 1px solid black;">Resposta</div>
            <div class="col_titulo" style="width:130px; border-left: 1px solid black;">Opções</div>
        </div>
        <?php 
        require_once('controller/controllerFaq.php');

            $controller_faq = new ControllerFaq();

            $listRegistro =  $controller_faq->listar_registro_faq();


            if(count($listRegistro) < 1){
              echo "<img class='img_not_find alt='Nada encontrado' src='view/imagem/magnify.gif'>";
              echo " <p class='aviso_tabela'> Nenhum registro encontrado!</p> ";
            }

            foreach($listRegistro as $registro){
        ?>
        <div class="linha_resposta">
            <div class="col_resposta" style="padding-top: 10px; width:400px;  border-left: 1px solid black;"><?=@$registro->getPerguntas_faq()?></div>
            <div class="col_resposta" style="padding-top: 10px; width:400px;  border-left: 1px solid black;"><?=@$registro->getRespostas_faq()?></div>
            <div class="col_resposta" style="width:130px;  border-left: 1px solid black;">
                <img src="view/cms/imagem/icones/edit.png" alt="edit" title="Editar">
                <img src="view/cms/imagem/icones/delete.png" alt="delete" title="Excluir">
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>