<?php
include_once '../model/Receita.php';
include_once '../model/database/ReceitaDAO.php';

if(isset($_REQUEST['acao'])){
    
    $acao = $_REQUEST['acao'];
    
    switch ($acao){
        case 'inserir':
            if(isset($_REQUEST['txtnome'])&& !empty($_REQUEST['txtnome'])){
                $dao = new ReceitaDAO();
                $objeto = new Receita();
                $objeto->nome = $_REQUEST['txtnome'];
                
                if($dao->insert($objeto)){
                    ?>
                        <script type="text/javascript">
                        alert('Receita salva com sucesso!');
                        location.href = '../view/principal.php';
                    </script>
                    <?php
                }else{
                     ?>
                    <script type="text/javascript">
                        alert('Problema ao salvar a receita!');
                        history.go(-1);
                    </script>
                    <?php
                }
            }else{
                ?>
                    <script type="text/javascript">
                        alert('Prencha o campo adequadamente!');
                        history.go(-1);
                    </script>
                <?php
            }
            break;
        case 'alterar':
            if(isset($_REQUEST['idreceita'])&& isset($_REQUEST['txtnome'])&& !empty($_REQUEST['txtnome'])){
                $objeto = new ReceitaDAO();
                $objeto->idreceita = $_REQUEST['idreceita'];
                $objeto->nome = $_REQUEST['txtnome'];
                if($dao->update($objeto)){
                    ?>
                    <script type="text/javascript">
                             alert('Receita alterada com sucesso!');
                             location.href = '../view/listaingredientes.php';
                         </script>
                         <?php
                }else{
                     ?>
                    <script type="text/javascript">
                        alert('Problema ao alterar a receita!');
                        history.go(-1);
                    </script>
                    <?php
                }
            }else{
                ?>
                       <script type="text/javascript">
                           alert('Prencha o campo adequadamente.');
                           history.go(-1);
                       </script>
                          <?php
            }
                 break;
        case 'deletar':
            if(isset($_GET['idreceita'])){
                $dao = new ReceitaDAO();
                $id = $_GET['idreceita'];
                if($dao->delete($id)){
                     ?>
                                      <script type="text/javascript">
                                          alert('Receita excluída com sucesso!');
                                          location.href = '../view/listaingredientes.php';
                                      </script>
                                      <?php
                }else{
                     ?>
                    <script type="text/javascript">
                        alert('Problema ao excluir a receita!');
                        history.go(-1);
                    </script>
                    <?php
                }
            }
            break;
        default:
            break;
    }
}
?>