  <!-- Core -->
  <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{asset('vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{asset('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Optional JS -->
  <script src="{{asset('vendor/chart.js/dist/Chart.min.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('vendor/chart.js/dist/Chart.extension.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{asset('js/argon.min9f1e.js?v=1.1.0')}}"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="{{asset('js/demo.min.js')}}"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.1.0.js"></script> -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
      $('#tblBuku').DataTable();
      $('#tblAnggota').DataTable();
      $('#tblPinjam').DataTable();
    });

    function logout(){
      swal({
        title: "Apa Anda Ingin Keluar?",
        text: "Jika anda keluar maka anda harus login lagi terlebih dahulu!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = '{{url("actionLogout")}}';
        } else {
        }
      });
    } 

    function filterJurnal(){
      var id_kelas = $("#Kelas").val();
      var id_gurumapel = $("#Mapel").val();
      $('#tblJurnal tbody tr').remove();
      $.ajax({
        type: 'POST',
        url: '{{url("getJurnal")}}',
        data: {
          'id_kelas': id_kelas,
          'id_gurumapel': id_gurumapel,
          "_token" : "{{ csrf_token() }}"
        },
        dataType: 'json',
        success: function (data) {
          if (data != 'fail') {
            console.log(data);
            var tbl = '';
            for (var i = 0; i < data.length; i++) {
              var no = i + 1;
              tbl += '<tr>';
              tbl += '<td>' + no + '</td>';
              tbl += '<td>' + data[i].tanggal + '</td>';
              tbl += '<td>' + data[i].mapel + '</td>';
              tbl += '<td>' + data[i].materi + '</td>';
              tbl += '<td>' + data[i].keterangan + '</td>';
              tbl += '<td><button class="btn btn-warning btn-sm" type="button" onclick="editJurnal('+data[i].id_jurnal+')" title="Ubah Data"><i class="fa fa-edit"></i></button><button class="btn btn-danger btn-sm" type="button" onclick="deleteJurnal('+data[i].id_jurnal+')" title="Hapus Data"><i class="fa fa-trash"></i></button></td>';
              tbl += '</tr>';
            }
            $('#tblJurnal tbody').append(tbl);
          } else {
            var tbl = '<tr><td colspan="6">NO DATA AVAILABLE IN TABLE</td></tr>';
            $('#tblJurnal tbody').append(tbl);
          }
        }
      });
    }
  </script>

