$(function () {
  //notification block
  const flashData = $('.flash-data').data('flashdata');
  if (flashData) {
    swal({
      title: 'Menu Data',
      text: 'Successfully ' + flashData,
      type: 'success'
    });
  }

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