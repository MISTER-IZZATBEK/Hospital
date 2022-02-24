
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
        <div align="center" style="padding-top:100px; ">
            <table>
                <tr style="background-color:black; border:1px solid white;">
                    <th style="padding: 10px;" > Customer Name</th>
                    <th style="padding: 10px;"> Email</th>
                    <th style="padding: 10px;"> Phone</th>
                    <th style="padding: 10px;"> Doctor Name</th>
                    <th style="padding: 10px;"> Message</th>
                    <th style="padding: 10px;"> Status</th>
                    <th style="padding: 10px;"> Approved</th>
                    <th style="padding: 10px;"> Canceled</th>
                    <th style="padding: 10px;"> Send Mail</th>

                </tr>
          @foreach($data as $appoint)
                <tr align="center" style="background-color:skyblue; border:1px solid white;">
                    <td style="border:1px solid white;">{{$appoint->name}}</td>
                    <td style="border:1px solid white;">{{$appoint->email}}</td>
                    <td style="border:1px solid white;">{{$appoint->phone}}</td>
                    <td style="border:1px solid white;">{{$appoint-> doctor}}</td>
                    <td style="border:1px solid white;">{{$appoint-> date}}</td>
                    <td style="border:1px solid white;">{{$appoint-> status}}</td>
                    <td><a class="btn btn-success" href="{{url('approved', $appoint->id)}}">Approved</a></td>
                    <td><a class="btn btn-danger" href="{{url('canceled', $appoint->id)}}">Canceled</a></td>
                    <td><a class="btn btn-primary" href="{{url('emailview', $appoint->id)}}">Send Mail</a></td>
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
