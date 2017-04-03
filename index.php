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

//Error
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL:(".$connect->connect_errno.")".$connect->connect_error;
    exit;
}


    @$acao = $_GET['acao'];
    switch ($acao){
       case 'adiciona':
           ?>
            <!DOCTYPE HTML>
            <html>
            <head>
                <meta charset=utf-8>
                <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
            </head>
            <body>
            <style>
                .center_div{
                    margin: 0 auto;
                    width:50% /* value of your choice which suits your alignment */
                }
                body{
                    background-color: #9ca7b3;
                }
            </style>
            <br />
            <div class="center_div">
            <form id="" data-toggle="validator" role="form">
                <h3>Adicionar Cliente</h3>
                <p>Abaixo preencha os campos corretamente para cadastrar um novo cliente no sistema.</p>
                <hr>
                <div class="form-group">
                    <label for="textNome" class="control-label">Nome</label>
                    <input id="textNome" class="form-control" placeholder="Digite o nome do cliente" type="text">
                </div>

                <div class="form-group">
                    <label for="textNome" class="control-label">Endereço</label>
                    <input id="textNome" class="form-control" placeholder="Digite o endereço do cliente" type="text">
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <input id="inputEmail" class="form-control" placeholder="Digite o E-mail do cliente" type="email">
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="control-label">CPF/CNPJ</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Digite o CPF se for pessoa física, ou o CNPJ se for pessoa jurídica">
                </div>

                <div class="form-group">
                    <label for="inputConfirm" class="control-label">Nos informe a importância desta pessoa.</label>
                    <label for=""></label><select name="" id="" class="form-control">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                        <option value="">5</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
            </div>
            </body>
        </html>
           <?php
           exit;
           break;
           case 'update';
           echo "update";
           exit;
           break;
           case 'remove';
            echo "remove";
            exit;
           break;
    }

$usuario  = new \src\User();

$usuario->setId(6)
        ->setName("Manoel Romeu 1")
        ->setEmail("manoel1@hotmail.com");


$serviseUser = new \src\ServiceUser($connect,$usuario);


//echo $serviseUser->insert();
//echo "RETORNO: ".$serviseUser->update()."<BR />";
//echo "RETORNO: ".$serviseUser->delete(1)."<BR />";

//$ret = $serviseUser->find(2);
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
</head>
<body>
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
                        <td><?php echo $value['id']?></td>
                        <td id="<?php echo $value['id'];?>">
                            <a href="?id=<?php echo $key;?>&order=<?php echo @$_GET['order']?>" class="ancor" ><?php  echo $value['name'];?></a>
                            <?php
                            if(@$_GET['id'] == $key){ ?>
                                &nbsp&nbsp&nbsp<span class="label label-warning" style="position: relative;bottom: 2px"><?php echo $cpf_cnpj = ($value['tipo'] == "fisica") ? "CPF: " : "CNPJ: "; echo $value['cpf_cnpj'];?></span>
                                <span class="label label-warning" style="position: relative;bottom: 2px"><?php echo "Endereço: ".$value['endereco'];?></span>
                            <?php }?>
                        </td>
                        <td>
                            <span class="label label-success" style="position: relative;bottom: 2px"><?php echo $pessoa = ($value['tipo'] == "fisica") ? "Pessoa Física" : "Pessoa Jurídica"?></span>
                        </td>
                        <td>
                            <img src="img/<?php echo $value['importancia'];?>.png" height="15px"/>
                        </td>
                        <td>
                            <a href="?acao=remove&id=<?php echo $value['id'];?>"><button class="btn btn-danger btn-xs">Clique aqui para remover este cliente</button></a><br>
                            <a href="?acao=update&id=<?php echo $value['id'];?>"><button class="btn btn-warning  btn-xs">Clique aqui para atualizar este cliente</button></a>

                        </td>
                    </tr>
                <?php }?>
</tbody>
</table>
</div>
<div class="row col-md-2"></div>
</div>
<a href="?acao=adiciona"><button class="btn btn-success btn-xs">Clique aqui para cadastrar um novo cliente</button></a>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>