const flashData = $('.flash-data').data('flashdata');



//tambah dan edit
if(flashData != null &&flashData!='kosong'){
	Swal.fire('BERHASIL',flashData,'success'
	);
}

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



