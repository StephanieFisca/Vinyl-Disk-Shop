  
  <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="meniu.css">
      
</head>
<body>

<div class="sidenav">
<a href="index.php">
<img src="Poze/music-note.png" alt="Italian Trulli">
</a>


<div class="search">
      <form action="cautare.php" method="GET">
        <b>Cautare</b><br>
        <input type="text" name="cuvant" size="17" placeholder="Search..." ><br>
        <input type="submit" value="Search">
      </form>
    </div>

<td valign="top" width="125">
  <div>
      <hr size="1">
        <?php
          $sql = " SELECT * FROM domenii ORDER BY domeniu ASC ";
          $sursa = mysqli_query($conn, $sql);
          while($row=mysqli_fetch_array($sursa))
          {
            print '<a href="domeniu.php?id_domeniu='.$row['id_domeniu'].'">'.$row['domeniu'].'</a>' ;
          }
        ?>
    </div>
    
    <br>
    <div>
    <?php
      $nrPiese=0;
      $totalValoare=0;
	  if(isset($_SESSION['nume_piesa']))
	  {
		  for($i=0; $i < count($_SESSION['nume_piesa']); $i++)
		  {
			$nrPiese = $nrPiese + $_SESSION['nr_piese'][$i];
			$totalValoare=$totalValoare+$_SESSION['nr_piese'][$i]*$_SESSION['pret'][$i];
		  }
	  }
    ?>
    <a href="cos.php">Aveti<b><?=$nrPiese?></b> piese in cos, in valoare totala de <b><?=$totalValoare?></b> euro.
    Click aici pentru a vedea continutul cosului</a>
    <div class="login">
    <a href="administrare.php"> Log in </a>
  </div>
    </div>
</td>
</div>
