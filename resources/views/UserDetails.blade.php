<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css') }}">
</head>
<body>

<div class="dashboard-container">
    <div class="header">
        <h2>{{$user->name}}'s Total Income and Expenses </h2>
    </div>

    <div class="balance-container">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Income (RS)</div>
                    <div class="card-body">
                        <h4 class="card-title">{{$total_income}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Balance (RS)</div>
                    <div class="card-body">
                        <h4 class="card-title">{{$total_balance}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Total Expenses (RS)</div>
                    <div class="card-body">
                        <h4 class="card-title" >{{$total_expenses}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="buttons-container">
        <a href="{{route('admin.dashboard')}}"> <button type="button" class="btn btn-secondary"  >Back</button></a>


    </div>

    <div class="table-container">
        <h4>Total Income and Expenses</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Category</th>
                <th>Amount (RS)</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($incomeExpenses as $data)
                <tr class="{{ $data->type === 'income' ? 'table-success' : 'table-danger' }}">
                    <td>{{$data->date}}</td>
                    <td>{{$data->type}}</td>
                    <td>{{$data->category}}</td>
                    <td>{{$data->amount}}</td>
                    <td>
                        <form action="{{route('userDetails.delete', $data->id)}}" method="post">
                            @csrf
                            @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $incomeExpenses->links("pagination::bootstrap-4") }}


    </div>
</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
