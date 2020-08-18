                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Tabel</th>
                    <th>Nama Tabel</th>
                    <th>Jenis Tabel</th>
                   <th colspan="2">Aksi</th> 
                  </tr>
                  </thead>
                  <tbody>
        <?php 
        $no = 1;
        foreach ($tabel as $tbl) : ?>
                  <tr>
                    <td><?php echo $no++ ?></a></td>
                    <td><?php echo $tbl->kode_tabel ?></td>
                    <td><?php echo $tbl->nama_tabel ?></td>
                    <td><?php if ($tbl->jenis_tabel = 1) {
                      echo 'Tabel Inti';
                    } elseif ($tbl->jenis_tabel = 2) {
                      echo 'Tabel Tambahan';
                    }  ?></td>           
                    <td><a class="tombol_hapus" href="<?php echo 'hapus_data_tabel/'.$tbl->id_tabel ?>"><div class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></div></a></td>           
                    <td><a class="input_data_tabel" href="<?php echo 'input_data_tabel/'.$tbl->id_tabel ; ?>"><div class="btn btn-primary btn-sm"> <i class="fa fa-wpforms"></i></div></a></td>            
       
                  </tr>
         <?php endforeach; ?>
                  </tbody>
                </table>


<script>
  $('.input_data_tabel').on('click',function(e){

    e.preventDefault();
    var e = document.getElementById("mySelect");
    var idBuku = e.options[e.selectedIndex].value;
    if (idBuku){
    const href = $(this).attr('href');
    href2 = href + "/" + idBuku;
    document.location.href = href2;      
    } else{
      alert("Anda belum memilih Buku");
    }

  });
</script>
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