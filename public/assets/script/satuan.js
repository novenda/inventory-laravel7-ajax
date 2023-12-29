$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

    load_datatable_satuan();
});

// Fungsi Load Data Tabel
function load_datatable_satuan(){
    $('#satuan-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "satuan/datatable",
                "type": "GET",
            },
    "columns": [
        {data: 'id_master_satuan', 
        render : function(data, type, row, meta)
        {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { data: 'kode_satuan', name: 'kode_satuan' },
    { data: 'nama_satuan', name: 'nama_satuan' },
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
         });
}

function save() {
    var id = $("#id").val();
    var kode_satuan = $("#kode_satuan").val();
    var nama_satuan = $("#nama_satuan").val();
    
    if (kode_satuan !== "" || nama_satuan !== "") {
        $.ajax({
            url: "satuan/save",
            type: "POST",
            data: {
                id: id,
                kode_satuan: kode_satuan,
                nama_satuan: nama_satuan,
            },
            success: function (data) {
                if(data.code == 0){
                    swal("Gagal!", "Silakan Coba Lagi.", "error");
                } else {
                    swal("Tersimpan!", "Data Anda Sudah Tersimpan.", "success");
                    $("#Modal").modal("hide");
                    var oTable = $('#satuan-table').dataTable();
                    oTable.fnDraw(false);
                }
            },
        });
    } else {
        swal("Perhatian!", "Silakan Isikan Data Terlebih Dahulu.", "warning");
    }
}

function edit(p_id, p_kode, p_nama) {
    $("#id").val(p_id);
    $("#kode_satuan").val(p_kode);
    $("#nama_satuan").val(p_nama);
    $("#Modal").modal("show");
    $("#ModalLabel").html("Edit Master Satuan");
}

function hapus(id_master_satuan, kode_satuan, nama_satuan) {
    swal (
        {
          title: 'Yakin Hapus Data?',
          text : 'Kode Status : '+ kode_satuan +'\n Nama Satuan : '+ nama_satuan,
          type: 'warning',
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, Hapus Sekarang!',
          closeOnConfirm: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            $.ajax ({
                url: "satuan/hapus",
                type: "POST",
                data: {
                    id_master_satuan: id_master_satuan,
                },
                success: function (data) {
                    if(data.code == 0){
                        swal("Gagal!", "Silakan Coba Lagi.", "error");
                    } else {
                        swal("Terhapus!", "Data Anda Sudah Terhapus.", "success");
                        var oTable = $('#satuan-table').dataTable();
                        oTable.fnDraw(false);
                    }
                },
            });
          }
        }
      );
}

$("#Modal").on("hide.bs.modal", function () {
    $("#ModalLabel").html("Input Master Satuan");
    $("#id").val("");
    $("#kode_satuan").val("");
    $("#nama_satuan").val("");
});