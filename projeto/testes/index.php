<?php 
session_start();
if(!isset($_SESSION['login'])){
  header("location:../login/login.php");
}

if(isset($_POST['time'])&& isset($_POST['resp'])){
  $nome = $_POST['time'];
  $responsavel = $_POST['resp'];


  $conn = new PDO("mysql:dbname=gerador; host=localhost", "root", "");

  $busca = $conn->prepare("select * from times where nome = :nome");
  $busca->bindParam(":nome",$nome);
  $busca->execute();
  
  if($busca->rowCount() > 0){
    $mensagem = 'Time já cadastrado!';
    $status = false;
  }
  else{
    $stmt = $conn->prepare("INSERT INTO times (nome, responsavel) values (:nome, :responsavel)");
    $stmt->bindParam(":nome",$nome);
    $stmt->bindParam("responsavel",$responsavel);
    $stmt->execute();

    if($stmt->rowCount() > 0){
      $mensagem = 'Time inserido com sucesso!';
      $status = true;
    }
    else{
      //$mensagem = 'Falha ao inserir, tente novamente!';
      $mensagem = $stmt->errorInfo();
      $status = false;
    }
  }

  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerador de Chaves</title>
    <link href="enc/estilo.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
</head>
<body class="telas">

<div class="container">    
<form method="POST" action="index.php">
  <div class="form-group">
    <label for="time">Time</label>
    <input type="text" class="form-control" id="time" aria-describedby="emailHelp" placeholder="Informe seu time" name="time">
  </div>
  <div class="form-group">
    <label for="resp">Responsável</label>
    <input type="text" class="form-control" id="resp" placeholder="Informe o Responsável" name="resp">
  </div>
  <button type="submit" class="btn btn-primary">Cadastrar Time</button>
</form>
</div>

    <div class="container">
     <?php
      if(isset($mensagem)){
        if($status){
          echo "<div class='alert alert-success' role='alert'>$mensagem</div>";
        }
        else {
          echo "<div class='alert alert-danger' role='alert'>$mensagem</div>";
        }
      }
     ?>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
