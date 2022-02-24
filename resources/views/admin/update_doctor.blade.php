
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <base href="/public">
    <style type="text/css">
        label{
            display:inline-block;
            width:200px
        }
    </style>
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

        <div  class="container" align="center" style="padding-top: 100px">
            @if(session()->has('message'))
                <div class="alert alert-success ">
                    {{session()->get('message')}} <button type="button" class="close" data-dismiss="alert">x</button>
                </div>
            @endif

            <form  action="{{url('editdoctor', $data->id)}}" method="POST"  enctype="multipart/form-data">
                      @csrf
                        <div style="padding: 15px">
                            <label> Doctor Name</label>
                            <input type="text" style="color:black; border-radius:6px" value="{{$data->name}}" name="name" placeholder="Write the Name" required="">
                        </div>

                        <div style="padding: 15px">
                            <label> Phone</label>
                            <input type="number" style="color:black; border-radius:6px" value="{{$data->phone}}" name="phone" placeholder="Write the Number" required="">
                        </div>

                        <div style="padding:15px;">
                            <label>Speciality</label>
                            <input type="text" style="color:black; border-radius:6px" value="{{$data->specialty}}" name="specialty" placeholder="Write the Speciality" required="">
                        </div>

                        <div style="padding:15px">
                            <label> Room No</label>
                            <input type="text" value="{{$data->room}}" style="color:black; border-radius:6px" name="room" placeholder="Write the room number" required="">
                        </div>

                        <div style="padding: 15px">
                            <label> old Image</label>
                           <img src="doctor_image/{{$data->image}}">
                        </div>
                        <div style="padding: 15px">
                            <label> Сhange Image</label>
                          <input type="file" name="file">
                        </div>

                <div style="padding: 15px" >
                    <input type="submit" class="btn btn-primary" >
                </div>
            </form>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
@include('admin.script')
<!-- End custom js for this page -->
</body>
</html>

