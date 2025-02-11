
 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="language" content="NL">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Steen Papier Schaar spel">
	<meta name="author" content="Yassin Chamlal">
	<meta name="keywords" content="Steen Papier Schaar spel rps game">
	<title>Resultaten</title>
	<link rel="stylesheet" type="text/css" href="css/resulst.css">
</head> 
<script>  
function openNav() {
  document.getElementById("mySidenav").style.width = "360px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>  
<body>   
<header>    



 

<section> 
		<div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
            <a href="ProfielPagina.php">Profiel Pagina</a> 
             <hr>
            <a href="ingelogd.php">Het spel</a> 
            <hr>
            <a href="GastenBoeklogin.php">Gastenboek</a> 
            <hr>
            <a href="resulst.php">Resultaten</a>  
            <hr>   
            <a href="uitloggen.php">Uitloggen</a>  
            <hr>  
            <img src="img/menuplaatje.png" class="menuplaatje" alt="menu plaatje">
		  </div>  
      <span class="menuknop" onclick="openNav()">&#9776;</span> 
      </section> 
      

<h1>Welkom op de resultaten pagina</h1>   
 
</header>   
<main>   

  


</main>

</body>

</html>
 

<?php 
session_start(); 
if ($_SESSION['ingelogd'] != true) { 
    header("Location: logindb.php"); 
}   
$servername = "localhost";
$username = "root";
$password = "";
$database = "rpsgame";
$conn = new mysqli($servername, $username, $password,$database); 
if($conn->connect_error) { 
    die("Connection failed : " . $conn->connect_error); 
} 

  $sql = "SELECT * FROM Resultaten"; 
  if($result = $conn->query($sql)) { 
    while($row = $result->fetch_array()) { 
      echo "<p class='textvisbile'>Resultaat:PC:</p>"."<p class='computer'>".$row['PC']."</p>"."</br>"."</br>"; 
      echo "<p class='player'>Resultaat:Speler:</p>"."<p class='speler'>".$row['Speler']."</p>"."<br>"."</br>";     
      echo "<p class='Won'>".$row['win']. "</p>";
      echo "<p class='Lose'>".$row['lose']. "</p>";
      echo "<p class='Draw'>".$row['draw']. "</p>";

      echo "<br>"; 
      ?><a class="deletescore" href="Deletescore.php?ID=<?php echo $row["ID"]; ?>">Delete</a> <?php
  
    
      echo "<hr/>"; 
    }      
  
}  

    echo "<br><br>";
    echo "<br><br>";  



  $sql = "SELECT COUNT(lose) as 'Verloren'
  FROM Resultaten";   
  $result = $conn->query($sql);
  $row = $result->fetch_array(); 

 
  $sql2 = "SELECT COUNT(win) as 'Gewonnen'
  FROM Resultaten";   
  $result2 = $conn->query($sql2); 
  $row2 = $result2->fetch_array();
  
 
    if ($row['Verloren'] > $row2['Gewonnen']){   
    
      echo "<p class='pcwintmeest'>PC Wint het meest</p>"; 
      
      } elseif ($row2['Gewonnen'] > $row['Verloren']){   
      
      echo "<p class='spelerwintmeest'>De Speler wint het meest</p>";  
      
    }    
    
    echo "<br><br>";
    
    $sql3 = "SELECT
        CONCAT(PC,':',Speler ),
        COUNT(CONCAT(PC,':',Speler )) as STEEN
    FROM
    Resultaten
    WHERE CONCAT(PC,':',Speler ) like '%ock%'";

    $result3= $conn->query($sql3); 
    $row3 = $result3->fetch_array(); 

   


      $sql4 = "SELECT
      CONCAT(PC,':',Speler ),
      COUNT(CONCAT(PC,':',Speler )) as PAPIER
      FROM
      Resultaten
      WHERE CONCAT(PC,':',Speler ) like 'p%'";

      $result4 = $conn->query($sql4); 
      $row4 =  $result4->fetch_array();


    $sql5 = "SELECT
    CONCAT(PC,':',Speler), 
    COUNT(CONCAT(PC,':',Speler )) as SCHAAR
    FROM
    Resultaten
    WHERE CONCAT(PC,':',Speler ) like 's%'";

    $result5 = $conn->query($sql5); 
    $row5 = $result5->fetch_array();  



$intotaal = max($row3['STEEN'] ,$row4['PAPIER'] ,$row5['SCHAAR'] ); 

 
 
    if ($intotaal == $row4['PAPIER']){   
    
      echo "<p>Papier is het meeste gekozen waarde</p>";  
      echo "<br><br>"; 

    } elseif  ($intotaal == $row3['STEEN'] )  { 
      echo "<p>Steen is het meest gekozen waarde</p>";   
      echo "<br><br>";
    }  

    elseif ($intotaal == $row5['SCHAAR']) { 
      echo "<p> Schaar is het meest gekozen waarde </p>";  
      echo "<br><br>";
    }   

    else { 
    echo "<p>Alle waardes zijn het zelfde</p> ";
    }   

 

?>   
