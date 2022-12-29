@extends('layout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('content')

    
<h3>Activities</h3>

<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">

      <div class='actionbutton'>
   <a class='btn btn-info float-right' href="{{route('dashboard')}}">Back to Reporting</a>
         
        </div>

      <table class="table" >
          <tr>
        <th width='5%'>Id</th>
            <th width='10%'>Created by</th>
            <th width='20%'>Created At</th>
            <th width='10%'>Updated by</th>
            <th width='15%'>Updated At</th>
            <th width='10%'>SMS Count</th>
      <th width='10%'>Status</th>
            <th width='15%'>Remarks</th>
          </tr>
       </thead>
        <tbody>
        @foreach($activities as $activity)
            
           <tr>
              <td>{{ $activity-> id }}</td>
       <td>{{ $activity-> currentUser }}</td>
              <td>{{ $activity->created_at }}</td>
              <td>{{ $activity->updatedBy }}</td>
      <td>{{ $activity->updated_at }}</td>
   <td>{{ $activity->SMSCount }}</td>
   <td>{{ $activity->status}}</td>
   <td>{{ $activity-> remarks}}</td>
   <td>

      <a href="{{ route('activities.updateactivity',[$activity->id]) }}" class="btn btn-sm btn-info">Update</a>

   </td>
   </tr>

   @endforeach

   </tbody>
   </table>

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