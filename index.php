<?php
/**
 * Created by PhpStorm.
 * User: LEONARDO TI
 * Date: 31/03/2017
 * Time: 17:13
 */
define('CLASS_DIR', 'src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register();

$server = "localhost";
$user = "root";
$pass = "";
$database = "cursomysql";

//Connect MySQL
$connect = new mysqli($server,$user,$pass,$database);

$conecta = new \src\Database();
//Error
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL:(" . $connect->connect_errno . ")" . $connect->connect_error;
    exit;
}
    $usuario  = new \src\User();

    @$acao = $_GET['acao'];
    switch ($acao){
       case 'adiciona':
           if(!empty($_POST['nome'])){
               $usuario
                   ->setName($_POST['nome'])
                   ->setEmail($_POST['email'])
                   ->setEndereco($_POST['endereco'])
                   ->setCpfCnpj($_POST['cpf_cnpj'])
                   ->setTipo($_POST['tipo'])
                   ->setImportancia($_POST['importancia']);

               $serviseUser = new \src\ServiceUser($connect,$usuario);
               $serviseUser->insert();
               header("Location: ./");
               exit;
           }
           ?>
            <!DOCTYPE HTML>
            <html>
            <head>
                <meta charset=utf-8>
                <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            </head>
            <body>
            <style>
                .center_div{
                    margin: 0 auto;
                    width:50% /* value of your choice which suits your alignment */
                }
                body{
                    background-color: #f2f2f2;
                }
            </style>
            <br />
            <div class="center_div">
            <form  action="" data-toggle="validator" role="form" method="post">
                <h3>Adicionar Cliente</h3>
                <p>Abaixo preencha os campos corretamente para cadastrar um novo cliente no sistema.</p>
                <hr>
                <div class="form-group">
                    <label for="textNome" class="control-label">Nome</label>
                    <input id="textNome" name="nome" class="form-control" placeholder="Digite o nome do cliente" type="text">
                </div>

                <div class="form-group">
                    <label for="textNome" class="control-label">Endereço</label>
                    <input id="textNome" name="endereco" class="form-control" placeholder="Digite o endereço do cliente" type="text">
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <input id="inputEmail" name="email" class="form-control" placeholder="Digite o E-mail do cliente" type="email">
                </div>

                <div class="form-group">
                    <label for="inputConfirm" class="control-label">Nos informe ao tipo de Cliente.</label>
                    <label for=""></label><select name="tipo" id="" class="form-control">
                        <option value="fisica">Física</option>
                        <option value="juridica">Jurídica</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="control-label">CPF/CNPJ</label>
                    <input type="number" name="cpf_cnpj" class="form-control" id="cpf_cnpj" placeholder="Digite o CPF se for pessoa física, ou o CNPJ se for pessoa jurídica">
                </div>

                <div class="form-group">
                    <label for="inputConfirm" class="control-label">Nos informe a importância desta pessoa.</label>
                    <label for=""></label><select name="importancia" id="" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Registrar Cliente</button>
            </form>
            </div>
            <a href="?"><button style="font-size:15px">Voltar <i style="font-size:24px" class="fa">&#xf015;</i></button></a>
            </body>
        </html>
           <?php
           exit;
           break;
           case 'update';
                if(!empty($_POST['nome'])){
                    $usuario
                        ->setId($_POST['id'])
                        ->setName($_POST['nome'])
                        ->setEmail($_POST['email'])
                        ->setCpfCnpj($_POST['cpf_cnpj'])
                        ->setImportancia($_POST['importancia'])
                        ->setTipo($_POST['tipo'])
                        ->setEndereco($_POST['endereco']);

                    $serviseUser = new \src\ServiceUser($connect, $usuario);
                    $serviseUser->update();

                   header("Location: ./");
                    exit;
                }

                $teste = new \src\User();
                $teste2 = new \src\ServiceUser($connect,$teste);
                $atualiza = $teste2->find($_GET['id']);
               ?>
               <!DOCTYPE HTML>
               <html>
               <head>
                   <meta charset=utf-8>
                   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
                   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
               </head>
               <body>
               <style>
                   .center_div{
                       margin: 0 auto;
                       width:50% /* value of your choice which suits your alignment */
                   }
                   body{
                        background-color: #f2f2f2;
                    }
               </style>
               <br />
               <div class="center_div">
                   <form  action="" data-toggle="validator" role="form" method="post">
                       <h3>Atualizar Cliente</h3>
                       <p>Abaixo preencha os campos corretamente para atualizar este cliente no sistema.</p>
                       <hr>
                       <div class="form-group">
                           <label for="textNome" class="control-label">Nome</label>
                           <input id="textNome" name="nome" class="form-control" placeholder="Digite o nome do cliente" type="text" value="<?php echo $atualiza['name'];?>">
                       </div>

                       <div class="form-group">
                           <label for="textNome" class="control-label">Endereço</label>
                           <input id="textNome" name="endereco" class="form-control" placeholder="Digite o endereço do cliente" type="text" value="<?php echo $atualiza['endereco'];?>">
                       </div>

                       <div class="form-group">
                           <label for="inputEmail" class="control-label">Email</label>
                           <input id="inputEmail" name="email" class="form-control" placeholder="Digite o E-mail do cliente" type="email" value="<?php echo $atualiza['email'];?>">
                       </div>

                       <div class="form-group">
                           <label for="inputConfirm" class="control-label">Nos informe ao tipo de Cliente.</label>
                           <label for=""></label><select name="tipo" id="" class="form-control">
                               <option value="fisica" <?php if($atualiza['tipo'] == "fisica"){ echo "selected"; }?>>Física</option>
                               <option value="juridica" <?php if($atualiza['tipo'] == "juridica"){ echo "selected"; }?>>Jurídica</option>
                           </select>
                       </div>

                       <div class="form-group">
                           <label for="inputPassword" class="control-label">CPF/CNPJ</label>
                           <input type="text" name="cpf_cnpj" class="form-control" id="cpf_cnpj" placeholder="Digite o CPF se for pessoa física, ou o CNPJ se for pessoa jurídica" value="<?php echo $atualiza['cpf_cnpj'];?>">
                       </div>

                       <div class="form-group">
                           <label for="inputConfirm" class="control-label">Nos informe a importância desta pessoa.</label>
                           <label for=""></label><select name="importancia" id="" class="form-control">
                               <option value="1" <?php if($atualiza['importancia'] == "1"){ echo "selected"; }?>>1</option>
                               <option value="2" <?php if($atualiza['importancia'] == "2"){ echo "selected"; }?>>2</option>
                               <option value="3" <?php if($atualiza['importancia'] == "3"){ echo "selected"; }?>>3</option>
                               <option value="4" <?php if($atualiza['importancia'] == "4"){ echo "selected"; }?>>4</option>
                               <option value="5" <?php if($atualiza['importancia'] == "5"){ echo "selected"; }?>>5</option>
                           </select>
                       </div>
                        <input type="hidden" value="<?php echo $atualiza['id'];?>" name="id">
                       <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
                   </form>
               </div>
               <a href="?"><button style="font-size:15px">Voltar <i style="font-size:24px" class="fa">&#xf015;</i></button></a>
               </body>
               </html>
           <?php
               exit;
           break;
           case 'remove';
               $serviseUser = new \src\ServiceUser($connect,$usuario);
               $serviseUser->delete($_GET['id']);
               header("Location: ./");
               exit;
           break;
    }




