<?php 

// EXAMPLE 
require "classes/communitybps.php";
$communitybps = new CommunityBPS('bps7206','blablabla'); // YOU CAN LOGIN WITH ANY ACCOUNT COMMUNITY INCLUDING YOUR SATKER ACCOUNT

?>

<style>
	pre {
		width: 100%;
		padding: 0;
		margin: 0;
		overflow: auto;
		overflow-y: hidden;
		font-size: 12px;
		line-height: 20px;
		background: #efefef;
		border: 1px solid #777;
		background: url(lines.png) repeat 0 0;
	}
	pre code {
		padding: 10px;
		color: #333;
	}
	hr{
		margin-top: 20px;
		margin-bottom: 20px;
	}
</style>

Berikut ini adalah pegawai dengan NIP 340057260:<br/>
<pre>
	<code>
		<?php //print_r($communitybps->getprofil('340057260')); ?>
	</code>
</pre>

<hr/>

Berikut ini adalah daftar pegawai dengan kode bps 7206:<br/>
<pre>
	<code>
		<?php //print_r($communitybps->get_list_pegawai_kabkot('7206')); ?>
	</code>
</pre>

<hr/>

Berikut ini adalah daftar pegawai dengan kode provinsi 7200:<br/>
<pre>
	<code>
		<?php //print_r($communitybps->get_list_pegawai_provinsi('7200')); ?>
	</code>
</pre>

<hr/>

Berikut ini adalah pencarian pegawai dengan query 34005726:<br/>
<pre>
	<code>
		<?php //print_r($communitybps->pencarian('34005726')); ?>
	</code>
</pre>