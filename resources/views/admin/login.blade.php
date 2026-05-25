<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin · {{ config('wedding.partner_one') }} &amp; {{ config('wedding.partner_two') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-ocean flex items-center justify-center px-5 font-sans text-lagoon-900">
    <div class="w-full max-w-sm rounded-3xl bg-white p-8 shadow-lg ring-1 ring-sand-200">
        <h1 class="text-center text-script text-5xl text-lagoon-700">Admin</h1>
        <p class="mt-2 text-center text-lagoon-600">Enter the password to view RSVPs.</p>

        @if ($errors->any())
            <p class="mt-4 rounded-xl bg-coral-300/30 px-4 py-2 text-center text-sm text-coral-600 ring-1 ring-coral-300">
                {{ $errors->first('password') }}
            </p>
        @endif

        <form method="POST" action="{{ route('admin.login.attempt') }}" class="mt-6 space-y-4">
            @csrf
            <input type="password" name="password" required autofocus placeholder="Password"
                   class="w-full rounded-xl border-sand-200 bg-sand-50 px-4 py-3 text-lagoon-900 focus:border-lagoon-400 focus:ring-lagoon-400">
            <button type="submit"
                    class="w-full rounded-full bg-coral-500 px-6 py-3 text-white font-medium hover:bg-coral-600 transition">
                Sign in
            </button>
        </form>
    </div>
</body>
</html>
