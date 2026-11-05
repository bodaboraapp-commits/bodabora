
"use strict";

function lockFormSubmit($form) {
    if ($form.data('submitting')) {
        return false;
    }

    $form.data('submitting', true);

    var loadingText = typeof formProcessingText !== 'undefined' ? formProcessingText : 'Processing...';

    $form.find('button[type="submit"], input[type="submit"]').each(function () {
        var $btn = $(this);

        if ($btn.prop('disabled')) {
            return;
        }

        if ($btn.is('input')) {
            if (!$btn.data('original-val')) {
                $btn.data('original-val', $btn.val());
            }
            $btn.prop('disabled', true).val($btn.data('loading-text') || loadingText);
        } else {
            if (!$btn.data('original-html')) {
                $btn.data('original-html', $btn.html());
            }
            $btn.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> ' +
                ($btn.data('loading-text') || loadingText)
            );
        }
    });

    return true;
}

$(document).ready(function(){
    // Parcel status update confarmation
    $(".parcel_status_update_button").on('click',function(e){
        e.preventDefault();
        var self = $(this);
        Swal.fire({
        text: 'Do you want to update this?',
        position: 'top',
        showOkButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: `Cancel`,
        }).then((result) => {
        if (result.isConfirmed) {
            location.href = self.attr('href');
        }
        })
    });

    $(".default_shop_button").on('click',function(e){
        e.preventDefault();
        var self = $(this);
        Swal.fire({
            text: 'Do you want to update this?',
            position: 'top',
            showOkButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = self.attr('href');
            }
        })
    });

  // start
  $('form#delete').on('submit', function (e) {
    var title = $(this).data('title');
    e.preventDefault();
    var form = this;

    Swal.fire({
      text: title,
      position: 'top',
      showOkButton: true,
      showCancelButton: true,
      confirmButtonText: yes,
      cancelButtonText: cancel,
    }).then((result) => {
      if (result.isConfirmed){
        lockFormSubmit($(form));
        form.submit();
      }
    })
  });
  // end

  $(document).on('submit', 'form', function (e) {
    var $form = $(this);

    if ($form.attr('id') === 'delete' || $form.data('no-submit-lock')) {
      return;
    }

    if ($form.data('submitting')) {
      e.preventDefault();
      return false;
    }

    lockFormSubmit($form);
  });

  $('[data-toggle="datepicker"]').datepicker({
    format: 'yyyy-mm-dd'
  });
  $("#merchant_registration_submit").prop('disabled', true);

  $('#merchant_registration_checkbox').on('change', function() {
    if($(this).is(":checked"))
      $("#merchant_registration_submit").prop('disabled', false);
    else
      $("#merchant_registration_submit").prop('disabled', true);
  });
  $(".select2").select2();
});

