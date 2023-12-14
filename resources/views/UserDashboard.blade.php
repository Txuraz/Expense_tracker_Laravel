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
        <h2>Welcome {{$user->name}}</h2>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEntryModal">Add</button>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#filterModal">Filter</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal">Logout</button>
        <a href="{{route('user.dashboard')}}"> <button type="button" class="btn btn-secondary">Reset Filter</button></a>

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
            </tr>
            </thead>
            <tbody>
            @foreach($transaction as $data)
                <tr class="{{ $data->type === 'income' ? 'table-success' : 'table-danger' }}">
                <td>{{$data->date}}</td>
                <td>{{$data->type}}</td>
                <td>{{$data->category}}</td>
                <td>{{$data->amount}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $transaction->links("pagination::bootstrap-4") }}
    </div>
</div>

<!-- Add Entry Modal -->
<div class="modal fade" id="addEntryModal" tabindex="-1" role="dialog" aria-labelledby="addEntryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEntryModalLabel">Add New Entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('income_expenses.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input name="amount" type="number" class="form-control" id="amount" placeholder="Enter amount" required>
                        @error('amount')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text"  name="category" class="form-control" id="subject" placeholder="Enter subject" required>
                        @error('category')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="entryType">Type</label>
                        <select class="form-control" id="entryType" name="type">
                            <option value="income">Income</option>
                            <option value="expenses">Expenses</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entryDate">Date</label>
                        <input name="date" type="date" class="form-control" id="entryDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Transactions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your filter form elements here -->
                <form action="{{route('dashboard.filter')}}" method="get">
                    @csrf
                    <div class="form-group">
                        <label for="filterFromDate">From Date</label>
                        <input type="date" name="fromDate" class="form-control" id="filterFromDate">
                    </div>
                    <div class="form-group">
                        <label for="filterToDate">To Date</label>
                        <input type="date" name="toDate" class="form-control" id="filterToDate">
                    </div>
                    <div class="form-group">
                        <label for="filterType">Filter by Type</label>
                        <select class="form-control" id="filterType" name="type">
                            <option value="">All</option>
                            <option value="income">Income</option>
                            <option value="expenses">Expenses</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" >Apply Filter</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{route('logout')}}"> <button type="button" class="btn btn-danger">Logout</button></a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
