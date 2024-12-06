@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-12 col-md-8">
      <a class="btn btn-link" href="{{route('users.index')}}">Return</a>
      <div class="card">           
        <div class="card-body"> 
          <h3>@if($user->exists) Edit User @else New User @endif</h3>
          <form id="formPage" method="POST">
            @csrf

            <div class="row mb-3 g-3">
              <div class="col-sm-12 col-md-5">
                <label for="first_name" class="form-label">@lang('First Name') *</label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="{{$user->first_name}}" required maxlength="191">  
              </div> 
              <div class="w-100 mt-0"></div>  
              <div class="col-sm-12 col-md-5">
                <label for="last_name" class="form-label">@lang('Last Name') *</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="{{$user->last_name}}" required maxlength="191">  
              </div>                   
              <div class="w-100 mt-0"></div>  
              <div class="col-sm-12 col-md-5">
                <label for="email" class="form-label">@lang('Email') *</label>
                <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}" required maxlength="191">  
              </div> 
              <div class="w-100 mt-0"></div>  
              <div class="col-sm-12 col-md-5">        
                  <label for="new_password" class="form-label ">@lang('Password') @if(!$user->exists)* @endif</label>
                  <input type="password" class="form-control" name="password" id="new_password" 
                          aria-describedby="new_password" 
                          autocomplete="off"
                          @if(!$user->exists) required @endif
                          minlength="8"> 
              </div> 
              <div class="w-100 mt-0"></div>  
              <div class="col-auto">   
                <label class="form-check mb-0">
                  <input class="form-check-input" name="is_admin" id="is_admin" value="1" 
                  @if($user->is_admin) checked @endif 
                  type="checkbox">
                  <span class="form-check-label">@lang('Admin')</span>
                </label>              
              </div> 
            </div>  
            <div class="row">
              <div class="col-sm-12">
                <div class="mt-4">
                  <a role="button" href="{{route('users.index')}}" class="btn btn-secondary">@lang('Cancel')</a>
                  <button type="button" id="saveForm" class="btn btn-primary">@lang('Save')</button>
                </div>          
              </div>  
            </div>                          
          </form>
        </div>
      </div>    
    </div>    
  </div>    
</div>    
@endsection

@push('extra_js')
<script>
document.addEventListener('DOMContentLoaded', function () {
  let form = $('#formPage').parsley({
    excluded: ":hidden"
  });

  $("#saveForm").click(function() {
    if (form.validate() === false) {
      return;
    }

    let data = $("#formPage").serializeToJSON();

    $.ajax({
      @if($user->exists)
      type: "PUT",
      url: '{{route('users.update', $user)}}',      
      @else
      type: "POST",
      url: '{{route('users.store')}}',
      @endif
      dataType : 'json',
      data: data 
    })
    .done(function(response) {
      window.location = '{{route('users.index')}}';
    });
  });
});
</script>
@endpush

