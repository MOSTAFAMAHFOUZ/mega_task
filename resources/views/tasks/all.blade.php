<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1 class="p-2 text-center">All Tasks</h1>

    <div class="container">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{route('dashboard.tasks.import')}}"
                 enctype="multipart/form-data" class="my-3">
                    <div class="form-group">
                        <label for="">choose File</label>
                        <input type="file" name="tasks_file" class="form-control">
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary form-control my-1" value="Import Tasks">
                </form>
            </div>
            <div class="col-12">
                @if(count($data))
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Name</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Branch</th>
                            <th>Due Date</th>
                            <th>Priority</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr @if($row->priority=='urgent') class="bg-warning" @endif>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->task_name}}</td>
                            <td>{{$row->employee_name}}</td>
                            <td>{{$row->department}}</td>
                            <td>{{$row->branch}}</td>
                            <td>{{$row->due_date}}</td>
                            <td>{{$row->priority}}</td>
                            <td>
                                <a href="{{route('dashboard.tasks.edit',$row->id)}}" class="btn btn-info">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center my-4">
                    {{$data->links()}}
                </div>
                @else  
                    <div class="bg-danger text-white text-center p-3"> Tasks Not Found</div>
                @endif 
            </div>

        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>