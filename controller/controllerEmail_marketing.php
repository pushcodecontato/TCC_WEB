<?php 
       
class ControllerEmail_marketing{
    
    private $email_marketingDao;
    
    public function __construct(){
        //importando classes
        require_once('model/email_marketingClass.php');
        require_once('model/dao/email_marketingDAO.php');

        $this->email_marketingDao = new Email_marketingDao();
    }

    public function excluir_registro_email_marketing(){
        $id_email = $_GET['id'];

        $this->email_marketingDao->delete($id_email_mkt);
    }

    public function listar_registro_email_marketing(){
        $consulta = $this->email_marketingDao->selectAll();

        return $consulta;
    }
    public function getById(){

        $id_email_marketing = $_POST['id'];

        return $this->email_marketingDao->selectById($id_email_marketing);

    }
}
?>