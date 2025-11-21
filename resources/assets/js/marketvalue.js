$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

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
  $('#AddMarketValueBtn').on('click', function (event) {
    const fields = [
      { id: 'type', label: 'Property Type' },
      { id: 'class', label: 'Class' },
      { id: 'value', label: 'Market Value' }
    ];
    const isValid = validateForm(fields);
    if (!isValid) {
      event.preventDefault();
      return;
    }

    // ajax
    $.ajax({
      type: 'POST',
      url: '/schedule-market-values/add',
      cache: false,
      data: $('#PropertyData').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('#AddMarketValue').modal('hide');
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
  function displayProperties(marketValues) {
    const $marketValuesList = $('#marketValueList');
    $marketValuesList.empty();

    if (marketValues.length === 0) {
      $marketValuesList.html(`<tr><td colspan="4" class="text-center text-muted">No market values found.</td></tr>`);
      return;
    }

    marketValues.forEach(marketValue => {
      const marketValueRow = `
        <tr>
          <td>${marketValue.property_type}</td>
          <td>${marketValue.class}</td>
          <td>${marketValue.value}</td>
          <td>${marketValue.created_at}</td>
          <td>
            <button class="btn btn-primary editMarketValue" data-bs-toggle="modal" data-bs-target="#editMarketValueModal"
            data-market-value-id="${marketValue.encrypted_id}"
            data-property-type-id="${marketValue.property_type_id}"
            data-class="${marketValue.class}"
            data-value="${marketValue.value}"
            >
            Edit
            </button>
          </td>
        </tr>
      `;
      $marketValuesList.append(marketValueRow);
    });
  }

  function filterProperties(query) {
    const filtered = window.marketValues.filter(marketValue => {
      return marketValue.property_type.toLowerCase().includes(query);
    });
    displayProperties(filtered);
  }

  $('#search').on('input', function () {
    const query = $(this).val().toLowerCase();
    filterProperties(query);
  });

  // Render all properties on page load
  displayProperties(window.marketValues);
});

$(document).ready(function () {
  $('body').on('click', '.editMarketValue', function () {
    const id = $(this).data('market-value-id');
    const typeId = $(this).data('property-type-id');
    const classValue = $(this).data('class');
    const value = $(this).data('value');

    $('#Edit_type').val(typeId); // Use the ID instead of the name
    $('#Edit_class').val(classValue);
    $('#Edit_value').val(value);
    $('#Edit_id').val(id);
  });

  $('#EditMarketValueBtn').on('click', function (event) {
    const fields = [
      { id: 'Edit_type', label: 'Property Type' },
      { id: 'Edit_class', label: 'Class' },
      { id: 'Edit_value', label: 'Market Value' }
    ];
    const isValid = validateForm(fields);
    if (!isValid) {
      event.preventDefault();
      return;
    }

    $.ajax({
      type: 'POST',
      url: '/schedule-market-values/update',
      cache: false,
      data: $('#PropertyDataEdit').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('#editMarketValueModal').modal('hide');
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
