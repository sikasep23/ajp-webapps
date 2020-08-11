$(function(){
    const flashData = $('.flash-data').data('flashdata');
    if (flashData) {
        swal({
            title: 'Role',
            text: 'Successfully ' + flashData,
            type: 'success'
        });
    }

    $('.delete-button').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        swal({
            title: 'Are  you sure?',
            text: 'Menu data will be delete?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonClass: 'btn-secondary waves-effect',
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },function (isConfirm) {
            if (isConfirm) {
                document.location.href = href;
                //swal("Deleted!", "Your imaginary file has been deleted.", "success");
            } 
        });
    });

    $('.tambahData').on('click', function () {
        var url = $(this).data('url');
        $('.modal-body form').attr('action', '' + url + 'administrator/role');
        $('#newroleLabel').html('Add New Role');
        $('#role').val('');
        $('#deskripsi').val('');
        $('#is_active').val('1');
        $('.modal-footer button[type=submit]').html('Save');

    });

    $('.modalUpdate').on('click', function () {
        const id = $(this).data('id');
        var url = $(this).data('url');

        $('#newroleLabel').html('Update Role');
        $('.modal-footer button[type=submit]').html('Update data');
        $('.modal-body form').attr('action', '' + url + 'administrator/updaterole');

        $.ajax({
            url: ' ' + url + 'administrator/getrole',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#role').val(data.role),
                    $('#id').val(data.id),
                    $('#deskripsi').val(data.deskripsi)
                    if (data.is_active == 1) {
                        $('#is_active').attr('checked','checked')
                    } else {
                        $('#is_active').removeAttr('checked')
                    }
            }
        })

    });
});