<!-- Buku -->
<script type="text/javascript">
  function tambahBuku(){
    var judul_buku = $("#judul").val();
    var penerbit = $("#penerbit").val();
    var pengarang = $("#pengarang").val();
    var tahun_terbit = $("#tahun_terbit").val();
    var stok_buku = $("#stok").val();
    var no_rak = $("#norak").val();
    var kategori = $("#kategori").val();

    if (judul_buku == "") {
      swal("Mohon Isi Judul Buku !", "Mohon Coba Lagi", "error");
    }
    else if (penerbit == "") {
      swal("Mohon Isi Penerbit !", "Mohon Coba Lagi", "error");
    }
    else if (pengarang == "") {
      swal("Mohon Isi Pengarang !", "Mohon Coba Lagi", "error");
    }
    else if (tahun_terbit == "") {
      swal("Mohon Isi Tahun Terbit !", "Mohon Coba Lagi", "error");
    }
    else if (stok_buku == "") {
      swal("Mohon Isi Stok Buku !", "Mohon Coba Lagi", "error");
    }
    else if (no_rak == "") {
      swal("Mohon Isi No Rak Buku !", "Mohon Coba Lagi", "error");
    }
    else if (kategori == "") {
      swal("Mohon Isi Kategori !", "Mohon Coba Lagi", "error");
    }
    else {
      $.ajax({
        url: '/tambahBuku',
        type: 'POST',
        data: {
          "judul_buku" : judul_buku,
          "penerbit" : penerbit,
          "pengarang" : pengarang,
          "tahun_terbit" : tahun_terbit,
          "stok_buku" : stok_buku,
          "no_rak" : no_rak,
          "kategori" : kategori,
          "_token" : "{{ csrf_token() }}",
        },
        dataType: "html",
        error: function (xhr, ajaxOptions, thrownError) {
          swal("Gagal Menambahkan !", "Mohon Coba Lagi", "error");
        },
        success: function(data) {
          if (data == 'success') {
            swal("Berhasil !", "Data Berhasil Ditambah !", "success");
            setTimeout(function(){
              window.location.reload();
            }, 1000);
          }else{
            swal("Gagal !", "Data Gagal Ditambah !", "error");
          }
        }
      });
    }
  } 

  function editBuku(kd_buku){
    $.ajax({
      url: '/editBuku/' + kd_buku,
      type: 'GET',
      data: {
        "_token" : "{{ csrf_token() }}",
      },
      dataType: "JSON",
      error: function (xhr, ajaxOptions, thrownError) {
        swal("Gagal Menampilkan !", "Mohon Coba Lagi", "error");
      },
      success: function(data) {
        if (data != 'fail') {
          console.log(data);
          $("#ModalEditBuku").modal('show');
          $("#kd_buku").val(data.kd_buku);
          $("#ejudul").val(data.judul_buku);
          $("#epengarang").val(data.pengarang);
          $("#epenerbit").val(data.penerbit);
          $("#etahun_terbit").val(data.tahun_terbit);
          $("#estok").val(data.stok_buku);
          $("#enorak").val(data.no_rak);
          $("#ekategori").val(data.kategori);
        }else{
          swal("Gagal Menampilkan !", "Mohon Coba Lagi", "error");
        }
      }
    });
  }

  function updateBuku(){
    var kd_buku = $("#kd_buku").val();
    var judul_buku = $("#ejudul").val();
    var penerbit = $("#epenerbit").val();
    var pengarang = $("#epengarang").val();
    var tahun_terbit = $("#etahun_terbit").val();
    var stok_buku = $("#estok").val();
    var no_rak = $("#enorak").val();
    var kategori = $("#ekategori").val();

    if (judul_buku == "") {
      swal("Mohon Isi Judul Buku !", "Mohon Coba Lagi", "error");
    }
    else if (penerbit == "") {
      swal("Mohon Isi Penerbit !", "Mohon Coba Lagi", "error");
    }
    else if (pengarang == "") {
      swal("Mohon Isi Pengarang !", "Mohon Coba Lagi", "error");
    }
    else if (tahun_terbit == "") {
      swal("Mohon Isi Tahun Terbit !", "Mohon Coba Lagi", "error");
    }
    else if (stok_buku == "") {
      swal("Mohon Isi Stok Buku !", "Mohon Coba Lagi", "error");
    }
    else if (no_rak == "") {
      swal("Mohon Isi No Rak Buku !", "Mohon Coba Lagi", "error");
    }
    else if (kategori == "") {
      swal("Mohon Isi Kategori !", "Mohon Coba Lagi", "error");
    }
    else {
      swal({
        title: "Apa Data Tersebut Ingin Diedit?",
        text: "Jika Diedit data tidak bisa dikembalikan lagi!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willUpdate) => {
        if (willUpdate) {
          $.ajax({
            url: '/updateBuku/' + kd_buku,
            type: 'PUT',
            data: {
              "judul_buku" : judul_buku,
              "penerbit" : penerbit,
              "pengarang" : pengarang,
              "tahun_terbit" : tahun_terbit,
              "stok_buku" : stok_buku,
              "no_rak" : no_rak,
              "kategori" : kategori,
              "_token" : "{{ csrf_token() }}",
            },
            dataType: "HTML",
            error: function (xhr, ajaxOptions, thrownError) {
              swal("Gagal Merubah !", "Mohon Coba Lagi", "error");
            },
            success: function(data) {
              if (data == 'success') {
                swal("Berhasil !", "Data Berhasil Diubah !", "success");
                setTimeout(function(){
                  window.location.reload();
                }, 1000);
              }else{
                swal("Gagal !", "Data Gagal Diubah !", "error");
              }
            }
          });
        } else {
        }
      });
    }
  }

  function deleteBuku(kd_buku){
    swal({
      title: "Apa Buku Ini Ingin Dihapus?",
      text: "Jika dihapus data tidak bisa dikembalikan lagi!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '/hapusBuku/' + kd_buku,
          type: 'DELETE',
          data: {
            "_token" : "{{ csrf_token() }}",
          },
          dataType: "html",
          error: function (xhr, ajaxOptions, thrownError) {
            swal("Gagal Menghapus !", "Mohon Coba Lagi", "error");
          },
          success: function(data) {
            if (data == 'success') {
              swal("Berhasil !", "Data Berhasil Dihapus !", "success");
              setTimeout(function(){
                window.location.reload();
              }, 1000);
            }else{
              swal("Gagal !", "Data Gagal Dihapus !", "danger");
            }
          }
        });
      } else {
      }
    });
  } 
