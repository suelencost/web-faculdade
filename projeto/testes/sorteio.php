<?php

$conn = new PDO("mysql:dbname=gerador; host=localhost", "root", "");
$busca = $conn->prepare("select nome from times");
$busca->execute();

$participantes = $busca->fetchAll(PDO::FETCH_ASSOC);

//var_dump($participantes);

//$participantes = array("Menega", "Menegão", "Toninho", "Meneghart Atack", "Pampa Cats", "Pampa Dogs", "Chicar", "Corote FC");

$numParticipantes = sizeof($participantes);

echo $numParticipantes;

echo "<br><hr>";
$i=0;
while ( $i < $numParticipantes) { 
    $time = rand(0 , $numParticipantes - 1);

    if(!isset($numJaSelecionados)){
        $numJaSelecionados = array($time);
        echo $time;
        echo "       " . $participantes[$time]["nome"] . "<br>";
        $i++;
        continue;
    }
    if(!in_array($time, $numJaSelecionados)){
        array_push($numJaSelecionados, $time);
        echo $time ;
        echo "       " . $participantes[$time]["nome"] . "<br>";
        $i++;   
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
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
