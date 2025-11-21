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
  $('#AddTypeBtn').on('click', function (event) {
    const fields = [
      { id: 'type', label: 'Property Type' },
      { id: 'rate', label: 'Assessment Rate' }
    ];
    const isValid = validateForm(fields);
    if (!isValid) {
      event.preventDefault();
      return;
    }

    $.ajax({
      type: 'POST',
      url: '/property-type/add',
      cache: false,
      data: $('#PropertyData').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('#AddPropertyType').modal('hide');
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

// search
$(document).ready(function () {
  function displayProperties(propertyTypes) {
    const $propertyTypeList = $('#propertyTypeList');
    $propertyTypeList.empty();

    if (propertyTypes.length === 0) {
      $propertyTypeList.html(`<tr><td colspan="3" class="text-center text-muted">No property types found.</td></tr>`);
      return;
    }

    propertyTypes.forEach(propertyType => {
      const propertyTypeRow = `
        <tr>
          <td>${propertyType.type_name}</td>
          <td>${propertyType.assessment_rate}%</td>
          <td>
            <button type="button" class="btn btn-sm btn-primary Edit"
              data-id="${propertyType.encrypted_id}"
              data-list-id="${propertyType.list_id}"
              data-type-name="${propertyType.type_name}"
              data-assessment-rate="${propertyType.assessment_rate}"
              data-bs-toggle="modal" data-bs-target="#EditPropertyType">
              Edit
            </button>
          </td>
        </tr>
      `;
      $propertyTypeList.append(propertyTypeRow);
    });
  }

  function filterProperties(query) {
    const filtered = window.propertyTypes.filter(propertyType => {
      return propertyType.type_name.toLowerCase().includes(query);
    });
    displayProperties(filtered);
  }

  $('#search').on('input', function () {
    const query = $(this).val().toLowerCase();
    filterProperties(query);
  });

  // Render all properties on page load
  displayProperties(window.propertyTypes);
});

$(document).ready(function () {
  $('body').on('click', '.Edit', function () {
    const id = $(this).data('id');
    const listId = $(this).data('list-id');
    const typeName = $(this).data('type-name');
    const assessmentRate = $(this).data('assessment-rate');

    $('#Edit_type').val(typeName);
    $('#Edit_rate').val(assessmentRate);
    $('#Edit_id').val(id);
    $('#Edit_list_id').val(listId);
  });
  $('#EditTypeBtn').on('click', function (event) {
    const fields = [
      { id: 'Edit_type', label: 'Property Type' },
      { id: 'Edit_rate', label: 'Assessment Rate' }
    ];
    const isValid = validateForm(fields);
    if (!isValid) {
      event.preventDefault();
      return;
    }

    // AJAX request to update property type
    $.ajax({
      type: 'POST',
      url: '/property-type/update',
      cache: false,
      data: $('#PropertyDataEdit').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('#EditPropertyType').modal('hide');
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