</script>


<!-- Anggota -->
<script type="text/javascript">
  function tambahUser(){
    var nama = $("#nama").val();
    var no_hp = $("#nohp").val();
    var email = $("#email").val();
    var username = $("#username").val();
    var password = $("#password").val();

    if (nama == "") {
      swal("Mohon Isi Nama Anggota !", "Mohon Coba Lagi", "error");
    }
    else if (no_hp == "") {
      swal("Mohon Isi No Handphone !", "Mohon Coba Lagi", "error");
    }
    else if (email == "") {
      swal("Mohon Isi Email !", "Mohon Coba Lagi", "error");
    }
    else if (username == "") {
      swal("Mohon Isi UserName !", "Mohon Coba Lagi", "error");
    }
    else if (password == "") {
      swal("Mohon Isi Password !", "Mohon Coba Lagi", "error");
    }
    else {
      $.ajax({
        url: '/tambahUser',
        type: 'POST',
        data: {
          "nama" : nama,
          "no_hp" : no_hp,
          "email" : email,
          "username" : username,
          "password" : password,
          "_token" : "{{ csrf_token() }}",
        },
        dataType: "html",
        error: function (xhr, ajaxOptions, thrownError) {
          swal("Gagal Menambahkan !", "Mohon Coba Lagi", "error");
        },
        success: function(data) {
          if (data == 'success') {
            swal("Berhasil !", "Data Berhasil Ditambah !", "success");
            setTimeout(function(){
              window.location.reload();
            }, 1000);
          }else{
            swal("Gagal !", "Data Gagal Ditambah !", "error");
          }
        }
      });
    }
  } 

  function editUser(kd_user){
    $.ajax({
      url: '/editUser/' + kd_user,
      type: 'GET',
      data: {
        "_token" : "{{ csrf_token() }}",
      },
      dataType: "JSON",
      error: function (xhr, ajaxOptions, thrownError) {
        swal("Gagal Menampilkan !", "Mohon Coba Lagi", "error");
      },
      success: function(data) {
        if (data != 'fail') {
          console.log(data);
          $("#ModalEditUser").modal('show');
          $("#kd_user").val(data.kd_user);
          $("#enama").val(data.nama);
          $("#enohp").val(data.no_hp);
          $("#eemail").val(data.email);
          $("#eusername").val(data.username);
        }else{
          swal("Gagal Menampilkan !", "Mohon Coba Lagi", "error");
        }
      }
    });
  }

  function updateUser(){
    var kd_user = $("#kd_user").val();
    var nama = $("#enama").val();
    var no_hp = $("#enohp").val();
    var email = $("#eemail").val();
    var username = $("#eusername").val();

    if (nama == "") {
      swal("Mohon Isi Nama Anggota !", "Mohon Coba Lagi", "error");
    }
    else if (no_hp == "") {
      swal("Mohon Isi No Handphone !", "Mohon Coba Lagi", "error");
    }
    else if (email == "") {
      swal("Mohon Isi Email !", "Mohon Coba Lagi", "error");
    }
    else if (username == "") {
      swal("Mohon Isi UserName !", "Mohon Coba Lagi", "error");
    }
    else {
      swal({
        title: "Apa Data Tersebut Ingin Diedit?",
        text: "Jika Diedit data tidak bisa dikembalikan lagi!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willUpdate) => {
        if (willUpdate) {
          $.ajax({
            url: '/updateUser/' + kd_user,
            type: 'PUT',
            data: {
              "nama" : nama,
              "no_hp" : no_hp,
              "email" : email,
              "username" : username,
              "_token" : "{{ csrf_token() }}",
            },
            dataType: "HTML",
            error: function (xhr, ajaxOptions, thrownError) {
              swal("Gagal Merubah !", "Mohon Coba Lagi", "error");
            },
            success: function(data) {
              if (data == 'success') {
                swal("Berhasil !", "Data Berhasil Diubah !", "success");
                setTimeout(function(){
                  window.location.reload();
                }, 1000);
              }else{
                swal("Gagal !", "Data Gagal Diubah !", "error");
              }
            }
          });
        } else {
        }
      });
    }
  }

  function deleteUser(kd_user){
    swal({
      title: "Apa Anggota Ini Ingin Dihapus?",
      text: "Jika dihapus data tidak bisa dikembalikan lagi!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '/hapusUser/' + kd_user,
          type: 'DELETE',
          data: {
            "_token" : "{{ csrf_token() }}",
          },
          dataType: "html",
          error: function (xhr, ajaxOptions, thrownError) {
            swal("Gagal Menghapus !", "Mohon Coba Lagi", "error");
          },
          success: function(data) {
            if (data == 'success') {
              swal("Berhasil !", "Data Berhasil Dihapus !", "success");
              setTimeout(function(){
                window.location.reload();
              }, 1000);
            }else{
              swal("Gagal !", "Data Gagal Dihapus !", "danger");
            }
          }
        });
      } else {
      }
    });
  } 
