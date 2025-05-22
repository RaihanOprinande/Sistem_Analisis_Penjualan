<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-50">
    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->



    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8">
        @if ($message = Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-gray-800 p-4" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ $message }}</p>
            </div>
        @elseif($message = Session::get('error'))
            <div class="bg-green-100 border-l-4 border-red-500 text-gray-800 p-4" role="alert">
                <p class="font-bold">Failed</p>
                <p>{{ $message }}</p>
            </div>
        @endif
        <form class="space-y-6" method="POST" action="/register">
            @csrf
            <h5 class="text-xl font-medium">Sign up to our platform</h5>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium ">Your Name</label>
                <input type="name" name="name" id="name" value="{{ old('name') }}"
                    class="@error('name') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 "
                    placeholder="Denis" required />
            </div>

            <div>
                <label for="email" class="block mb-2 text-sm font-medium ">Your email</label>
                <input type="email" name="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 "
                    placeholder="name@gmail.com" required />
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium ">Your password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 "
                    required />
            </div>
            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium ">Confirm Password</label>
                <input type="password_confirmation" name="password_confirmation" id="password_confirmation"
                    placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 "
                    required />
            </div>
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login
                to your account</button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                Already had an account <a href="/login" class="text-blue-700 hover:underline dark:text-blue-500">Sign
                    in</a>
            </div>
        </form>
    </div>


</body>

</html>
