<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];
    function hotelsFilter($elm){
        if(!empty($_GET["parking"])){
            if(!empty($_GET["vote"])){
                return $elm["parking"] == $_GET["parking"] && $elm["vote"] == $_GET["vote"];
            }else{
                if($_GET["parking"]==="true"){
                    return $elm["parking"];
                }else{
                    return !$elm["parking"];
                }
            }
        }elseif(!empty($_GET["vote"])){
            return $elm["vote"] >= $_GET["vote"];
        }else{
            return true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PHP Hotel</title>
</head>
<body>
    <div class="container pt-5">
        <form action="http://localhost/php-hotel/" method="GET">
            <label for="parking" class="me-2">Filtra in base al parcheggio</label>
            <select name="parking" id="parking" class="me-4">
                <option value="" selected>Nessun Filtro</option>
                <option value="true">Con Parcheggio</option>
                <option value="false">Senza Parcheggio</option>
            </select>
            <label for="vote" class="me-2">Filtra in base al voto</label>
            <select name="vote" id="vote" class="me-4">
                <option value="" selected>Nessun Filtro</option>
                <option value="1">
                    1 stella
                </option>
                <option value="2">
                    2 stelle
                </option>
                <option value="3">
                    3 stelle
                </option>
                <option value="4">
                    4 stelle
                </option>
                <option value="5">
                    5 stelle
                </option>
            </select>
            <button class="btn btn-primary" type="submit">Filtra Hotel</button>
        </form>
        <table class="table table-striped-columns table-dark text-center mt-5">
            <thead>
                <tr class="fs-5">
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Parcheggio</th>
                    <th scope="col">Voto</th>
                    <th scope="col">Distanza dal centro (Km)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach(array_filter($hotels,"hotelsFilter") as $hotel){?>
                    <tr>
                        <?php   
                            foreach($hotel as $key => $info){
                                if($key==="name"){
                                    echo "<th scope=\"row\">$info</th>";
                                }elseif($key==="parking"){
                                    if($info){
                                        echo "<td><i class=\"fa-solid fa-check\"></i></td>";
                                    }else{
                                        echo "<td><i class=\"fa-solid fa-xmark\"></i></td>";
                                    }
                                }elseif($key==="vote"){
                        ?>
                        <td>  
                            <?php
                            for($i=0;$i<5;$i++){
                                if($i<$info){
                                    echo "<i class=\"fa-solid fa-star\"></i>";
                                }else{
                                    echo "<i class=\"fa-regular fa-star\"></i>";
                                }
                            }
                            ?>
                        </td>
                        <?php
                                }else{
                                    echo "<td>$info</td>";
                                }
                            }
                        ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>