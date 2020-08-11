$(function () {

    const flashData = $('.flash-data').data('flashdata');
    if (flashData) {
        swal({
            title: 'Model unit',
            text: 'Successfully ' + flashData,
            type: 'success'
        });
    }

    function get_code() {
        $.ajax({
            url: "modelunit_code",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#mu_code').val(data.code)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from database');
            }
        })
    }

    get_code();

    $('#cancel').on('click', function () {
        $('#title-form').html('input data');
        $('action_stat').val('add');
        $('#form')[0].reset();
        $('[name="mu_manufacture"]').select2('destroy');
        $('[name="mu_manufacture"]').val('');
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: "Select an option",
            width: "resolve"
        });
        get_code();
    });

    var table;
    table = $('#mu_table').DataTable({
        "processing": true,
        "serverSide": true,
        "bInfo": false,
        "order": [],
        "ajax": {
            "url": "modelunit_get",
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

    $(document).on('click', '#edit', function () {
        var sid = $(this).data("sid");

        //console.log(sid);
        $.ajax({
            url: "modelunit_edit/" + sid,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#title-form').html('Update Data');
                $('[name="id"]').val(data.id);
                $('[name="mu_code"]').val(data.mu_code);
                $('[name="mu"]').val(data.mu_name);
                $('[name="mu_manufacture"]').select2('destroy');
                $('[name="mu_manufacture"]').val(data.mu_manufacture);
                $('.select2').select2({
                    theme: 'bootstrap4',
                    placeholder: "Select an option",
                    width: "resolve"
                });
                $('#action_stat').val('update');

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });


    $('#btnSave').on('click', function () {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var save_method = $('#action_stat').val();


        if (save_method == 'add' || save_method == 'added') {
            url = "modelunit_add";
        } else {
            url = "modelunit_update";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('form').serialize(),
            dataType: "JSON",
            success: function (data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    swal({
                        title: 'Model unit Data',
                        text: 'Successfully ' + save_method,
                        type: 'success'
                    });
                }
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
                $('action_stat').val('add');
                $('#form')[0].reset();
                $('[name="mu_manufacture"]').select2('destroy');
                $('[name="mu_manufacture"]').val('');
                $('.select2').select2({
                    theme: 'bootstrap4',
                    placeholder: "Select an option",
                    width: "resolve"
                });
                reload_table();
                get_code();

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

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
                    url: "modelunit_delete/" + did,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        swal({
                            title: 'Project Area',
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

    //input modifier block
    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: "Select an option",
        width: "resolve"
    });
    $("input").keyup(function () {
        var ucase = $(this).val().toUpperCase()
        $(this).val(ucase);
    });

});