</script>


<!-- Anggota -->
<script type="text/javascript">
  function detailPengajuan(kd_pinjam){
    $.ajax({
      url: '/detailPengajuan/' + kd_pinjam,
      type: 'GET',
      data: {
        "_token" : "{{ csrf_token() }}",
      },
      dataType: "JSON",
      error: function (xhr, ajaxOptions, thrownError) {
        swal("Gagal Menampilkan !", "Mohon Coba Lagi", "error");
      },
      success: function(data) {
        if (data != 'fail') {
          console.log(data);
          $("#ModalPengajuan").modal('show');
          $("#kd_pinjam").val(data.kd_pinjam);
          $("#kd_buku").val(data.kd_buku);
          $("#status").val(data.status);
          $("#nama").val(data.nama);
          $("#judul").val(data.judul_buku);
          $("#tgl_pinjam").val(data.tanggal_pinjam);
          $("#tgl_kembali").val(data.tanggal_kembali);

          if (data.status == "meminjam") {
            $("#stpinjam").show();
            $("#stkosong").hide();
          }
          else if (data.status == "sudah dikembalikan") {
            $("#stpinjam").hide();
            $("#stkosong").hide();
          }
          else {
            $("#stpinjam").hide();
            $("#stkosong").show();
          }

        }else{
          swal("Gagal Menampilkan !", "Mohon Coba Lagi", "error");
        }
      }
    });
  }

  function dikembalikan(){
    var kd_pinjam = $("#kd_pinjam").val();
    var kd_buku = $("#kd_buku").val();
      swal({
        title: "Yakin Buku Sudah Dikembalikan ?",
        // text: "Jika Diedit data tidak bisa dikembalikan lagi!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willUpdate) => {
        if (willUpdate) {
          $.ajax({
            url: '/dikembalikan/' + kd_pinjam,
            type: 'PUT',
            data: {
              "_token" : "{{ csrf_token() }}",
            },
            dataType: "HTML",
            error: function (xhr, ajaxOptions, thrownError) {
              swal("Gagal Merubah !", "Mohon Coba Lagi", "error");
            },
            success: function(data) {
              if (data == 'success') {
                swal("Berhasil !", "Buku Sudah Dikembalikan !", "success");
                setTimeout(function(){
                  window.location.reload();
                }, 1000);
              }else{
                swal("Gagal !", "Data Gagal Diubah !", "error");
              }
            }
          });
        } 
      });
  }

  function approved(){
    var kd_pinjam = $("#kd_pinjam").val();
    var kd_buku = $("#kd_buku").val();
      swal({
        title: "Yakin Ingin Mengapproved Pengajuan Ini ?",
        // text: "Jika Diedit data tidak bisa dikembalikan lagi!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willUpdate) => {
        if (willUpdate) {
          $.ajax({
            url: '/approved/' + kd_pinjam,
            type: 'PUT',
            data: {
              "_token" : "{{ csrf_token() }}",
            },
            dataType: "HTML",
            error: function (xhr, ajaxOptions, thrownError) {
              swal("Gagal Mengapproved !", "Mohon Coba Lagi", "error");
            },
            success: function(data) {
              if (data == 'success') {
                swal("Berhasil !", "Pengajuan Pinjaman Telah Di Approved !", "success");
                setTimeout(function(){
                  window.location.reload();
                }, 1000);
              }else{
                swal("Gagal !", "Data Gagal Diubah !", "error");
              }
            }
          });
        } 
      });
  }

  function rejected(){
    var kd_pinjam = $("#kd_pinjam").val();
    swal({
      title: "Apa Anda Ingin Merejected Pengajuan Ini ?",
      // text: "Jika dihapus data tidak bisa dikembalikan lagi!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '/rejected/' + kd_pinjam,
          type: 'DELETE',
          data: {
            "_token" : "{{ csrf_token() }}",
          },
          dataType: "html",
          error: function (xhr, ajaxOptions, thrownError) {
            swal("Gagal Merejected !", "Mohon Coba Lagi", "error");
          },
          success: function(data) {
            if (data == 'success') {
              swal("Berhasil !", "Pengajuan Pinjaman Telah Di Rejected !", "success");
              setTimeout(function(){
                window.location.reload();
              }, 1000);
            }else{
              swal("Gagal !", "Data Gagal Dihapus !", "danger");
            }
          }
        });
      } else {
      }
    });
  } 
