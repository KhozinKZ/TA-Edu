



// ------------------keranjang----------------------
$('#jumlah').on('input', function () {
        checkkerjumlah();
   });

$('#jumlah_edit').on('input', function () {
        checkkerjumlah_edit();
   });

$('#kerukuran').on('input', function () {
        checkkerukuran();
   });


function checkkerjumlah_edit() {
    var pattern = /^[0-9-' ]+$/;
     // Mendapatkan nilai dari input jumlah modal
    var jumlah = $('#jumlah_edit').val();
    var validjum = pattern.test(jumlah);
    // Mendapatkan nilai stokBarang dari input stok modal
    var stokBarang = $('#stok').val();

    // Konversi nilai stokBarang menjadi angka
    var stok = parseFloat(stokBarang);

    // Konversi nilai jumlah menjadi angka
    var jumlahAngka = parseFloat(jumlah);

    // console.log('Nilai jumlah:', jumlahAngka);
    // console.log('Nilai stok:', stok);

    if (jumlah == "") {
        $('#kerjumlah_err').html('Masukkan Jumlah');
        return false;
    } else if (!validjum) {
        $('#kerjumlah_err').html('Masukkan Nilai Angka');
        return false;
    } else if (parseFloat(jumlah) > parseFloat(stokBarang)) {
        $('#kerjumlah_err').html('Jumlah melebihi stok yang tersedia');
        return false;
    } else {
        $('#kerjumlah_err').html('');
        return true;
    }
}


 function checkkerjumlah() {
    
 var pattern = /^[0-9-' ]+$/;
    var jumlah = $('#jumlah').val();
    var validjum = pattern.test(jumlah);
    var stok = parseInt(stokBarang);

     console.log('Nilai jumlah:', jumlah);
        console.log('Nilai stok:', stok);


    if (jumlah == "") {
        $('#kerjumlah_err').html('Masukkan Jumlah');
        return false;
    } else if (!validjum) {
        $('#kerjumlah_err').html('Masukkan Nilai Angka');
        return false;
    } else if (parseInt(jumlah) > stok) {
        $('#kerjumlah_err').html('Jumlah melebihi stok yang tersedia');
        return false;
    } else {
        $('#kerjumlah_err').html('');
        return true;
    }
  }

// document.getElementById('jumlah').addEventListener('input', function() {
//     var jumlah = parseInt(this.value); // Mendapatkan nilai jumlah dari input
//     var stok = parseInt("{{ $barang->stok }}"); // Mendapatkan nilai stok dari PHP

//     // Memeriksa apakah jumlah yang dimasukkan melebihi stok
//     if (jumlah > stok) {
//         document.getElementById('kerjumlah_err').textContent = 'Jumlah melebihi stok yang tersedia';
//     } else {
//         document.getElementById('kerjumlah_err').textContent = ''; // Menghapus pesan error jika jumlah valid
//     }
// });


// agar tidak ada huruf E yang masuk di dalam form nik
    function validateInput(input) {
        // Hapus karakter selain angka
        input.value = input.value.replace(/[^0-9]/g, '');
      }

function checkkerukuran() {
       if(document.getElementById('kerukuran').selectedIndex == 0)
    {
        $('#kerukuran_err').html('Silahkan Pilih Ukuran');
        // document.myform.agama.focus();  
        return false;
    } else {
        
        $('#kerukuran_err').html('');
        return true;
    }
      
    }


  



// -----------barang.blade--------------------------
  $('#produk').on('input', function () {
        checkproduk();
   });

  $('#pakaian').on('input', function () {
        checkpakaian();
   });

  $('#harga').on('input', function () {
        checkharga();
   });

  $('#stok').on('input', function () {
        checkstok();
   });

  // $('#ukuran').on('input', function () {
  //       checkukuran();
  //  });

  $('#ukuran').on('change', function () {
    checkukuran();
    });

  $('#keterangan').on('input', function () {
        checkket();
   });
  
  $('#file').on('input', function () {
        checkfile();
   });
  // ---------------------------------------------------------------
    function checkproduk() {
    var pattern =/^[A-Za-z-' ]+$/;
    var user = $('#produk').val();
    var validuser = pattern.test(user);
    if (user == "") {
        $('#produk_err').html('Masukkan Produk');
        return false;
    } else if ($('#produk').val().length < 4) {
        $('#produk_err').html('Nama Produk Terlalu Pendek');
        return false;
    } else if (!validuser) {
        $('#produk_err').html('Username Harus Huruf a-z ,A-Z');
        return false;
    } else {
        $('#produk_err').html('');
        return true;
    }
  }

 function checkpakaian() {
       if(document.getElementById('pakaian').selectedIndex == 0)
    {
        $('#pakaian_err').html('Silahkan Pilih Jenis Pakaian');
        // document.myform.agama.focus();  
        return false;
    } else {
        
        $('#pakaian_err').html('');
        return true;
    }
      
    }


 function checkharga() {
    var pattern =/^[0-9-' ]+$/;
    var harga = $('#harga').val();
    var validharga = pattern.test(harga);
    if (harga == "") {
        $('#harga_err').html('Masukkan Nilai Harga');
        return false;
    } else if (!validharga) {
        $('#harga_err').html('Masukkan Nilai Angka');
        return false;
    } else {
        $('#harga_err').html('');
        return true;
    }
  }

 function checkstok() {
    var pattern =/^[0-9-' ]+$/;
    var stok = $('#stok').val();
    var validstok = pattern.test(stok);
    if (stok == "") {
        $('#stok_err').html('Masukkan Nilai Harga');
        return false;
    } else if (!validstok) {
        $('#stok_err').html('Masukkan Nilai Angka');
        return false;
    } else {
        $('#stok_err').html('');
        return true;
    }
  }

  // function checkukuran() {
  //      if(document.getElementById('ukuran').selectedIndex == 0)
  //   {
  //       $('#ukuran_err').html('Silahkan Pilih Jenis Ukuran');
  //       // document.myform.agama.focus();  
  //       return false;
  //   } else {
        
  //       $('#ukuran_err').html('');
  //       return true;
  //   }
      
  //   } 

  function checkukuran() {
    var selectedValues = $('#ukuran').val();

    if (!selectedValues || selectedValues.length === 0) {
        $('#ukuran_err').html('Silahkan Pilih Jenis Ukuran');
        return false;
    } else {
        $('#ukuran_err').html('');
        return true;
    }
    }




  function checkket() {
    var ket = $('#keterangan').val();
    if (ket == "") {
        $('#keterangan_err').html('Masukkan Keterangan Barang');
        return false;
    } else {
        $('#keterangan_err').html('');
        return true;
    }
  }

function checkfile() {
    var fileInput = document.getElementById('file');
    var file = fileInput.value;
    
    if (file === "") {
        $('#file_err').html('Masukkan Foto Barang');
        return false;
    } else {
        var uploadField = document.getElementById("file");
        var fileSize = uploadField.files[0].size;
        
        // Cek ukuran file
        if (fileSize > 800000) { // 800 KB
            alert("Maaf. File Terlalu Besar! Maksimal Upload 800 KB");
            uploadField.value = "";
            $('#file_err').html('Masukkan Foto Barang');
            return false;
        }

        // Cek ekstensi file
        var allowedExtensions = /(\.jpg|\.jpeg)$/i; // Sesuaikan ekstensi yang diizinkan
        if (!allowedExtensions.exec(file)) {
            alert('Maaf. Ekstensi file tidak diizinkan. Hanya file JPG, JPEG, yang diperbolehkan.');
            uploadField.value = "";
            $('#file_err').html('Masukkan Foto Barang');
            return false;
        }

        $('#file_err').html('');
        return true;        
    }
}





//   function checkfile() {
//     var file = $('#file').val();
//     if (file == "") {
//         $('#file_err').html('Masukkan Foto Barang');
//         return false;
//     } else {
//         var uploadField = document.getElementById("file");
//         if(uploadField.files[0].size > 800000){ // ini untuk ukuran 800KB, 1000000 untuk 1 MB.
//            alert("Maaf. File Terlalu Besar ! Maksimal Upload 800 KB");
//            uploadField.value = "";
//            $('#file_err').html('Masukkan Foto Barang');
//            return false;
//         }
//         $('#file_err').html('');
//          return true;        
//     }
// }