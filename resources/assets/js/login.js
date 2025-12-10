$(document).ready(function () {
  // Trigger login on Enter key
  $(document).on('keypress', function (e) {
    if (e.which === 13) {
      $('#loginBtn').click();
    }
  });

  $('body').on('click', '#loginBtn', function (event) {
    const data = [
      { id: 'email', label: 'Email and Username' },
      { id: 'password', label: 'Password' }
    ];

    let isValid = data.every(
      input =>
        $('#' + input.id)
          .val()
          .trim() !== ''
    );

    if (!isValid) {
      Toastify({
        text: 'Please fill in all required fields.',
        duration: 3000,
        close: true,
        gravity: 'top',
        position: 'right',
        backgroundColor: '#cc3300',
        stopOnFocus: true
      }).showToast();
      event.preventDefault();
      return;
    }

    $.ajax({
      type: 'POST',
      url: '/login/process',
      cache: false,
      data: $('#formAuthentication').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('.preloader').show();
      },
      success: function (data) {
        $('.preloader').hide();
        if (data.Error == 1) {
          Toastify({
            text: data.Message,
            duration: 3000,
            close: true,
            gravity: 'top',
            position: 'right',
            backgroundColor: '#dc3545',
            stopOnFocus: true
          }).showToast();
        } else if (data.Error == 0) {
          window.location.href = data.Redirect;
        }
      },
      error: function (xhr) {
        $('.preloader').hide();
        let errorMessage =
          xhr.responseJSON?.Message ||
          (xhr.status === 429 ? 'Too many login attempts. Please try again later.' : 'An unexpected error occurred.');

        Toastify({
          text: errorMessage,
          duration: 3000,
          close: true,
          gravity: 'top',
          position: 'right',
          backgroundColor: '#cc3300',
          stopOnFocus: true
        }).showToast();
      }
    });
  });
});
