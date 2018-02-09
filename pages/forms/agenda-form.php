    <?php
	
		$datahoje = date('Y-n-d');
	 
        $conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");

				//$conn = pg_connect("host=db.fe.up.pt dbname=siem1638 user=siem1638 password=seai");
        if (!$conn)
          echo "ERRO: Nao foi possivel estabelecer ligacao à base de dados";



          $query = "Select * FROM vinha.eventos WHERE data >= '".$datahoje."'::date ORDER BY data ASC" ;

          $result = pg_exec($conn, $query);

					//echo $query;

      

           /*Acesso em ciclo 'as linhas do resultado para gerar as linhas da tabela*/
           $num_linhas = pg_numrows($result);
           $i = 0;
		   
		   
			
			echo "<tr>";
				echo "<th>Evento</th><th>Descriçao</th><th>Data</th><th>Alerta</th>";
			echo "</tr>";

           while ($i < $num_linhas)
           {
             $linha = pg_fetch_row($result, $i);
						 echo "<tr>";
							//tirar o ano
						 	$parts = explode("-",$linha[3]); 
							$linha[3] = "";
							$linha[3] = $parts[2].'-'.$parts[1];
							$parts = "";
							
						 	echo "<td>".$linha[1]."</td><td>".$linha[2]."</td><td>".$linha[3]."</td><td>".$linha[4]."</td>";
						 echo "</tr>";

           $i++;
           }
          



        ?>


