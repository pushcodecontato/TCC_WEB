<?php 
    
    
    class ControllerClientes{
       
       private $clientesDAO;
        
       public function __construct(){
        //importando classes
        require_once('model/clienteClass.php');
        require_once('model/dao/clienteDAO.php');

        $this->clientesDAO = new ClienteDAO();

       }

       public function inserir_cliente(){
           $cliente = new Cliente();
           
           $cliente->setNome($_POST['nome'])
                   ->setCPF($_POST['cpf'])
                   ->setTelefone($_POST['telefone'])
                   ->setCelular($_POST['celular'])
                   ->setEmail($_POST['email'])
                   ->setSenha($_POST['senha'])
                   ->setCEP($_POST['cep'])
                   ->setComplemento($_POST['complemento'])
                   ->setRua($_POST['rua'])
                   ->setBairro($_POST['bairro'])
                   ->setCidade($_POST['cidade'])
                   ->setUF($_POST['uf']);

           if( $_FILES['fotoCliente']['size'] > 0 ){
               $cliente->setFoto($this->uploadImagem($_FILES['fotoCliente']));
           }

           if( $_FILES['fotoCNH']['size'] > 0 ){
               $cliente->setCNHFoto($this->uploadImagem($_FILES['fotoCNH']));
           }
           
           /* Inserido o cliente e pegando o mesmo depois da inserção para colocar na session
            * Para que o usuario possa entrar no painel de usuario depois de se cadastrar
            */
           if($cliente = $this->clientesDAO->insert($cliente)){
              // Verificndo se a session esta ativa     
              if(!isset($_SESSION))session_start();

              $_SESSION['cliente'] = serialize($cliente);

           }



       }

       public function excluir_cliente(){}
       public function atualizar_cliente(){}
       public function logar(){

            // Pegando o usuario pelo email
           if($cliente = $this->clientesDAO->getByEmail($_POST['email'])){
               
               // Verificando se a senha esta correta
              if($cliente->verificar($_POST['senha'])){
                 
                 // Verificando se a session esta ativa
                 if(!isset($_SESSION))session_start();
                 

                 //guarda na session o cliente
                 $_SESSION['cliente'] = serialize($cliente);

                 echo "Cliente logado com sucesso";

              }else{

                 echo "Erro ao logar! senha incorreta";

              }

          }else{

              echo "Erro ao logar!cliente não encontrado ";

          }


       }


        /* UPLOAD DE IMAGEM 
         * $arquivo = $_FILE['foto'] = objeto file do PHP
         */
        public function uploadImagem($arquivo){
            
            // Verifica Se o arquivo tem um tamanho $_File tem conteudo
            if($arquivo['size']>0){

                // Vetor com uma lista de arquivos que são permitidos
                $arquivosPermitidos=array(".jpg",".png",".jpeg",".svg");
                // Pega o nome do arquivo
                $nomeArquivo = pathinfo($arquivo['name'], PATHINFO_FILENAME);
                // Pega a extenção do arquivo
                $extencao_arquivo = strrchr($arquivo['name'],".");
                
                // Define o tipo de arquivo que pode ler armazenado
                if( in_array($extencao_arquivo,$arquivosPermitidos) ){

                    $tamanho = round(($arquivo['size'])/1024);
                    // Define o tamanho maximo de para a foto enviada
                    if($tamanho<=4096){// 4 MB 
                        // Operações sobre o arquivo de imagem
                        /* AREA SEGURA!!! */
                        
                        /*  Aleatoriedade nessesaria para gerar um nome diferente:
                         *  gera 3 valores aleatorios entre 1 e 9  e os soma com a data atual do upload
                         */
                        $entropia = rand(1, 9) . "" . rand(1, 9) . "" .rand(1, 9) . "" . date('Y-m-d H:i:s');

                        // Criando novo nome para a imagem baseado na entropia 
                        $novoNome = (md5($entropia.$nomeArquivo))."".$extencao_arquivo;
                        
                        // Novo Caminho para a imagem 
                        $caminho_novo_da_imagem = "view/upload/".$novoNome;
                        // Caminho atual da imagem
                        $caminho_atual_da_imagem = $arquivo['tmp_name'];
                        
                        // MOVENDO ARQUIVO DO CAMINHO ATUAL PARA O NOVO CAMINHO 
                        if(move_uploaded_file($caminho_atual_da_imagem,$caminho_novo_da_imagem)){
                            
                            // Caso tudo tenha dado certo retorna o novo nome do arquivo
                            return $novoNome;
                        
                        }
                    }
                }
            }

            // Caso não funcione retorna um false para quem o chamou
            return false;
        }
    
        public function listar_registro_clientes(){
            $consulta = $this->clientesDAO->selectAll();
    
            return $consulta;
        }
        public function getById(){
    
            $id_cliente = $_POST['id'];
    
            return $this->clientesDAO->selectById($id_cliente);
    
        }

    }
?>