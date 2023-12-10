<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Form</title>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
</head>

<body>
<h1> Expense Tracker </h1>
<form action="{{route('user.store')}}" method="post">
    @csrf
    <h2> User Register Form</h2>

    @if(session('message'))
        <h3>{{ session('message') }}</h3>
    @endif

    <div class="input-container">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name">
        @error('name')
        <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-container">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        @error('email')
        <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-container">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        @error('password')
        <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    <div class="submit">
    <input type="submit" value="Register">
    </div>
    <div class="login">
        <p> Already Have a A ?<a href="{{route('login.form')}}">Login</a> </p>

    </div>
</form>

</body>

</html>
