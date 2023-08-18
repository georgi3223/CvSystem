<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="jquery-3.6.4.min.js"></script>
 </head>
 <body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100">
   <nav class="bg-white shadow-sm">
    <div class="container mx-auto px-4">
     <div class="flex justify-between items-center py-2">
      <div>
       <a href="{{ route('cv.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">CVs</a>
       <a href="{{ route('report.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Generate Report</a>
      </div>
     </div>
    </div>
   </nav>
   <main class="py-6"> @yield('content') </main>
  </div>
 </body>
</html>