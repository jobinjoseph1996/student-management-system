<html>

<head>
    <title>Student Management System
    </title>
    <style>
        .content {
            background-image: linear-gradient(to right, #C9D6FF, #E2E2E2);
            height: 600px;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script>
        var base_url = "{{Config::get('app.url')}}";
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{asset('public/js/markentry.js')}}"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background:#D76D77">
            Student Management System
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="{{ url('/') }}">Dashboard</a>
                    <a class="nav-item nav-link" href="{{ url('student') }}">User Creation</a>
                    <a class="nav-item nav-link" href="{{ url('markentry') }}">Mark Entry</a>

                </div>
            </div>

        </nav>
    </header>
    <div>
    </div>
    <div class="row">
        <div class="container">
            <h3>Mark Entry</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="row m-4">
                    @csrf
                    @if( session('message'))
                    <div class="col-sm-12 alert {{ session('alert-class') }}">{{ session('message') }}</div>
                    @endif
                    <div class="col-sm-12 float-right">
                        <button type="button" class="btn btn-sm  btn-primary" data-toggle="modal" data-target="#modal-add" onclick="return loadAddForm('markentry');" style="margin-bottom: 10px; float:right">Add New</button>

                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-left">Name</th>
                                <th class="text-center" style="width: 80px;">Maths</th>
                                <th class="text-center" style="width: 80px;">Science</th>
                                <th class="text-center" style="width: 80px;">History</th>
                                <th class="text-center" style="width: 80px;">Term</th>
                                <th class="text-center" style="width: 80px;">Total Marks</th>
                                <th class="text-center" style="width: 80px;">Created On</th>
                                <th class="text-center" style="width: 150px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$user->isEmpty())
                            @foreach($user as $key => $value)
                            <tr>
                                <td class="text-center">{{ $value->id }}</td>
                                <td>{{ ucwords($value->student->name) }}</td>
                                <td class="text-center">{{ $value->maths }}</td>
                                <td class="text-center">{{ $value->science }}</td>
                                <td class="text-center">{{ $value->history }}</td>
                                <td class="text-center">{{ $value->terms }}</td>
                                @php
                                $total= $value->maths+$value->science+$value->history;
                                @endphp
                                <td class="text-center">{{ $total }}</td>
                                <td class="text-center">{{date('M d, Y H:i A', strtotime($value->created_at))}}</td>
                                <td class="text-center">
                                    <a class="btn btn-small btn-info" href="{{ url('markentry/edit',[$value->id]) }}">Edit</a>
                                    <a class="btn btn-small btn-danger" href="{{ url('markentry/delete',[$value->id]) }}">Delete</a>


                                </td>
                            </tr>
                            @endforeach
                            @else
                            <td class="text-center" colspan="6">No records found.</td>
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>