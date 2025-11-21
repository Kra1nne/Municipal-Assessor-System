// error trapping
function validateForm(fields) {
  let valid = true;

  // Loop through all fields to check if any are empty
  fields.forEach(field => {
    const input = document.getElementById(field.id);
    const value = input.value.trim();
    const errorMessages = [];

    // Check for empty fields
    if (!value) {
      valid = false;
      errorMessages.push(`${field.label} is required.`);
    }

    if (field.id === 'password-confirmation' && value) {
      const password = document.getElementById('password').value.trim();
      if (value !== password) {
        valid = false;
        errorMessages.push('Passwords do not match.');
      }
    }

    if (errorMessages.length > 0) {
      input.classList.add('is-invalid'); // Add Bootstrap 'is-invalid' class
      let errorMessageContainer = input.parentNode.querySelector('.invalid-feedback');
      if (!errorMessageContainer) {
        errorMessageContainer = document.createElement('div');
        errorMessageContainer.classList.add('invalid-feedback');
        input.parentNode.appendChild(errorMessageContainer);
      }
      errorMessageContainer.innerHTML = errorMessages.join('<br>'); // Display all errors for this field
    } else {
      input.classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
      let errorMessageContainer = input.parentNode.querySelector('.invalid-feedback');
      if (errorMessageContainer) {
        errorMessageContainer.remove(); // Remove error messages
      }
    }
  });

  return valid;
}

$(document).ready(function () {
  $('#Add').on('click', function (event) {
    const fields = [
      { id: 'class', label: 'Classification' },
      { id: 'min', label: 'Minimum' },
      { id: 'max', label: 'Maximum' },
      { id: 'percentage', label: 'Percentage' }
    ];

    const isValid = validateForm(fields);

    if (!isValid) {
      event.preventDefault();
      return;
    }

    $.ajax({
      type: 'POST',
      url: '/building-rate/add',
      cache: false,
      data: $('#BuldingClassificationData').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('#AddClassfication').modal('hide');
        $('.preloader').show();
      },
      success: function (data) {
        $('.preloader').hide();
        if (data.Error == 1) {
          Swal.fire('Error!', data.Message, 'error');
        } else if (data.Error == 0) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Saved!',
            text: data.Message,
            showConfirmButton: true,
            confirmButtonText: 'OK'
          }).then(result => {
            location.reload();
          });
        }
      },
      error: function () {
        $('.preloader').hide();
        Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
      }
    });
  });
});

// display and search data
$(document).ready(function () {
  function displayclassification(classification) {
    const $classificationList = $('#buildingclass');
    $classificationList.empty();

    if (classification.length === 0) {
      $classificationList.html(`<tr><td colspan="5" class="text-center text-muted">No classification found.</td></tr>`);
      return;
    }

    classification.forEach(classification => {
      const classificationRow = `
        <tr>
          <td>${classification.classification}</td>
          <td>₱ ${classification.minimum_rate.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
          <td>₱ ${classification.maximum_rate.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
          <td>${classification.percentage}%</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item Edit" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#EditClassfication"
                  data-id="${classification.id}"
                  data-classification="${classification.classification}"
                  data-min="${classification.minimum_rate}"
                  data-max="${classification.maximum_rate}"
                  data-percentage="${classification.percentage}"
                  >
                  <i class="ri-pencil-line me-1"></i> Edit
                </a>
                <a class="dropdown-item DeleteBtn" href="javascript:void(0);" data-id="${classification.id}">
                  <i class="ri-delete-bin-6-line me-1"></i> Delete
                </a>
              </div>
            </div>
          </td>
        </tr>
      `;
      $classificationList.append(classificationRow);
    });
  }

  function filterclassification(query) {
    const filtered = window.classification.filter(classification => {
      return classification.classification.toLowerCase().includes(query);
    });
    displayclassification(filtered);
  }

  $('#search').on('input', function () {
    const query = $(this).val().toLowerCase();
    filterclassification(query);
  });

  // Render all classification on page load
  displayclassification(window.classification);
});

// for editing
$(document).ready(function () {
  $('body').on('click', '.Edit', function () {
    const id = $(this).data('id');
    const classification = $(this).data('classification');
    const min = $(this).data('min');
    const max = $(this).data('max');
    const percentage = $(this).data('percentage');

    $('#Edit_id').val(id);
    $('#Edit_class').val(classification);
    $('#Edit_min').val(min);
    $('#Edit_max').val(max);
    $('#Edit_percentage').val(percentage);
  });

  $('body').on('click', '#EditBtn', function (event) {
    const fields = [
      { id: 'Edit_class', label: 'Classification' },
      { id: 'Edit_min', label: 'Minimum' },
      { id: 'Edit_max', label: 'Maximum' },
      { id: 'Edit_percentage', label: 'Percentage' }
    ];

    const isValid = validateForm(fields);

    if (!isValid) {
      event.preventDefault();
      return;
    }

    $.ajax({
      type: 'POST',
      url: '/building-rate/update',
      cache: false,
      data: $('#EditClassificationData').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('#EditClassfication').modal('hide');
        $('.preloader').show();
      },
      success: function (data) {
        $('.preloader').hide();
        if (data.Error == 1) {
          Swal.fire('Error!', data.Message, 'error');
        } else if (data.Error == 0) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Saved!',
            text: data.Message,
            showConfirmButton: true,
            confirmButtonText: 'OK'
          }).then(result => {
            location.reload();
          });
        }
      },
      error: function () {
        $('.preloader').hide();
        Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
      }
    });
  });
});

//for deleting
$(document).ready(function () {
  $('body').on('click', '.DeleteBtn', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then(result => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'POST',
          url: '/building-rate/delete',
          cache: false,
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
          },
          dataType: 'json',
          beforeSend: function () {
            $('.preloader').show();
          },
          success: function (data) {
            $('.preloader').hide();
            if (data.Error == 1) {
              Swal.fire('Error!', data.Message, 'error');
            } else if (data.Error == 0) {
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Saved!',
                text: data.Message,
                showConfirmButton: true,
                confirmButtonText: 'OK'
              }).then(result => {
                location.reload();
              });
            }
          },
          error: function () {
            $('.preloader').hide();
            Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
          }
        });
      }
    });
  });
});
