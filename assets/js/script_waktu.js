

const realTime = setInterval(function(){


	const sekarang = new Date();

	const teks = document.getElementById('WIT');
	if (teks) {
		teks.innerHTML = sekarang;
	} else{

	}

},1000);

const realTime2 = setInterval(function(){

const sekarang = new Date();

const teks2 = document.getElementById('WAKTU');
	if (teks2) {
		teks2.innerHTML = sekarang;
	} else{

	}

},1000);