</script>


<!-- Pinjam Buku -->
<script type="text/javascript">
  function detailPinjam(kd_user){
    $.ajax({
      url: '/detailPinjam/' + kd_user,
      type: 'GET',
      data: {
        "_token" : "{{ csrf_token() }}",
      },
      dataType: "JSON",
      error: function (xhr, ajaxOptions, thrownError) {
        swal("Gagal Menampilkan !", "Mohon Coba Lagi", "error");
      },
      success: function(data) {
        if (data != 'fail') {
          console.log(data);
          $("#ModalDetailPinjam").modal('show');
          $("#kd_buku").val(data.kd_buku);
          $("#judul").val(data.judul_buku);
          $("#pengarang").val(data.pengarang);
          $("#penerbit").val(data.penerbit);
          $("#tahun_terbit").val(data.tahun_terbit);
          $("#stok").val(data.stok_buku);
          $("#norak").val(data.no_rak);
          $("#kategori").val(data.kategori);
        }else{
          swal("Gagal Menampilkan !", "Mohon Coba Lagi", "error");
        }
      }
    });
  }
  
  function pinjam(){
    var kd_buku = $("#kd_buku").val();
    var tgl_pinjam = $("#tgl_pinjam").val();
    var tgl_kembali = $("#tgl_kembali").val();

    if (tgl_pinjam == "") {
      swal("Mohon Pilih Tanggal Pinjam !", "Mohon Coba Lagi", "error");
    }
    else if (tgl_kembali == "") {
      swal("Mohon Pilih Tanggal Kembali !", "Mohon Coba Lagi", "error");
    }
    else {
      $.ajax({
        url: '/pinjam',
        type: 'POST',
        data: {
          "kd_buku" : kd_buku,
          "tanggal_pinjam" : tgl_pinjam,
          "tanggal_kembali" : tgl_kembali,
          "_token" : "{{ csrf_token() }}",
        },
        dataType: "html",
        error: function (xhr, ajaxOptions, thrownError) {
          swal("Gagal Mengajukan Pinjaman !", "Mohon Coba Lagi", "error");
        },
        success: function(data) {
          if (data == 'exists') {
            swal("Gagal Mengajukan Pinjaman !", "Anda sudah mengajukan pinjaman buku ini, mohon konfirmasi ke petugas !", "error");
          }
          else if (data == 'meminjam') {
            swal("Gagal Mengajukan Pinjaman !", "Anda sedang meminjam buku ini !", "error");
          }
          else if (data != 'fail' && data != 'exists') {
            swal("Kode Pinjam : " + data, "Berhasil mengajukan pinjaman, segera beritahu kode ke petugas !", "success");
            setTimeout(function(){
              window.location.reload();
            }, 5000);
          }
          else {
            swal("Gagal !", "Data Gagal Ditambah !", "error");
          }
        }
      });
    }
  } 
</script>
