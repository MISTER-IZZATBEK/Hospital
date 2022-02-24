
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
@include('admin.sidebar')
<!-- partial -->
@include('admin.navbar')
<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div  align="center" style="padding-top: 100px">
            <table>
                <tr style="background-color:black; border:1px solid white;">
                    <th style="padding: 10px;"> Doctor Name</th>
                    <th style="padding: 10px;"> Phone</th>
                    <th style="padding: 10px;"> Specialty</th>
                    <th style="padding: 10px;"> Room No</th>
                    <th style="padding: 10px;"> Image</th>
                    <th style="padding: 10px;"> Update</th>
                    <th style="padding: 10px;"> Delete</th>
                </tr>
              @foreach($data as $doctor)
                <tr align="center" style="background-color:skyblue; border:1px solid white;">
                    <td style="border:1px solid white;">{{$doctor->name}}</td>
                    <td style="border:1px solid white;">{{$doctor->phone}}</td>
                    <td style="border:1px solid white;">{{$doctor-> specialty}}</td>
                    <td style="border:1px solid white;">{{$doctor-> room}}</td>
                    <td style="border:1px solid white;"><img height="60" width="60" src="doctor_image/{{$doctor-> image}}"></td>
                    <td><a class="btn btn-primary" href="{{url('updatedoctor', $doctor->id)}}">Update</a></td>
                    <td><a onclick="return confirm('Are you sure to delete this')" class="btn btn-danger" href="{{url('deletedoctor', $doctor->id)}}">Delete</a></td>
                </tr>
                  @endforeach
            </table>
        </div>
    </div>
<!-- container-scroller -->
    <!-- plugins:js -->
@include('admin.script')
<!-- End custom js for this page -->
</body>
</html>
