$(function () {

    function get_code() {        
        $.ajax({
            url: "pic_code",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $("#ph_code").val('PHC'+data.code)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get code data from ajax');
            }
        });
    }
   
    get_code();

    $("#ph_handler").keyup(function () {
        var ucase = $(this).val().toUpperCase()
        $(this).val(ucase);
    });

    var table;
    table = $('#table_eq').DataTable({
        "processing": true,
        "serverSide": true,
        "bInfo": false,
        "order": [],
        "ajax": {
            "url": "pic_get",
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
        $('#ph_handler').val('');
        $('#action_stat').val('added');
        get_code();
    });

    $(document).on('click', '#btnSave', function () {
        
        var pa = $('#ph_handler').val();
        
        if (pa == "" || pa == null) {
            swal("Error", "Field Purchase Handler Type must be filled!", "error").die();
        }

        var action = $('#action_stat').val();
        console.log(action);
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);
        var url;

        if (action != 'update') {
            url = "pic_add";
        } else {
            url = "pic_update";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    swal({
                        title: 'Purchase Handler',
                        text: 'Successfully ' + action + '!',
                        type: 'success'
                    });
                    reload_table();
                    get_code();
                }
                $('#title-form').html('Input Data');
                //$('#action_stat').val('update');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
                $('#form')[0].reset();
                $('#action_stat').val('add');
                get_code();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);

            }
        });

    });

    $(document).on('click', '#edit', function () {
        var sid = $(this).data("sid");

        console.log(sid);
        $.ajax({
            url: "pic_edit/" + sid,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#title-form').html('Update Data');
                $('#action_stat').val('update');
                $('[name="id"]').val(data.id);
                $('[name="ph_code"]').val(data.pic_code);
                $('[name="ph_handler"]').val(data.pic_handler);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });

    $(document).on('click', '#delete', function () {
        var did = $(this).data('did');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this !",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-secondary waves-effect',
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "pic_delete/" + did,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        swal({
                            title: 'Purchase Handler',
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