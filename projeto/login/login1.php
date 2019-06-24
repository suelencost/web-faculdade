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