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
  <script src="{{asset('public/js/studentdata.js')}}"></script>
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
  <div class="row">
        <div class="container">
            <h3>User Creation</h3>
        </div>
    </div>
  <div class="container">
    <div class="row mt-5">
      <div class="col-sm-8 offset-sm-2">
        <form action="{{ url('student') }}" method="post">
          @csrf
          @if( session('message'))
          <div class="col-sm-12 alert {{ session('alert-class') }}">{{ session('message') }}</div>
          @endif
          @if ($errors->any())
          <div class="col-sm-12 alert alert-danger">
            {!! implode('', $errors->all(':message <br>')) !!}
          </div>
          @endif
          <div class="form-group row">
            <div class="col-sm-2">
              <label for="firstname">Name:</label>
            </div>
            <div class="col-sm-4">
              <input type="text" name="name" id="name" class="form-control" maxlength="20" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-2">
              <label for="department">Age:</label>
            </div>
            <div class="col-sm-4">
              <input type="number" name="age" id="age" class="form-control" maxlength="20" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-2">
              <label for="firstname">Gender:</label>
            </div>
            <div class="col-sm-6">
              <input type="radio" name="gender" value="male"> Male
              <input type="radio" name="gender" value="female"> Female
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-2">
              <label for="teacher">Reporting Teacher:</label>
            </div>
            <div class="col-sm-4">
              <select name="teacher" id="teacher" class="form-control" required>
                <option value="">--Select--</option>
                <option value="Katie">Katie</option>
                <option value="Max">Max</option>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn  btn-danger" onclick="cancel()">Cancel</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>