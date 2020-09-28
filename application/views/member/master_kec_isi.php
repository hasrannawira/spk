
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Kecamatan</th>
                    <th>Nama Kecamatan</th>
          			<th colspan="2">Aksi</th> 
                  </tr>
                  </thead>
                  <tbody>
    		<?php 
    		$no = 1;
    		foreach ($kec as $kc) : ?>
                  <tr>
                    <td><?php echo $no++ ?></a></td>
            				<td><?php echo $kc->id_kec ?></td>
                    <td><?php echo $kc->nama_kec ?></td>
                    <?php echo '<td><a class="tombol_hapus" href="master_kec_hapus/'.$kc->id_kec.'"><div class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></div></a></td>';?>
                    <?php echo '<td><a class="tombol_edit" href="master_kec_edit/'.$kc->id_kec.'"><div class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></div></a></td>';?>   
                  </tr>
    		 <?php endforeach; ?>
                  </tbody>
                </table>

<script>
  // tombol-hapus
$('.tombol_hapus').on('click',function(e){

  e.preventDefault();

  Swal.fire({
    title: 'Apakah Anda Yakin?',
    text: "Data akan dihapus",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus Data!'
  }).then((result) => {
    if (result.value) {

      const href = $(this).attr('href');
      Swal.fire(
        'Terhapus!',
        'Data telah Terhapus',
        'success'
        )
      document.location.href = href;
    }
  });
})
</script>