//echo $serviseUser->insert();
//echo "RETORNO: ".$serviseUser->update()."<BR />";
//echo "RETORNO: ".$serviseUser->delete(1)."<BR />";

//$ret = $serviseUser->find(2);
$serviseUser = new \src\ServiceUser($connect,$usuario);
$ret = $serviseUser->Mylist();


/*echo $ret["id"]."<br />";
echo $ret["name"]."<br />";
echo $ret["email"]."<br /><hr>";
*/

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset=utf-8>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<style>
    .btn-block{
        display: inline-block;
        margin: 3px;
    }
    body{
        background-color: #f2f2f2;
    }
</style>
<br />
<div class="conteiner">
    <div class="row col-md-1"></div>
    <div class="row col-md-10">
        <div class="page-header">
            <h1>Clientes</h1>
        </div>
        <table class="table table-striped table-hover" >
            <thead>
                <tr>
                    <th><a href="?order=<?php echo $ordem = (@$_GET['order'] == "0") ? "1" : "0"?>&id=<?php echo @$_GET['id']?>">ID</a></th>
                    <th><a href="#">Nome</a></th>
                    <th><a href="#">Tipo de Cliente</a></th>
                    <th><a href="#">Importancia</a></th>
                    <th><a href="#">Acão</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_GET['order'])) {
                    if ($_GET['order'] == 1) {
                        krsort( $ret );
                    }
                }

                foreach ($ret as $key => $value){
                    ?>
                    <tr <?php echo $active = (@$_GET['id']) ? "class='.active'" : ""?>>
                        <td><a href="#">
                                 <span class="badge"><?php echo $value['id']?></span>
                            </a></td>
                        <td id="<?php echo $value['id'];?>">
                                <a href="?id=<?php echo $key;?>&order=<?php echo @$_GET['order']?>" class="ancor" ><?php  echo $value['name']."</strong>"?></a>
                            <?php
                            if(@$_GET['id'] == $key){ ?>
                                <br><span class="label label-warning" style="position: relative;bottom: 2px"><?php echo $cpf_cnpj = ($value['tipo'] == "fisica") ? "CPF: " : "CNPJ: "; echo $value['cpf_cnpj'];?></span><br>
                                <span class="label label-warning" style="position: relative;bottom: 2px"><?php echo "Endereço: ".$value['endereco'];?></span><br>
                               <span class="label label-info" style="position: relative;bottom: 2px"><?php echo "Email: ".$value['email'];?></span>
                            <?php }?>
                        </td>
                        <td>
                            <span class="label label-success" style="position: relative;bottom: 2px"><?php echo $pessoa = ($value['tipo'] == "fisica") ? "Pessoa Física" : "Pessoa Jurídica"?></span>
                        </td>
                        <td>
                            <img src="img/<?php echo $value['importancia'];?>.png" height="15px"/>
                        </td>
                        <td>
                            <a href="?acao=remove&id=<?php echo $value['id'];?>"><button type="button"  class="remove btn btn-primary btn-danger btn-xs btn-block">Remover cliente <i style="font-size:14px" class="fa">&#xf235;</i></button></a><br>
                            <a href="?acao=update&id=<?php echo $value['id'];?>"><button type="button" class="btn btn-default btn-warning btn-xs btn-block">Atualizar cliente <span class="glyphicon">&#xe065;</span></button></a>

                        </td>
                    </tr>
                <?php }?>
</tbody>
</table>
</div>
<div class="row col-md-2"></div>
</div>
<a href="?acao=adiciona"><button class="btn btn-success btn-xs"> Adicionar um novo cliente <i class="fa fa-user-plus"></i></button></a>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
    $(".remove").click(function(){
       if(confirm("Deseja realmente remover este cliente?")){

        }else{
            return false;
        }
    });
</script>
</body>
</html>