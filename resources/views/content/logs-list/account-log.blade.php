@extends('layouts/contentNavbarLayout')

@section('title', 'Logs List')


@section('content')
<div class="row gy-6">
  <div class="col-12">
    <div class="card overflow-hidden">
       <div class="table-responsive text-nowrap overflow-auto" style="max-height: 700px;">
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
            @foreach ($log as $item)
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-4">
                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">{{ $item->firstname }}</h6>
                    <small class="text-truncate">{{ $item->email}}</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">{{ $item->action }}</td>
              <td class="text-truncate">{{ $item->table_name }}</td>
              <td class="text-truncate">{{ date('M. d, Y - h:m A', strtotime($item->created_at)) }}</td>
              <td class="text-truncate">
                <div class="d-flex align-items-center">
                  @if ($item->role == "Admin")
                      <i class="ri-vip-crown-line ri-22px text-primary me-2"></i>
                      <span>Admin</span>
                  @endif
                  @if ($item->role == "Employee")
                      <i class="ri-briefcase-line ri-22px text-info me-2"></i>
                      <span>Employee</span>
                  @endif
                  @if ($item->role == "User")
                      <i class="ri-user-3-line ri-22px text-success me-2"></i>
                      <span>User</span>
                  @endif
                </div>
              </td>
              <td><span class="badge bg-label-success rounded-pill">Success</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
