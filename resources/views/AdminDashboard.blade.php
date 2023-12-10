<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ URL::asset('css/adminDashboard.css') }}">

</head>
<body>

<div class="dashboard-container">
    <div class="header">
        <h2>Admin Dashboard</h2>
    </div>

    <div class="card-container">
        <!-- Total Users Card -->
        <div class="card">
            <h4 style="text-align: center; margin-bottom: 10px;">Total Users</h4>
            <p style="text-align: center; margin: 0; font-size: 50px">{{$total}}</p>
        </div>

        <!-- Admin Name Card -->
        <div class="card">
            <h1 style="text-align: center; margin-bottom: 10px;">{{$user->name}}</h1>
            <p style="text-align: center; margin: 0;">Admin User</p>
        </div>

        <!-- Add Admin User Button Card -->
        <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdminModal" style="margin-bottom: 10px;">Add Admin</button>
            <a href="{{ route('logout') }}"><button type="button" class="btn btn-danger">Logout</button></a>
        </div>
    </div>

    <!-- Total User Table -->
    <div class="table-container">
        <h4>Total Users</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userdata as $data)
                <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->user_type}}</td>
                    <td>
                        <!-- Delete User Button Modal Trigger -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal{{$data->id}}">Delete</button>
                        <!-- Update User Button Modal Trigger -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateUserModal{{$data->id}}">Update</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $userdata->links("pagination::bootstrap-4") }}
    </div>
</div>

<!-- Add Admin User Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAdminModalLabel">Add Admin User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your form elements here -->
                <form>
                    <div class="form-group">
                        <label for="adminName">Name</label>
                        <input type="text" class="form-control" id="adminName" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="adminEmail">Email</label>
                        <input type="email" class="form-control" id="adminEmail" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="adminName">Password</label>
                        <input type="text" class="form-control" id="adminPassword" placeholder="Enter name">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Admin User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
@foreach($userdata as $data)
    <div class="modal fade" id="deleteUserModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel{{$data->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel{{$data->id}}">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{route('user.delete', $data->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update User Modal -->
    <div class="modal fade" id="updateUserModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel{{$data->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModalLabel{{$data->id}}">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your form elements here -->
                    <form  action="{{route('user.update', $data->id)}}" method="post">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="updateUserName">Name</label>
                            <input type="text" name="name" class="form-control" id="updateUserName" placeholder="Enter name" value="{{$data->name}}">
                        </div>
                        <div class="form-group">
                            <label for="updateUserEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="updateUserEmail" placeholder="Enter email" value="{{$data->email}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
