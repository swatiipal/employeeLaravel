<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Select2 CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Hello, world!</title>
</head>

<body><br>
    <div class="container">
        <center>
            <h4>Employee Info!</h4>
        </center><br>
        {{-- {{dd($cities)}} --}}
        <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="form-group row">
                <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="dob">
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <input type="radio" name="gender" value="M"> Male
                    <input type="radio" name="gender" value="F"> Female
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="address"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="state" class="col-sm-2 col-form-label">State</label>
                <div class="col-sm-10">
                    <select value="" class="form-control" name="state" id="state">
                        <option value="">Select State..</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->state_id }}">{{ $state->state_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-10">
                    <select value="" class="form-control" name="city" id="city">
                        <option value="">Select City..</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Profile Photo</label>
                <div class="col-sm-10">
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="skills" class="col-sm-2 col-form-label">Skills</label>
                <div class="col-sm-10">
                    <select value="" name="skills[]" id="skills" class="skills" multiple="multiple"
                        style="width: 100%">
                        @foreach ($skills as $skill)
                            <option value="{{ $skill->skill_id }}">{{ $skill->skill_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="certificate" class="col-sm-2 col-form-label">Certificates</label>
                <div class="col-sm-10">
                    <input type="file" name="certificate[]" id="certificate" class="form-control" multiple>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('.skills').select2();
        });
    </script>
</body>

</html>
