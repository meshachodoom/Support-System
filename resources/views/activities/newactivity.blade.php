@extends('layout')

@section('content')

<h3>Add Activity</h3>

<div class="row">

   <div class="col-md-12 col-sm-12 col-xs-12">

     <!-- Alert message (start) -->
   @if(Session::has('message'))
     <div class="alert {{ Session::get('alert-class') }}">
        {{ Session::get('message') }}
     </div>
     @endif 
     <!-- Alert message (end) -->

     <div class="actionbutton">

        <a class='btn btn-info float-right' href="{{route('activities.personaldashboard')}}">Back to My Dashboard</a>

</div>

<form action="{{route('activities.store')}}" method="post">
   @csrf

   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="SMSCount">SMS Count <span
            class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
         <input id="SMSCount" class="form-control col-md-12 col-xs-12" name="SMSCount" placeholder="Enter SMS Count"
            required="required" type="number">
      </div>
   </div>

   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span
            class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
         <input type="radio" value="Pending" name="status" required="required">Pending
         <input type="radio" value="Done" name="status" required="required">Done
      </div>
   </div>

   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Remarks</label>
      <div class="col-md-6 col-sm-6 col-xs-12">
         <textarea name='remarks' id='remarks' class='form-control' placeholder="Enter Remarks"></textarea>

      </div>
   </div>

   <div class="form-group">
      <div class="col-md-6">

         <input type="submit" name="submit" value='Submit' class='btn btn-success'>
      </div>
   </div>

</form>

</div>
</div>
@endsection