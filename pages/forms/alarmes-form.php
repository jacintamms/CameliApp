 <?php
 
		 function multiexplode ($delimiters,$string) {
			
			$ready = str_replace($delimiters, $delimiters[0], $string);
			$launch = explode($delimiters[0], $ready);
			return  $launch;
		}

?>
    <?php
        $conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");

				//$conn = pg_connect("host=db.fe.up.pt dbname=siem1638 user=siem1638 password=seai");
        if (!$conn)
          echo "ERRO: Nao foi possivel estabelecer ligacao à base de dados";



	      $query = "SELECT id_sensor, descricao, data_alarme
                    FROM logalarmes
                    WHERE data_alarme = (SELECT max(data_alarme) FROM logalarmes AS l WHERE l.descricao = logalarmes.descricao) ";
          $result = pg_exec($conn, $query);

					//echo $query;

  

						echo "	<tr>";

						echo "	<th>Sensor</th><th>Descriçao</th><th>Data</th>";

						echo "	</tr>";


           /*Acesso em ciclo 'as linhas do resultado para gerar as linhas da tabela*/
           $num_linhas = pg_numrows($result);
           $i = 0;

           while ($i < $num_linhas)
           {
             $linha = pg_fetch_row($result, $i);
						 
						 
						echo "<tr>";	
							
						 	echo "<td>".$linha[0]."</td><td>".$linha[1]."</td><td>".$linha[2]."</td>
                            <td>".$linha[3]."</td>";
						 echo "</tr>";	
						 
						

           $i++;
           }
           



        ?>