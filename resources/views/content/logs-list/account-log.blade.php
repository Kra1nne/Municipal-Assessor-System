@extends('layouts/contentNavbarLayout')

@section('title', 'Logs List')

@section('content')
<div class="row gy-6">
  <div class="col-12">
    <div class="card overflow-hidden">

      {{-- Search & Filter Bar --}}
      <div class="card-header border-bottom py-4">
        <form method="GET" action="{{ url()->current() }}" id="filterForm">
          <div class="row g-3 align-items-end">

            {{-- Search --}}
            <div class="col-12 col-md-4">
              <label class="form-label small fw-semibold mb-1">Search</label>
              <div class="input-group input-group-sm">
                <span class="input-group-text"><i class="ri-search-line"></i></span>
                <input
                  type="text"
                  name="search"
                  class="form-control"
                  placeholder="Name, email, action, table…"
                  value="{{ request('search') }}"
                >
              </div>
            </div>

            {{-- Role Filter --}}
            <div class="col-6 col-md-2">
              <label class="form-label small fw-semibold mb-1">Role</label>
              <select name="role" class="form-select form-select-sm">
                <option value="">All Roles</option>
                <option value="Admin"    {{ request('role') == 'Admin'    ? 'selected' : '' }}>Admin</option>
                <option value="Employee" {{ request('role') == 'Employee' ? 'selected' : '' }}>Employee</option>
                <option value="User"     {{ request('role') == 'User'     ? 'selected' : '' }}>User</option>
              </select>
            </div>

            {{-- Date From --}}
            <div class="col-6 col-md-2">
              <label class="form-label small fw-semibold mb-1">From</label>
              <input
                type="date"
                name="date_from"
                class="form-control form-control-sm"
                value="{{ request('date_from') }}"
              >
            </div>

            {{-- Date To --}}
            <div class="col-6 col-md-2">
              <label class="form-label small fw-semibold mb-1">To</label>
              <input
                type="date"
                name="date_to"
                class="form-control form-control-sm"
                value="{{ request('date_to') }}"
              >
            </div>

            {{-- Actions --}}
            <div class="col-6 col-md-2 d-flex gap-2">
              <button type="submit" class="btn btn-primary btn-sm w-100">
                <i class="ri-filter-line me-1"></i>Filter
              </button>
              <a href="{{ url()->current() }}" class="btn btn-outline-secondary btn-sm w-100">
                <i class="ri-refresh-line"></i>
              </a>
            </div>

          </div>
        </form>
      </div>

      {{-- Table --}}
      <div class="table-responsive text-nowrap overflow-auto" style="max-height: 620px;">
        <table class="table table-sm">
          <thead>
            <tr>
              <th class="text-truncate">User</th>
              <th class="text-truncate">Action</th>
              <th class="text-truncate">Table</th>
              <th class="text-truncate">Timestamp</th>
              <th class="text-truncate">Role</th>
              <th class="text-truncate">Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($log as $item)
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-4">
                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">{{ $item->firstname }}</h6>
                    <small class="text-truncate">{{ $item->email }}</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">{{ $item->action }}</td>
              <td class="text-truncate">{{ $item->table_name }}</td>
              <td class="text-truncate">{{ date('M. d, Y - h:i A', strtotime($item->created_at)) }}</td>
              <td class="text-truncate">
                <div class="d-flex align-items-center">
                  @if ($item->role == "Admin")
                    <i class="ri-vip-crown-line ri-22px text-primary me-2"></i><span>Admin</span>
                  @elseif ($item->role == "Employee")
                    <i class="ri-briefcase-line ri-22px text-info me-2"></i><span>Employee</span>
                  @elseif ($item->role == "User")
                    <i class="ri-user-3-line ri-22px text-success me-2"></i><span>User</span>
                  @endif
                </div>
              </td>
              <td><span class="badge bg-label-success rounded-pill">Success</span></td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center text-muted py-4">
                <i class="ri-inbox-line ri-24px d-block mb-2"></i>
                No logs found matching your criteria.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection