<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Heroicons CDN -->
  <script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>
</head>
<body class="bg-gray-100 font-sans flex min-h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800 text-white flex flex-col">
    <div class="p-6 text-2xl font-bold border-b border-gray-700">
      Admin Panel
    </div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18"/>
        </svg>
        Dashboard
      </a>
      <a href="{{ route('posts.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        Posts
      </a>
      <a href="#" class="flex items-center p-2 rounded hover:bg-gray-700">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M12 9v6"/>
        </svg>
        Add Post
      </a>
      <!-- Tambahkan menu lain sesuai kebutuhan -->
    </nav>
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-6">
    @yield('content')
  </main>

</body>
</html>
