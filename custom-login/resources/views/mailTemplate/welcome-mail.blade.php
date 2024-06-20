<!-- welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        /* Inline styles for email compatibility */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                padding: 0 20px !important;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-4">
                <h2 class="text-2xl font-bold text-gray-800">{{ $subject }}</h2>
                <p class="text-gray-600 mt-2">{{ $mailMessage }}</p>
                
                <a href="{{ route('laptops.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 mt-4 inline-block rounded">Start Shopping</a>
            </div>
        </div>
    </div>
</body>
</html>
