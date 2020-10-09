$(function () {

    function get_code() {
        $.ajax({
            url: "uom_code",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#uom_code').val(data.code)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from database');
            }
        })
    }

    get_code();

    var table;
    table = $('#uom_table').DataTable({
        "processing": true,
        "serverSide": true,
        "bInfo": false,
        "order": [],
        "ajax": {
            "url": "uom_get",
            "type": "POST"
        },
        "columnDefs": [
            {
                "targets": [-1],
                "orderable": false,
            },
        ],
    });

    function reload_table() {
        table.ajax.reload(null, false);
    }

    $('#cancel').on('click', function () {
        $('#title-form').html('input data');
        $('action_stat').val('add');
        $('#form')[0].reset();
        get_code();
    });

    $(document).on('click', '#btnSave', function () {
        var uom_code = $('#uom_code').val();
        var uom = $('#uom').val();
        //console.log(code);

        if (uom == "" || uom == null) {
            return swal("Error", "Field must be filled!", "error");
        }

        var action = $('#action_stat').val();
        console.log(action);
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);
        var url;

        if (action != 'update') {
            url = "uom_add";
        } else {
            url = "uom_update";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {

                if (data.status) {
                    swal({
                        title: 'Master UoM',
                        text: 'Successfully ' + action + '!',
                        type: 'success'
                    });
                    reload_table();
                }

                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
                $('#action_stat').val('add');
                $('#form')[0].reset();
                get_code();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);

            }
        });

    });

    $(document).on('click', '#edit_pa', function () {
        var sid = $(this).data("sid");

        console.log(sid);
        $.ajax({
            url: "uom_edit/" + sid,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#title-form').html('Update Data');
                $('[name="id"]').val(data.id);
                $('#uom_code').val(data.uom_code);
                $('#uom').val(data.uom);
                $('#action_stat').val('update');
                //$('[name="code_pa"]').attr('readonly', 'readonly');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });

    $(document).on('click', '#delete_pa', function () {
        var did = $(this).data('did');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-secondary waves-effect',
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "uom_delete/" + did,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        swal({
                            title: 'Master UoM',
                            text: 'Successfully deleted!',
                            type: 'success'
                        });
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }

        });
    });


});