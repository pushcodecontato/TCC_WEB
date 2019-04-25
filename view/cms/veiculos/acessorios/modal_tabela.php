<?php

if(isset($_GET['id_tipo_veiculo'])){
    
    require_once('controller/controllerTipo_veiculo.php');


    $controllerTipo_veiculo = new ControllerTipoVeiculo();

    $lista = $controllerTipo_veiculo->listar_acessorios($_GET['id_tipo_veiculo']);

    $tipo_veiculo = $controllerTipo_veiculo->getById($_GET['id_tipo_veiculo']);

}

?>
<div class="modal_acessorios">
    <h2 style="text-align:center; margin:7px 0px 10px 0px;">Defina os acessorios para um tipo de veiculo</h2>
    <div style=" display: block; width: 100%; height: auto; overflow: auto;">
        <h4 style="float:left;">Tipo de veiculo <strong><?=@$tipo_veiculo->getNome()?></strong></h3>
        <h3 onclick="acessorios_adicionar(<?=@$_GET['id_tipo_veiculo']?>)" style="float:right;"><img src="view/cms/imagem/icones/check1.png" width="20px"> Adicionar Acessorio </h3>
    </div>
    <div class="caixa_acessorios">
    <?php

     if(count($lista) < 1){
        echo "<img class='img_not_find alt='Nada encontrado' src='view/imagem/magnify.gif'>";
        echo " <p class='aviso_tabela'> Nenhum Acessorio encontrado!</p> ";
     }else{


     $lista_acessorios =  array_chunk($lista,round(count($lista)/3));


    foreach($lista_acessorios as $lista){?>

        <div class="caixa_item">

        <?php foreach($lista as $acessorios){?>
            <div class="item">
                <label>
                    <input type="checkbox" name="acessorios" checked>
                    <?=@$acessorios->getNome()?>
                </label>
                <img class="edit" src="view/cms/imagem/icones/edit.png"
                     onclick="acessorios_editar(<?=@$acessorios->getId()?>)" alt="edit">
                <img class="delete" src="view/cms/imagem/icones/delete.png" alt="delete">
            </div>
        <?php } ?>

        </div>

    <?php }
    } ?>
    </div>
</div>
<style>
.modal_acessorios{
    background-color:white;
    padding: 15px;
}
.caixa_acessorios{
    background-color: #fdfdfd;
    border-top: solid 0.1px black;
    padding: 2px 15px;
    height: auto;
    overflow-y: auto;
    background-color:#e8e8e8;
}
.caixa_acessorios input[type="checkbox"]{/* Mateus usou na linha 312  da home_cms.css */
    left: auto;/* Contra reação */
    position: initial;/* Contra reação */
}
.caixa_acessorios .caixa_item{
    width: 32%;
    text-align: center;
    float: left;
}
.caixa_acessorios .caixa_item .item{
    width: auto;
    /* margin: 4px 0px; */
    font-size: 20px;
    border: solid 0.8px black;
    border-radius: 1px;
    padding: 4px 0px;
    background-color: #fff;
    background: rgb(238,238,238);
    background: -moz-linear-gradient(8deg, rgba(238,238,238,1) 0%, rgba(213,213,213,1) 35%, rgba(255,255,255,1) 100%);
    background: -webkit-linear-gradient(8deg, rgba(238,238,238,1) 0%, rgba(213,213,213,1) 35%, rgba(255,255,255,1) 100%);
    background: linear-gradient(8deg, rgba(238,238,238,1) 0%, rgba(213,213,213,1) 35%, rgba(255,255,255,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#eeeeee",endColorstr="#ffffff",GradientType=1);
}
.caixa_acessorios .caixa_item .item img{
    width:18px;
    margin-bottom: -3px;
}
.caixa_acessorios .caixa_item .item:hover{
    background: rgb(238,238,238);
    background: -moz-linear-gradient(8deg, rgba(238,238,238,1) 25%, rgba(255,255,255,1) 48%, rgba(213,213,213,1) 100%);
    background: -webkit-linear-gradient(8deg, rgba(238,238,238,1) 25%, rgba(255,255,255,1) 48%, rgba(213,213,213,1) 100%);
    background: linear-gradient(8deg, rgba(238,238,238,1) 25%, rgba(255,255,255,1) 48%, rgba(213,213,213,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#eeeeee",endColorstr="#d5d5d5",GradientType=1);
}
#frmAcessorio{

}
#frmAcessorio button{

}
</style>
<script src="view/cms/veiculos/acessorios/modal_acessorios.js"></script>