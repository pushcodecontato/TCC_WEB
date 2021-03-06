<?php
  /**
    @author gilberto.tec@vivaldi.net
    @data  15/04/2019
    @comment  Desenvolvendo o crud veiculo

    @author gilberto.tec@vivaldi.net
    @data  25/04/2019
    @comment  crud de tipo de veiculo pronto

    @author matheus.vieira@dsads.sdd
    @data  15/05/2019
    @comment  Arruamando Crud para a pagina de cadastro de veiculo

  */

    class ControllerModelos{

        private $modelosDAO;

        public function __construct(){

            require_once('model/modeloClass.php');
            require_once('model/dao/modelosDAO.php');

            $this->modelosDAO = new ModeloDAO();

        }

        public function listar_modelos(){

            $idTipoMarca = $_GET['idTipoMarca'];

            return $this->modelosDAO->selectAll($idTipoMarca);
        }

        public function inserir_modelo(){

            $modelo = new Modelo();

            $modelo->setNome($_POST['nome'])
                   ->setIdTipoMarca($_POST['id_tipo_marca']);

            $this->modelosDAO->insert($modelo);

        }

        public function atualizar_modelo(){

            $modelo = new Modelo();
            $modelo->setId($_GET['id'])
                   ->setNome($_POST['nome'])
                   ->setIdTipoMarca($_POST['id_tipo_marca']);

            $this->modelosDAO->update($modelo);
        }

        public function excluir_modelo(){

            $this->modelosDAO->delete($_GET['id']);

        }

        public function status_modelo(){


            $this->modelosDAO->status($_GET['id'],$_POST['status']);

        }

        public function getById($id_modelo = 0){

            if($id_modelo == 0)$id_modelo = $_GET['id'];


            return $this->modelosDAO->select($id_modelo);

        }



    }

?>
