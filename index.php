<?php
  session_start();
  include ("conectare.php");
  include ("meniu.php");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="index.css">
<script src="page_top.js"></script>
</head>
<div class="page">
  
<div id="slider">
<ul id="slideWrap"> 
<li><img src="slideshow/vinyl1.jpg" alt=""></li>
      <li><img src="slideshow/vinyl2.jpg"alt=""></li>
      <li><img src="slideshow/vinyl3.jpg" alt=""></li>
      <li><img src="slideshow/vinyl4.jpg" alt=""></li>
      <li><img src="slideshow/vinyl5.jpg" alt=""></li>
      <li><img src="slideshow/vinyl6.jpg" alt=""></li>
    </ul>
    <a id="prev" href="#">&#8810;</a>
    <a id="next" href="#">&#8811;</a>
</div>
<body bgcolor="#ffffff">
<table>
    <tr>

<td valign="top"> 
<div class="new_products">
  <h1><b>Cele mai noi piese</b></h1>
  <table cellpadding="5" >
    <tr>
    <?php
      /*in urmatoarea interogare selectam informaţii despre cele mai noi trei carti şi le afişam pe
      fiecare intr-o celula de tabel*/
      $sql="SELECT id_piesa, nume_piesa, compozitor, pret FROM piese, compozitori WHERE piese.id_compozitor = compozitori.id_compozitor ORDER BY datai DESC LIMIT 0,3";
      $sursa=mysqli_query($conn, $sql);
	  
      while($row=mysqli_fetch_array($sursa))
      {
        /* deschidem celula tabelului HTML */
        print '<td align = "center" style="width: 500px;">' ;
        /*punem şi imaginea copertei daca exista, daca nu,
        afişam un layer DIV în care scriem “Fara imagine”*/
		    $adrimag="Poze/".$row['id_piesa'].".jpg";
        /*adresa imagine va fi "c:/coperte/111.jpg" pentru cartea cu id_carte=111,
        "c:/coperte/112.jpg" pentru cartea cu id_carte=112, ...
        functia file_exists returneaza TRUE daca fisierul specificat exista */
        if(file_exists($adrimag))
        {
		  $adrimag="Poze/".$row['id_piesa'].".jpg";
		  print '<img src="'.$adrimag.'" width=auto height="150"><br>';
        }
        else
        {
          /*daca nu exista fişierul specificat afisam layerul DIV in care scriem
          "Fara imagine"*/
          print '<div style="width:75px; height:100px; border: 1px black solid;
          background-color:#cccccc";>Fara imagine</div>';
        }
        /*afisam campurile titlu, autor, pret*/
		
        print '<b><a href="piesa.php?id_piesa='.$row['id_piesa'].'">'
        .$row['nume_piesa'].'</a></b><br> de <i>'
        .$row['compozitor'].'</i><br> pret: '
        .$row['pret'].' euro
        </td>';
        /*inchidem celula <td> deschisa in while*/
      }
      /*inchidem tabelul, tragem o linie si rescriem codul pentru cele mai populare carţi
      modificând doar interogarea SQL */
    ?>
    </tr>
  </table>
    </div>
  <hr>
  <div class="popular_products">
 <h2> <b>Cele mai populare produse</b></h2>
  <table cellpadding="7">
    <tr>
    <?php
      /*Cele mai populare carţi sunt şi cele mai vândute, consultând tabelul cu interogarea */
      $sqlVanzari = "SELECT id_piesa, sum(nr_piese) AS bucatiVandute FROM vanzari GROUP BY id_piesa ORDER BY bucatiVandute DESC LIMIT 0,3";
      $resursaVanzari=mysqli_query($conn, $sqlVanzari);
      /* Valorile din acest query sunt trei id_carte din tabelul vânzari care corespund celor
      mai vândute trei carţi şi numarul total de bucaţi vândute din fiecare. Vom folosi aceste id-uri
      pentru a interoga, cu fiecare din ele, baza de date şi a afla titlul, autorul şi preţul fiecareia
      dintre ele: */
      while ($rowVanzari=mysqli_fetch_array($resursaVanzari))
      {
        $sqlCarte="SELECT id_piesa,nume_piesa, compozitor, pret FROM piese, compozitori WHERE piese.id_compozitor=compozitori.id_compozitor AND id_piesa=".$rowVanzari['id_piesa'];
		$resursaCarte=mysqli_query($conn, $sqlCarte);
        /* Acum avem toate datele care ne intereseaza: id_carte (din interogarea $sqlVanzari),
        titlul, numele autorului şi numarul de bucaţi vândute. Sa le afişam: */
        while ($rowCarte = mysqli_fetch_array($resursaCarte))
        {
    ?>
          <td align = "center" style="width: 500px;">
          <?php
          $adrimag="Poze/".$rowCarte['id_piesa'].".jpg";
          if(file_exists($adrimag))
		  {		  
			  $adrimag="Poze/".$rowCarte['id_piesa'].".jpg";
			  print '<img src="'.$adrimag.'" width=auto height="150" align = center><br>';
          }
		  else
          {
            /*daca nu exista fis specificat afişam layerul DIV in care scrie "fara imagine"*/
            print '<div style="width:75px; height:100px; border: 1px black solid; background-color:#cccccc">fara imagine</div>';
          }
          print '<b><a href="piesa.php?id_carte='.$rowVanzari['id_piesa'].'">
          '.$rowCarte['nume_piesa'].'</a></b><br>
          de <i>'.$rowCarte['compozitor'].'</i><br>
          pret: '.$rowCarte['pret'].' euro </td>';
        }
      }
    ?>
    </tr>
  </table>
</td>
</div>
</tr>
</table>
    </div>
    
