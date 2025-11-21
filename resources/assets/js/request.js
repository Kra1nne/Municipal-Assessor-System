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
  const data = window.request;
  let totalAssessment = 0;
  let assessmentComplete = 0;
  let assessmentUnderReview = 0;
  let declineRequest = 0;
  function dataHeader(request) {
    request.forEach(request => {
      totalAssessment++;
      request.status === 'Request' ? assessmentUnderReview++ : '';
      request.status === 'Success' ? assessmentComplete++ : '';
      request.status === 'Decline' ? declineRequest++ : '';

      $('#totalRequest').text(totalAssessment);
      $('#completeRequest').text(assessmentComplete);
      $('#reviewRequest').text(assessmentUnderReview);
      $('#declineRequest').text(declineRequest);
    });
  }
  dataHeader(data);
});

$(document).ready(function () {
  function displayRequest(request) {
    const $requestList = $('#requestlist');
    $requestList.empty();

    if (request.length === 0) {
      $requestList.html(`<tr><td colspan="5" class="text-center text-muted">No request found.</td></tr>`);
      return;
    }

    request.forEach(request => {
      const hideSendDecline =
        request.status === 'Decline' || request.status === 'Success' || request.status === 'Complete';

      const requestRow = `
        <tr>
          <td>
            <div>${request.firstname} ${request.middlename ?? ''} ${request.lastname}</div>
            <div>${request.email ?? ''}</div>
          </td>
          <td>
            <span class="badge rounded-pill ${
              request.status === 'Success'
                ? 'bg-label-success'
                : request.status === 'Request'
                  ? 'bg-label-warning'
                  : request.status === 'Complete'
                    ? 'bg-label-info'
                    : 'bg-label-danger'
            }">${request.status}</span>
          </td>
          <td>Requested of the Tax Declaration of the Property</td>
          <td>${new Date(request.created_at).toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric'
          })}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="ri-more-2-line"></i>
              </button>
              <div class="dropdown-menu">
                ${
                  !hideSendDecline
                    ? `
                      <a class="dropdown-item Accept" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#AddAccept"
                        data-id="${request.request_id}">
                        <i class="ri-checkbox-circle-line me-1 text-success"></i> Send
                      </a>
                      <a class="dropdown-item Decline" href="javascript:void(0);" data-id="${request.request_id}">
                        <i class="ri-close-circle-line me-1 text-danger"></i> Decline
                      </a>
                    `
                    : ''
                }
                <a class="dropdown-item View" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ViewModal"
                  data-request_form="${request.request_form}"
                  data-certificate="${request.certificate}"
                  data-proff_of_transfer="${request.proff_of_transfer}"
                  data-authorizing="${request.authorizing}"
                  data-updated_tax="${request.updated_tax}"
                  data-transfer_tax="${request.transfer_tax}"
                  data-tax_reciept="${request.tax_reciept}">
                  <i class="ri-eye-line me-1 text-primary"></i> View
                </a>
              </div>
            </div>
          </td>
        </tr>
      `;

      $requestList.append(requestRow);
    });
  }

  function filterProperties(query) {
    const filtered = window.request.filter(request => {
      const fullName = `${request.firstname} ${request.lastname}`.toLowerCase();
      return fullName.includes(query) || request.email.toLowerCase().includes(query);
    });
    displayRequest(filtered);
  }

  $('#search').on('input', function () {
    const query = $(this).val().toLowerCase();
    filterProperties(query);
  });

  // Render all requests on page load
  displayRequest(window.request);
});

$(document).ready(function () {
  $('body').on('click', '.Decline', function () {
    const id = $(this).data('id');
    console.log(id);
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Decline!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then(result => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'POST',
          url: '/request/decline',
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

$(document).ready(function () {
  $('body').on('click', '.View', function () {
    const downloadSection = $('#download-section');
    downloadSection.empty();

    // Define label ↔ attribute mapping here
    const files = [
      { label: 'Request Form for the insurance of Updated Tax Declaration', key: 'request_form' },
      { label: 'Transfer Certificate of Title or Original Certificate of Title', key: 'certificate' },
      { label: 'Deed of Sale or Proof of Property Transfer', key: 'proff_of_transfer' },
      { label: 'Certificate Authorizing Registration', key: 'authorizing' },
      { label: 'Updated Real Property Tax Payment', key: 'updated_tax' },
      { label: 'Transfer Tax Receipt', key: 'transfer_tax' },
      { label: 'Latest Tax Declaration', key: 'tax_reciept' }
    ];

    let hasFile = false;

    files.forEach(item => {
      const filePath = $(this).data(item.key);
      if (filePath) {
        hasFile = true;
        const fileUrl = `/storage/${filePath}`;
        const card = `
          <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
              <div class="card-body text-center">
                <h6 class="fw-bold mb-2">${item.label}</h6>
                <button class="btn btn-success btn-sm start-download" data-file="${fileUrl}">
                  <i class="bx bx-download"></i> Download
                </button>
              </div>
            </div>
          </div>
        `;
        downloadSection.append(card);
      }
    });

    if (!hasFile) {
      downloadSection.html('<p class="text-danger text-center mt-3">No files available for download.</p>');
    }
  });

  // Handle the actual download
  $(document).on('click', '.start-download', function () {
    const fileUrl = $(this).data('file');
    const link = document.createElement('a');
    link.href = fileUrl;
    link.setAttribute('download', '');
    document.body.appendChild(link);
    link.click();
    link.remove();
  });
});

$(document).ready(function () {
  $('body').on('click', '.Accept', function () {
    const id = $(this).data('id');

    $('#id').val(id);
  });
  $('body').on('click', '#AddLot', function () {
    const fields = [
      { id: 'lot', label: 'Lot Property' },
      { id: 'id', label: 'Request Id' }
    ];

    const isValid = validateForm(fields);

    if (!isValid) {
      event.preventDefault();
      return;
    }

    $.ajax({
      type: 'POST',
      url: '/request/accept',
      cache: false,
      data: $('#Data').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('#AddAccept').modal('hide');
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
