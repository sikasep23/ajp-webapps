$(function () {

    function get_code() {
        $.ajax({
            url: "supplier_group_code",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#sg_code').val(data.code)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from database');
            }
        })
    }

    get_code();

    var table;
    table = $('#sg_table').DataTable({
        "processing": true,
        "serverSide": true,
        "bInfo": false,
        "order": [],
        "ajax": {
            "url": "supplier_group_get",
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
        
        var sg_code = $('#sg_code').val();
        //console.log(code);

        if (sg_code == "" || sg_code == null) {
            return swal("Error", "Field must be filled!", "error");
        }

        var action = $('#action_stat').val();
        console.log(action);
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);
        var url;

        if (action != 'update') {
            url = "supplier_group_add";
        } else {
            url = "supplier_group_update";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {

                if (data.status) {
                    swal({
                        title: 'Supplier Group',
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
            url: "supplier_group_edit/" + sid,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#title-form').html('Update Data');
                $('[name="id"]').val(data.id);
                $('#sg_code').val(data.sg_code);
                $('#sg').val(data.sg);
                $('#sg_currency').val(data.sg_currency);
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
                    url: "supplier_group_delete/" + did,
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