<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacks Optical - Admin Login</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Animations CSS -->
    <link href="{{ asset('assets/css/animations.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-black: #000000;
            --secondary-black: #1a1a1a;
            --pure-white: #ffffff;
            --light-gray: #cccccc;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--primary-black);
            color: var(--pure-white);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            padding: 50px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 10;
            animation: fadeInScale 0.8s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .btn-premium {
            background: var(--pure-white);
            color: var(--primary-black);
            border: 1px solid var(--pure-white);
            font-weight: 700;
            letter-spacing: 1px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-premium:hover {
            background: transparent;
            color: var(--pure-white);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.1);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--pure-white);
            border-radius: 12px;
            padding: 0.8rem 1rem;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: none;
            color: var(--pure-white);
        }

        .form-floating label {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            color: #000;
        }

        .logo-glow {
            font-size: 1.5rem;
            letter-spacing: 4px;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            display: block;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>

    <div class="login-card text-center reveal-on-scroll">
        <div class="mb-5">
            <h3 class="fw-black text-white logo-glow mb-2"><img src="{{ asset('assets/images/favicon.png') }}" width="50" alt=""> SACKS OPTICAL</h3>
            <p class="text-white-50 small text-uppercase letter-spacing-2">Secure Admin Access</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-white small text-start mb-4">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-floating mb-3 text-start">
                <input type="email" name="email" class="form-control" id="emailInput" placeholder="name@example.com"
                    required>
                <label for="emailInput">Username / Email</label>
            </div>
            <div class="form-floating mb-4 text-start">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"
                    required>
                <label for="floatingPassword">Password</label>
            </div>

            <button class="btn btn-premium w-100 py-3 rounded-pill magnetic-btn" type="submit">AUTHENTICATE</button>
        </form>

        <div class="mt-5 small text-white-50 opacity-50">
            &copy; {{ date('Y') }} SACKS OPTICAL &bull; PRIVATE SYSTEM
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('assets/js/dashboard-animations.js') }}"></script>

</body>

</html>