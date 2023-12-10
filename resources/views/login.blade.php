<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Form</title>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
</head>

<body>
<h1> Expense Tracker </h1>
<form action="{{route('auth.user')}}" method="post">
    @csrf
    <h2> Login </h2>

    @if(session('message'))
        <h3>{{ session('message') }}</h3>
    @endif

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

    <input type="submit" value="Login">

<p>Haven't Register Yet ?<a href="{{route('register.form')}}">Register</a> </p>
</form>
</body>

</html>
