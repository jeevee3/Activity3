<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <style>
        body {
            background-image: url('https://i.pinimg.com/originals/58/6e/51/586e51559dc40f48cd8ce65af9c1522f.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 25px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
            color: #000; /* changed font color to black */
        }

        h2 {
            margin-bottom: 20px;
            color: #000; /* black text */
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #000; /* black labels */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #000; /* black text */
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            float: right;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: rgba(248, 215, 218, 0.9);
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New User
            <a href="/users" class="btn btn-secondary">Back</a>
        </h2>

        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Display Fail Message --}}
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif

        {{-- Add User Form --}}
        <form action="{{ route('users.add.submit') }}" method="POST">
            @csrf
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" required>

            <label for="email">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" value="{{ old('phone_number') }}" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
</body>
</html>
