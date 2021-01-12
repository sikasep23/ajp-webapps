$(function () {

    const flashData = $('.flash-data').data('flashdata');
    //console.log(flashData);
    if (flashData) {
        swal({
            title: 'Supplier data',
            text: 'Successfully ' + flashData,
            type: 'success'
        });
    }


    $('#m_supplier').DataTable({

    });

    var table;
    table = $('#mp_table').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "bInfo": false,
        "order": [],
        "ajax": {
            "url": "manpower_get",
            "type": "POST"
        },
        "columnDefs": [
            {
                "targets": [-1],
                "orderable": false,
            },
        ],
    });

    table.columns.adjust().draw();

    function reload_table() {
        table.ajax.reload(null, false);
    }

    //modal init
    //modal add
    $('#test').on('click', function () {
        get_code();
        $('.custom-modal-title').text('Create New Manpower');
        $('form')[0].reset();
        $('#mp_gender').select2("destroy");
        $('#mp_department').select2("destroy");
        $('#mp_pa').select2("destroy");
        $('#mp_poh').select2("destroy");
        $('#mp_mpstatus').select2("destroy");
        $('#mp_status').select2("destroy");
        $('.select2').select2({
            dropdownParent: $('#custom-modal'),
            theme: 'bootstrap4',
            width: "resolve"
        });
        $('.help-block').empty();
        $('.form-control').removeClass('parsley-error');
        $('#method').val('add');
        var modal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#custom-modal',
                width: '90%'
            }
        });
        modal.open();
    });
    //modal edit
    $(document).on('click', '#edit_mp', function () {
        var id = $(this).data('sid');
        $('.custom-modal-title').text('Update Manpower');
        $('form')[0].reset();
        $('#method').val('edit');
        $('.help-block').empty();
        $('.form-control').removeClass('parsley-error');

        $.ajax({
            url: "manpower_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#id').val(data.id);
                $('#mp_id').val(data.mp_id);
                $('#mp_nik').val(data.mp_nik);
                $('#mp_name').val(data.mp_name);
                $('#mp_position').val(data.mp_position);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#email').val(data.email);
                $('#mp_doh').val(data.mp_doh);
                $('#ls').val(getAge(data.mp_doh));
                $('#mp_gender').select2("destroy");
                $('#mp_gender').val(data.mp_gender);
                $('#mp_department').select2("destroy");
                $('#mp_department').val(data.mp_department);
                $('#mp_pa').select2("destroy");
                $('#mp_pa').val(data.mp_pa);
                $('#mp_poh').select2("destroy");
                $('#mp_poh').val(data.mp_poh);
                $('#mp_status').select2("destroy");
                $('#mp_status').val(data.mp_status);
                $('#role').select2("destroy");
                $('#role').val(data.role_id);
                $('.select2').select2({
                    dropdownParent: $('#custom-modal'),
                    theme: 'bootstrap4',
                    width: "resolve"
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
        var modal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#custom-modal',
                width: '90%',
            }
        });
        modal.open();
    });

    $(document).on('click', '#delete_supp', function () {
        var id = $(this).data('id');
        swal({
            title: "Are you sure to delete?",
            text: "You will not be able to recover !",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-secondary waves-effect',
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {
                console.log(id);
                $.ajax({
                    url: "m_supplier_delete/" + id,
                    type: "POST",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function (data) {
                        setTimeout(function () {
                            swal({
                                title: 'Supplier data',
                                text: 'Successfully deleted!',
                                type: 'success'
                            }, function () {
                                window.location = "m_supplier";
                            });
                        }, 100);

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }

        });
    })

    $('#btnSave').on('click', function () {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var save_method = $('#method').val();


        if (save_method == 'add') {
            url = "manpower_add";
        } else {
            url = "manpower_update";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('form').serialize(),
            dataType: "JSON",
            success: function (data) {

                if (data.status) {
                    Custombox.modal.close();
                    reload_table();
                    swal({
                        title: 'Manpower Data',
                        text: 'Successfully ' + save_method,
                        type: 'success'
                    });
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        //$('[name="' + data.inputerror[i] + '"]').addClass('parsley-error'); //select parent twice to select div form-group class and add has-error class

                        toastr["error"](data.inputerror[i])
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "1000",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }


                    }
                }

                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    });

    $(document).on('click', '#Enable', function () {
        var id = $(this).data('std');
        console.log(id);
        $.ajax({
            url: 'manpower_enable',
            method: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                reload_table();
                swal({
                    title: 'Manpower Data',
                    text: 'Successfully enable loggin user',
                    type: 'success'
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error enable loggin user');

            }
        })
    });

    $(document).on('click', '#Disable', function () {
        var id = $(this).data('std');
        console.log(id);
        $.ajax({
            url: 'manpower_disable',
            method: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                reload_table();
                swal({
                    title: 'Manpower Data',
                    text: 'Successfully Disable loggin user',
                    type: 'success'
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error disable loggin user');

            }
        })
    });

    //input modifier block
    $('.select2').select2({
        dropdownParent: $('#custom-modal'),
        theme: 'bootstrap4',
        placeholder: "Select an option",
        width: "resolve"
    });
    $("input").keyup(function () {
        var ucase = $(this).val().toUpperCase()
        $(this).val(ucase);
    });
    $('#mp_doh').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'mm/dd/yyyy'
    });

    //calculate block
    $(document).on('change', '#mp_doh', function () {
        var today = $('#today').val();
        var doh = $(this).val();
        $('#ls').val(getAge(doh));
    });

    function getAge(dateString) {
        var now = new Date();
        var today = new Date(now.getYear(), now.getMonth(), now.getDate());
        var yearNow = now.getYear();
        var monthNow = now.getMonth();
        var dateNow = now.getDate();
        var dob = new Date(dateString.substring(6, 10),
            dateString.substring(0, 2) - 1,
            dateString.substring(3, 5)
        );
        var yearDob = dob.getYear();
        var monthDob = dob.getMonth();
        var dateDob = dob.getDate();
        var age = {};
        var ageString = "";
        var yearString = "";
        var monthString = "";
        var dayString = "";
        yearAge = yearNow - yearDob;
        if (monthNow >= monthDob)
            var monthAge = monthNow - monthDob;
        else {
            yearAge--;
            var monthAge = 12 + monthNow - monthDob;
        }
        if (dateNow >= dateDob)
            var dateAge = dateNow - dateDob;
        else {
            monthAge--;
            var dateAge = 31 + dateNow - dateDob;
            if (monthAge < 0) {
                monthAge = 11;
                yearAge--;
            }
        }
        age = {
            years: yearAge,
            months: monthAge,
            days: dateAge
        };
        if (age.years > 1) yearString = " years";
        else yearString = " year";
        if (age.months > 1) monthString = " months";
        else monthString = " month";
        if (age.days > 1) dayString = " days";
        else dayString = " day";
        if ((age.years > 0) && (age.months > 0) && (age.days > 0))
            ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString;
        else if ((age.years == 0) && (age.months == 0) && (age.days > 0))
            ageString = age.days + dayString;
        else if ((age.years > 0) && (age.months == 0) && (age.days == 0))
            ageString = age.years + yearString;
        else if ((age.years > 0) && (age.months > 0) && (age.days == 0))
            ageString = age.years + yearString + " and " + age.months + monthString;
        else if ((age.years == 0) && (age.months > 0) && (age.days > 0))
            ageString = age.months + monthString + " and " + age.days + dayString;
        else if ((age.years > 0) && (age.months == 0) && (age.days > 0))
            ageString = age.years + yearString + " and " + age.days + dayString;
        else if ((age.years == 0) && (age.months > 0) && (age.days == 0))
            ageString = age.months + monthString;
        else ageString = "Could not calculate days!";
        return ageString;
    }


});