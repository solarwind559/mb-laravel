@extends('layout')
@section('title', 'Register')
@section('content')
<div class="container">


    <form id="registrationForm" action="{{ route('registration.post') }}" method="post" style="max-width:500px;" class="py-5">
        @csrf
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="examplename" aria-describedby="nameHelp" name="name" value="{{ old('name') }}">
            <div class="alert alert-danger" id="nameError" style="display: none;"></div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
            <div class="alert alert-danger" id="emailError" style="display: none;"></div>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            <div class="alert alert-danger" id="passwordError" style="display: none;"></div>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation">
            <div class="alert alert-danger" id="passwordConfirmationError" style="display: none;"></div>
            @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check">
            <label class="form-check-label" for="exampleCheck1">Subscribe to newsletter?</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let isValid = true;

            // Clear previous error messages
            document.getElementById('nameError').style.display = 'none';
            document.getElementById('emailError').style.display = 'none';
            document.getElementById('passwordError').style.display = 'none';
            document.getElementById('passwordConfirmationError').style.display = 'none';

            // Validate name
            const name = document.getElementById('examplename').value;
            if (!name) {
                document.getElementById('nameError').innerText = 'Name is required';
                document.getElementById('nameError').style.display = 'block';
                isValid = false;
            }

            // Validate email
            const email = document.getElementById('exampleInputEmail1').value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email) {
                document.getElementById('emailError').innerText = 'Email address is required';
                document.getElementById('emailError').style.display = 'block';
                isValid = false;
            } else if (!emailPattern.test(email)) {
                document.getElementById('emailError').innerText = 'Please provide a valid e-mail address';
                document.getElementById('emailError').style.display = 'block';
                isValid = false;
            }

            // Validate password
            const password = document.getElementById('exampleInputPassword1').value;
            if (!password) {
                document.getElementById('passwordError').innerText = 'Password is required';
                document.getElementById('passwordError').style.display = 'block';
                isValid = false;
            }

            // Validate password confirmation
            const passwordConfirmation = document.getElementById('exampleInputPassword2').value;
            if (password !== passwordConfirmation) {
                document.getElementById('passwordConfirmationError').innerText = 'This field value must be the same as "Password".';
                document.getElementById('passwordConfirmationError').style.display = 'block';
                isValid = false;
            }

            if (isValid) {
                this.submit();
            }
        });
    </script>
@endsection



