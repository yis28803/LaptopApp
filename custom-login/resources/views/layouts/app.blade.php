<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Scripts --> 

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    
        <style>
            .ad{
                top:150px;
                transition: top 0.01s;
            }

        </style>
    </head>
    <body class="font-sans antialiased ">
        <div class="min-h-screen bg-gray-100 mb-2 relative">
            @include('layouts.navigation')
            
            <div class="ad fixed hidden lg:block left-2 text-white rounded-md shadow-md ">
                <img src="{{ asset('images/left_ad2.png') }}" alt="laptop-icon" class="block w-28 h-72 fill-current text-gray-800 rounded-lg shadow-md border-white"/>
            </div>
            <main>
                {{ $slot }}
            </main>
            <div class="ad fixed hidden lg:block right-2  text-white rounded-md shadow-md ">
                <img src="{{ asset('images/right_ad.png') }}" alt="laptop-icon" class="block w-28 h-72 fill-current text-gray-800 rounded-lg shadow-md border-white"/>
            </div>
            <footer class="bg-white shadow mb-2 text-gray-500">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 font-bold">
                    <div class="flex justify-between">
                        <div class="mb-4 mx-2 flex-none">
                            <h2 class="text-lg font-semibold mb-2  cursor-pointer">Contact Information</h2>
                            <p class="text-sm hover:text-cyan-600 cursor-pointer">123 ABC Street, XYZ Ward, HCM City</p>
                            <p class="text-sm hover:text-cyan-600 cursor-pointer">Email: example@example.com</p>
                            <p class="text-sm hover:text-cyan-600 cursor-pointer">Phone: 0123 456 789</p>
                        </div>
                        <div class="mb-4 md:mb-0 mx-2  ">
                            <h2 class="text-lg font-semibold mb-2">Links</h2>
                            <ul class="text-sm ">
                                <li><a href="#" class="hover:text-cyan-600 cursor-pointer">Home</a></li>
                                <li><a href="#" class="hover:text-cyan-600 cursor-pointer">Products</a></li>
                                <li><a href="#" class="hover:text-cyan-600 cursor-pointer">Contact</a></li>
                                <li><a href="#" class="hover:text-cyan-600 cursor-pointer">About Us</a></li>
                            </ul>
                        </div>
                        <!-- Support Section -->
                        <div class="mb-4 md:mb-0 mx-2 ">
                            <h2 class="text-lg font-semibold mb-2">Support</h2>
                            <ul class="text-sm">
                                <li><a href="#" class="hover:text-cyan-600 cursor-pointer">FAQs</a></li>
                                <li><a href="#" class="hover:text-cyan-600 cursor-pointer">Contact Us</a></li>
                                <li><a href="#" class="hover:text-cyan-600 cursor-pointer">Shipping Information</a></li>
                                <li><a href="#" class="hover:text-cyan-600 cursor-pointer">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Divider -->
                <hr class="border-gray-200 my-4">
                <!-- Bottom Section -->
                <div class="text-center text-sm text-gray-600 p-2">
                    © 2024 MCK Company. All rights reserved.
                </div>
            </footer>
            
            
            
        </div>
        <script>
             window.addEventListener('scroll', function() {
            const ads = document.querySelectorAll('.ad');
            const maxOffset = 60; // Maximum offset distance in pixels
            ads.forEach(ad => {
                let offset = window.scrollY * 0.1;
                if (offset > maxOffset) {
                    offset = maxOffset;
                }
                ad.style.top = (150 - offset) + 'px'; 
            });
        });
        </script>
    </body>
</html>
