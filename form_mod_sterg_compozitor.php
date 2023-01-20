	<form action="prelucrare_modificare_stergere.php" method="POST">
	<table>
  	<tr>
      	  <td>Domeniu</td>
      	  <td><SELECT name="id_domeniu">

          <?

           /* Luam numele de domenii din tabela si Ie afisam utilizatorului intr-o lista drop-   
              down. Obscrvati folosirea lui if pentru a alisa ca selectat domeniul de care apartine  
              cartea
           */

           $sql1 = "select * from domenii order by domeniu asc";
           $resursa1 = mysql_query($sql1);

           while(mysql_fetch_array($resursa1))
           {
	      if($row['id_domeniu'] == $rowCarte['id_domeniu'])
	      {
		print '<option SELECTED value="'.$row['id_domeniu'].'">'
                                                .$row['domeniu']
			.'</option>';
              }else{
		print '<option value="'.$row['id_domeniu'].'">'
				       .$row['domeniu']
			.'</option>';
              }
            }

          ?>

    	 </select>
       </td> 
      </tr> 
      <tr> 
       <td>Compozitor:</td>
       <td>
        <select name="id_compozitor"> 
          
        <?

        /* Afisam si lista dropdown cu autori */

        $sql2 = "select * from compozitori order by compozitor asc"; 
        $resursa2 = mysql_query($sql2); 
        while($row = mysql_fetch_array($resursa2))
        {
   	   if($row['id_compozitor'] == $rowCarte['id_compozitor'])
	   {
      		print '<option SELECTED value="'.$row['id_compozitor'].'">'
					        .$row['compozitor']
                     .'</option>';
   	   }else{
		print '<option value="'.$row['id_compozitor'].'">'
				       .$row['compozitor']
		     .'</option>';
   	   }
        }

        ?> 

        </select>
      </td> 
     </tr> 
     <tr> 
      <td>nume_piesa:</td>
      <td> 
         <INPUT type="text" name="nume_piesa" value="<?=$rowCarte['nume_piesa']?>">
      </td>
     </tr> 
     <tr> 
      <td valign = "top"> Descriere: </td>
      <td><textarea name = "descriere" rows="8"><?=$rowCarte['descriere']?>
          </textarea>
      </td>
     </tr> 
     <tr> 
      <td>Pret:</td>
      <td>
	<INPUT type="text� name="pret" value="<?=$rowCarte['pret']?>">
      </td>
     </tr>
   </table> 
    <INPUT type="hidden" name="id_piesa" value="<?=$rowCarte['id_piesa']?>">
    <INPUT type="submit" name="modifica_piesa" value="Modifica"> 
 </form>