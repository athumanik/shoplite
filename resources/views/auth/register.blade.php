<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Shoplite Agrovet</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .agrovet-bg {
            background: linear-gradient(rgba(22, 101, 52, 0.85), rgba(22, 101, 52, 0.9)), url('https://images.unsplash.com/photo-1625246335528-4cf2c5da7d5f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
        }
        .register-card {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex">
        <!-- Left side - Registration Form -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <div class="flex items-center">
                        <svg class="h-10 w-10 text-green-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L3 9V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V9L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 12H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="ml-2 text-2xl font-bold text-gray-900">Shoplite Agrovet</span>
                    </div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Create your account
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Join thousands of agrovet professionals managing their business with Shoplite
                    </p>
                </div>

                <div class="mt-8">
                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        There were {{ $errors->count() }} errors with your submission
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mt-6 register-card bg-white p-8 rounded-xl border border-gray-100">
                        <form method="POST" action="{{ route('register') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Full Name
                                </label>
                                <div class="mt-1">
                                    <input id="name" name="name" type="text" autocomplete="name" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        placeholder="Enter your full name"
                                        value="{{ old('name') }}"
                                        autofocus>
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email Address
                                </label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        placeholder="Enter your email address"
                                        value="{{ old('email') }}">
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                <div class="mt-1 relative">
                                    <input id="password" name="password" type="password" autocomplete="new-password" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        placeholder="Create a strong password">
                                </div>
                                <div class="mt-2 grid grid-cols-4 gap-1">
                                    <div class="password-strength bg-gray-200" id="strength-1"></div>
                                    <div class="password-strength bg-gray-200" id="strength-2"></div>
                                    <div class="password-strength bg-gray-200" id="strength-3"></div>
                                    <div class="password-strength bg-gray-200" id="strength-4"></div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Use 8+ characters with a mix of letters, numbers & symbols</p>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                    Confirm Password
                                </label>
                                <div class="mt-1">
                                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        placeholder="Confirm your password">
                                </div>
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="terms" name="terms" type="checkbox" required
                                            class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="terms" class="font-medium text-gray-700">
                                            I agree to the
                                            <a href="{{ route('terms.show') }}" class="text-green-600 hover:text-green-500" target="_blank">
                                                Terms of Service
                                            </a>
                                            and
                                            <a href="{{ route('policy.show') }}" class="text-green-600 hover:text-green-500" target="_blank">
                                                Privacy Policy
                                            </a>
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                                    Create Account
                                </button>
                            </div>
                        </form>

                        <div class="mt-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">
                                        Already have an account?
                                    </span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('login') }}"
                                    class="w-full flex justify-center py-2 px-4 border border-green-600 rounded-md shadow-sm text-sm font-medium text-green-600 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                                    Sign in to your account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side - Background Image & Features -->
        <div class="hidden lg:block relative w-0 flex-1 agrovet-bg">
            <div class="absolute inset-0 flex items-center justify-center p-12">
                <div class="max-w-md text-center text-white">
                    <h3 class="text-3xl font-bold mb-6">Join Our Agrovet Community</h3>
                    <p class="text-lg mb-8">Start managing your agricultural business efficiently with our specialized platform.</p>

                    <div class="space-y-6 text-left">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-6 w-6 rounded-full bg-green-500 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-lg font-semibold">Manage Inventory Efficiently</h4>
                                <p class="text-green-100">Track livestock medicines, crop protection products, and feeds</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-6 w-6 rounded-full bg-green-500 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-lg font-semibold">Process Payments Securely</h4>
                                <p class="text-green-100">Accept multiple payment methods with farmer-friendly options</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-6 w-6 rounded-full bg-green-500 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-lg font-semibold">Grow Your Business</h4>
                                <p class="text-green-100">Access analytics and insights to make data-driven decisions</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 p-4 bg-green-800 bg-opacity-50 rounded-lg">
                        <p class="text-sm">"Shoplite Agrovet helped us increase sales by 40% with better inventory management and customer tracking."</p>
                        <p class="mt-2 text-sm font-semibold">- Dr. Sarah Chen, Green Valley Agrovet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthBars = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3'),
                document.getElementById('strength-4')
            ];

            // Reset all bars
            strengthBars.forEach(bar => {
                bar.style.backgroundColor = '#e5e7eb';
            });

            let strength = 0;

            // Length check
            if (password.length >= 8) strength++;

            // Contains lowercase and uppercase
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;

            // Contains numbers
            if (/\d/.test(password)) strength++;

            // Contains special characters
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            // Update strength bars
            for (let i = 0; i < strength; i++) {
                let color;
                if (strength === 1) color = '#ef4444';
                else if (strength === 2) color = '#f59e0b';
                else if (strength === 3) color = '#10b981';
                else if (strength === 4) color = '#059669';

                strengthBars[i].style.backgroundColor = color;
            }
        });
    </script>
</body>
</html>
