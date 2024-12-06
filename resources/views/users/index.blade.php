@extends('layouts.app')

@section('title', __('Users'))

@section('content')
<div class="container">
  <div class="col-md-12">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <div class="navbar-brand">Users</div>
        <div class="navbar-nav">
          <a class="btn btn-link" href="{{route('users.create')}}">Create</a>
        </div>
      </div>
    </nav>
    <hr>

    <div class="table-responsive" >
      <table id="pageTable" class="table table-striped align-middle">
        <thead>
          <tr>
            <th>@lang('Fisrt Name')</th>
            <th>@lang('Last Name')</th>
            <th>@lang('Email')</th>
            <th>@lang('Admin')</th>
            <th>@lang('Actions')</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->email}}</td>
            <td>@if($user->is_admin) Yes @endif</td>
            <td>
              <div class="d-flex">
                <div class="pe-2"><a href="{{route('users.edit', $user)}}">@lang('Edit')</a></div>
                <div><a class="text-danger confirm-required" data-confirm-url="{{route('users.destroy', $user)}}" href="#">@lang('Delete')</a></div>
              </ul>            
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>        
    </div> 
    {{$users->links()}} 
  </div>   
</div>  
 
<x-confirm-modal />
@endsection

@push('extra_js')
<script>
  $(document).on("click",".confirm-required", function(e) {
    e.preventDefault();
    $('#confirm-form').attr('action', $(this).attr("data-confirm-url"));
    $('#modal-confirm').modal('show');
  });
</script>
@endpush
