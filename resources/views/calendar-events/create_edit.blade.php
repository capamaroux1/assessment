@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-12 col-md-8">
      <a class="btn btn-link" href="{{route('calendar-events.index')}}">Return</a>
      <div class="card">           
        <div class="card-body"> 
          <h3>@if($calendarEvent->exists) Edit Event @else New Event @endif</h3>

          <form id="formPage" method="POST">
            @csrf

            <div class="row mb-3 g-3">
              <div class="col-sm-12 col-md-5">
                <label for="title" class="form-label">@lang('Title') *</label>
                <input type="text" class="form-control" name="title" id="title" value="{{$calendarEvent->title}}" required maxlength="50">  
              </div> 
              <div class="w-100 mt-0"></div> 
              <div class="col-sm-12 col-md-5">
                <label for="start_date" class="form-label ">@lang('Start')</label>
                <input type="text" class="form-control " required name="start_date" id="start_date" value="{{$calendarEvent->start_date ?? today()}}" />
              </div> 
              <div class="w-100 mt-0"></div> 
              <div class="col-sm-12 col-md-5">
                <label for="description" class="form-label">@lang('Description') *</label>
                <input type="text" class="form-control" name="description" id="description" value="{{$calendarEvent->description}}" required maxlength="50">  
              </div>  
              <div class="w-100 mt-0"></div> 
              <div class="col-sm-12 col-md-5">
                <label for="capacity" class="form-label">@lang('Capacity') *</label>
                <input type="number" class="form-control" name="capacity" id="capacity" value="{{$calendarEvent->capacity}}" step="1" required min="0">  
              </div>                
              <div class="w-100 mt-0"></div> 
              <div class="col-sm-12 col-md-5">
                <label for="location" class="form-label">@lang('Location') *</label>
                <select name="location" id="location" class="form-select">
                   @foreach($eventLocations as $enumInstance)
                   <option value="{{$enumInstance->value}}" @if(optional($calendarEvent->location)->value === $enumInstance->value) selected @endif>
                    {{$enumInstance->description()}}</option>
                   @endforeach
                </select> 
              </div> 
              <div class="w-100 mt-0"></div> 
              <div class="col-sm-12 col-md-5">
                <label for="status" class="form-label">@lang('Status') *</label>
                <select name="status" id="status" class="form-select">
                   @foreach($eventStatus as $enumInstance)
                   <option value="{{$enumInstance->value}}" @if(optional($calendarEvent->status)->value === $enumInstance->value) selected @endif>
                      {{$enumInstance->description()}}</option>
                   @endforeach
                </select> 
              </div>
              <div class="w-100 mt-0"></div> 
              <div class="col-sm-12 col-md-5">
                <label for="type" class="form-label">@lang('Type') *</label>
                <select name="type" id="type" class="form-select">
                   @foreach($eventTypes as $enumInstance)
                   <option value="{{$enumInstance->value}}" @if(optional($calendarEvent->type)->value === $enumInstance->value) selected @endif>
                    {{$enumInstance->description()}}</option>
                   @endforeach
                </select> 
              </div>                             
            </div> 

            <div class="row">
              <div class="col-sm-12">
                <div class="mt-4">
                  <a role="button" href="{{route('calendar-events.index')}}" class="btn btn-secondary">@lang('Cancel')</a>
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
  const start_date = flatpickr($("#start_date"), {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
  });

  $("#saveForm").click(function() {
    if (form.validate() === false) {
      return;
    }

    let data = $("#formPage").serializeToJSON();

    $.ajax({
      @if($calendarEvent->exists)
      type: "PUT",
      url: '{{route('calendar-events.update', $calendarEvent)}}',      
      @else
      type: "POST",
      url: '{{route('calendar-events.store')}}',
      @endif
      dataType : 'json',
      data: data 
    })
    .done(function(response) {
      window.location = '{{route('calendar-events.index')}}';
    });
  });
});
</script>
@endpush

