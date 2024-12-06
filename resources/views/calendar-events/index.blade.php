@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-12">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <div class="navbar-brand">Events</div>
        <div class="navbar-nav">
          <a class="btn btn-link" href="{{route('calendar-events.create')}}">Create</a>
        </div>
      </div>
    </nav>
    <hr>

    <div class="table-responsive" >
      <table class="table table-striped align-middle">
          <thead>
            <tr>
              <th>@lang('Title')</th>
              <th>@lang('Description')</th>
              <th>@lang('Capacity')</th>
              <th>@lang('Start Date')</th>
              <th>@lang('Location')</th>
              <th>@lang('Status')</th>
              <th>@lang('Type')</th>
              <th>@lang('Actions')</th>
            </tr>
          </thead>
        <tbody>
            @forelse($calendar_events as $calendar_event)
            <tr>
              <td>{{$calendar_event->title}}</td>
              <td>{{$calendar_event->description}}</td>
              <td>{{$calendar_event->capacity}}</td>
              <td>{{$calendar_event->start_date->format('d/m/Y H:i')}}</td>
              <td>{{$calendar_event->location->description()}}</td>
              <td>{{$calendar_event->status->description()}}</td>
              <td>{{$calendar_event->type->description()}}</td>
              <td>
                <div class="d-flex">
                  <div class="pe-2"><a href="{{route('calendar-events.edit', $calendar_event)}}">@lang('Edit')</a></div>
                  <div><a class="text-danger confirm-required" data-confirm-url="{{route('calendar-events.destroy', $calendar_event)}}" href="#">@lang('Delete')</a></div>
                </ul>            
              </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">No Results Found</td>
            </tr>
            @endforelse
        </tbody>
      </table>        
    </div> 
    {{$calendar_events->links()}} 
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
