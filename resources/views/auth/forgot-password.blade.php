<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- logo  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/rpg-awesome@0.2.0/css/rpg-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0c2a47 0%, #1e3a5f 50%, #0c2a47 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #e0e0e0;
        }

        .forgot-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .forgot-box {
            background: rgba(12, 42, 71, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(14, 165, 233, 0.3);
            border-radius: 12px;
            padding: 50px 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 36px;
            font-weight: bold;
            color: #fff;
        }

        .logo-section h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            background: linear-gradient(135deg, #3b82f6 0%, #7dd3fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-section p {
            font-size: 12px;
            color: #999;
            margin: 0;
        }

        .description {
            background: rgba(14, 165, 233, 0.1);
            border: 1px solid rgba(14, 165, 233, 0.2);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 30px;
            font-size: 13px;
            line-height: 1.6;
            color: #ccc;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(14, 165, 233, 0.2);
            color: #e0e0e0;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: #888;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
            color: #e0e0e0;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #b0b0b0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-reset {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-reset:hover {
            background: linear-gradient(135deg, #06b6d4 0%, #2563eb 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.4);
        }

        .divider {
            text-align: center;
            margin: 30px 0 20px;
            font-size: 12px;
            color: #666;
        }

        .back-link {
            text-align: center;
            font-size: 13px;
        }

        .back-link a {
            color: #0ea5e9;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-link a:hover {
            color: #7dd3fc;
            text-decoration: underline;
        }

        .error-message {
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 5px;
        }

        .success-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
            border-radius: 8px;
            padding: 12px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        @media (max-width: 480px) {
            .forgot-box {
                padding: 40px 25px;
            }

            .logo-section h1 {
                font-size: 24px;
            }

            .form-control {
                font-size: 16px; /* Prevent zoom on mobile */
            }
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="forgot-box">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-icon"><i class="ra ra-angel-wings"></i></div>
                <h1>Sepatah</h1>
                <p>Reset Password</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Description -->
            <div class="description">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.
            </div>

            <!-- Forgot Password Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           placeholder="Enter your registered email" 
                           value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Reset Button -->
                <button type="submit" class="btn-reset">Send Reset Link</button>

                <!-- Divider -->
                <div class="divider">Remember your password?</div>

                <!-- Back to Login -->
                <div class="back-link">
                    <a href="{{ route('login') }}">Back to login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>