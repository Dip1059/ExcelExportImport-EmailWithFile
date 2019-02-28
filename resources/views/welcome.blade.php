<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <br><br>
    <a href="{{url('/import-view')}}" class="btn btn-info">Import Excel</a>
    <a href="{{url('/export')}}" class="btn btn-success">Export Excel</a>
    <a href="{{url('/upload-view')}}" class="btn btn-danger">Send File to Email</a>
            <br><br><br>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Patient ID</th>
        <th>Patient Name</th>
        <th>Apointment Date</th>
        <th>Doctor</th>
      </tr>
    </thead>
    <tbody>
      @foreach($appoints as $appoint)
      <tr>
        <td>{{$appoint->pid}}</td>
        <td>{{$appoint->pname}}</td>
        <td>{{$appoint->apdate}}</td>
        <td>{{$appoint->dname}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
