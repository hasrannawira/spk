<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=".$nomor_surat.".doc");
?>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title> Nomor Surat </title>
 	<style>
		table {
			width: 100%;
		  	border-collapse: collapse;
		}

		table, td, th {
			font-size: 14.5px;
			font-family: Calibri (Body);
		  	border: 1px ;
		 	padding : 4px;
		}
	</style>
 </head>

 <body bgcolor="white">
 	<table>
	  <tr>
	    <th style="width: 10%">
	    	<img width="2%" height="2%" src="https://laci.bps.go.id/s/DfZet8gB8D8iuO6/download">
	    </th>
	    <th style="width: 90%;text-align: left;">
	    	<p>
	    	<b style="font-size: 20px">
	    	BADAN PUSAT STATISTIK <br>
	    	KABUPATEN MANOKWARI</b><br>
	    	<br>
	    	<i>Jalan Percetakan Negara, Manokwari, Papua Barat </i><br>
	    	</p>
	    </th>
	  </tr>
	</table>
	<p align="right">
		<?= date("l, j F Y", strtotime($tanggal)) ?>
  	</p>
  	<div style="line-height: normal;">
	  	<p>
	  		Nomor &emsp;&emsp;&emsp; : <?= $nomor_surat ?><br>
	  		Lampiran &emsp;&emsp; : <br>
	  		Pemberitahuan : <?= $perihal ?><br><br><br>

	  		Kepada Yth, <br>
	  		<?= $kepada ?> <br> <br>
	  		Di – <br>
	  		&emsp;  (………………………….)

	  		<br><br><br><br>
	  		<br><br><br><br>


			<br><br><br><br><br><br>
	  	</p>
	  	<p>
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  		<b>Kepala Badan Pusat Statistik</b><br>
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 		
			<b>Kabupaten Manokwari</b><br><br><br><br><br>
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  		
	  		<b>Mustamir, SE., MM.</b><br>
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
	  		<b>NIP. 19710812 199203 2 001</b>
	  		
	  	</p>
	  	<p>
 			Tembusan : <br>
			1.	(……….) <br>
			2.	(……….) <br>
			3.	Dst…… <br>
		</p>
  	</div>
 </body>
</html>