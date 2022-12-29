@extends('layout')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('content')

<h3>Activities</h3>


<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
   @if(Session::has('message'))
     <div class="alert {{ Session::get('alert-class') }}">
        {{ Session::get('message') }}
     </div>
   @endif

      <form action="{{route('activities.searchpersonal')}}" method="GET">
        
      <div class='actionbutton'>
    
   <input type="submit" name="submit" value='Search' class='btn btn-info float-right' style="margin-top:23px">
      <p class="float-right">To: <input type="datetime-local"  class="form-control col-md-12 col-xs-12"name= "endDate" placeholder="Select date" required></p>
      <p class="float-right">From: <input type="datetime-local" class="form-control col-md-12 col-xs-12" name= "startDate" placeholder="Select date" required></p>
      
         <a class='btn btn-info float-left' href="{{route('dashboard')}}" >Reporting</a>
         <a class='btn btn-info float-left' href="{{route('activities.newactivity')}}" style="margin-left:20px">Add</a>
         
        </div>

   <table class="table">
          <tr>
            <th width='5%'>Id</th>
      <th width='20%'>Created At</th>
            <th width='10%'>Updated By</th>
            <th width='15%'>Updated At</th>
      <th width='10%'>SMS Count</th>
            <th width='15%'>Remarks</th>
            <th width='10%'>Status</th>
      </tr>
        </thead>
        <tbody>

        @foreach($activities as $activity)
            
           <tr>
              <td>{{ $activity-> id }}</td>
              <td>{{ $activity->created_at }}</td>
              <td>{{ $activity->updatedBy }}</td>
         <td>{{ $activity->updated_at }}</td>
         <td>{{ $activity->SMSCount }}</td>
         <td>{{ $activity-> remarks}}</td>
         <td> @if ($activity->status === 'Done')
            <span class="mj_btn btn btn-success">Done</span>
            @else
            <span class="mj_btn btn btn-warning">Pending</span>
            @endif
         </td>
         <td>

            <a href="{{ route('activities.updateactivity',[$activity->id]) }}" class="btn btn-sm btn-info">Update</a>

         </td>
      </tr>

      @endforeach



      </tbody>
   </table>

   </form>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
   config = {
      enableTime: true,
      dateFormat: 'Y-m-d H:S:i',
   }
   flatpickr("input[type=datetime-local]", config);
</script>
@endsection