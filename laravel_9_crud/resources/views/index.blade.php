@extends('master')
@section('content')
@if($message = Session::get('success'))
<div class="alert alert-success">
	{{ $message }}
</div>
@endif
<!DOCTYPE html>
<html>
<head>
    <title>Laravel Sweet Alert Confirm Delete Example - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
</head>
<body>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Student Data</b></div>
			<div class="col col-md-6">
				<a href="{{ route('students.create') }}" class="btn btn-success btn-sm float-end">Add</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered" id="testing">
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Action</th>
			</tr>
			@if(count($data) > 0)
				@foreach($data as $row)
					<tr>
						<td><img   src="{{ asset('images/' . $row->student_image) }}" width="75"  onclick="enlargeImg()"
             id="img1" />
                   </td>
						<td>{{ $row->student_name }}</td>
						<td id="row2" class="studentnumber"><a href="" name="emailLink" id="emailLink"> {{ $row->student_email }}</a></td>
						<td>{{ $row->student_gender }}</td>
						<td>
							<form method="post" action="{{ route('students.destroy', $row->id) }}">
								@csrf
								@method('DELETE')
								<a href="{{ route('students.show', $row->id) }}" class="btn btn-primary btn-sm">View</a>
								<a href="{{ route('students.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
								<button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
							</form>
						</td>
					</tr>
                @endforeach
            @else
				<tr>
					<td colspan="5" class="text-center">No Data Found</td>
				</tr>
			@endif
		</table>
		{!! $data->links() !!}
	</div>
</div>
</body>
<script type="text/javascript">
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
</script>
<script>
    $(document).on("click","a[name='emailLink']", function (e) {
		var studentnum_array = [];
        $("#testing #row2").each(function(index){
	   	studentnum_array=$(this).text().trim();
		//alert(studentnum_array);
        var subject = 'Sample';
        var emailBody = '';
        window.location = 'mailto:' + studentnum_array + 'subject=' + subject + '&body=' +   emailBody;
	});
    });
</script>
</html
@endsection
