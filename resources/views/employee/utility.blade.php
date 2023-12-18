<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>View Employees!</title>
</head>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    {{-- <pre>
        {{ print_r($users->toArray()) }}
   </pre> --}}
    <div class="container"><br>

        <h4>
            <center> Hello
            </center>
        </h4>

        <a style="margin: 6px;" type="button" class="btn btn-primary p-1" href="{{ route('employee.view') }}"
            style="">Console</a><br><br>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Skills</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->dob }}</td>
                        <td>{{ $employee->gender }}</td>
                        <td>
                            @foreach ($states as $state)
                                @if ($employee->state == $state->state_id)
                                    {{ $state->state_name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($cities as $city)
                                @if ($employee->city == $city->city_id)
                                    {{ $city->city_name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @php
                                $skill_show = explode(',', $employee->skills);
                            @endphp
                            @foreach ($skill_show as $skill_s)
                                @foreach ($skills as $skill)
                                    @if ($skill_s == $skill->skill_id)
                                        {{ $skill->skill_name }}
                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td><a type="button" class="btn btn-warning" href="{{route('employee.restore', $employee->id)}}">Restore</a>
                            <a type="button" class="btn btn-danger" href="{{route('employee.force-delete', $employee->id)}}"
                                onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

</body>

</html>
