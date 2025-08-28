<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Inter', sans-serif;
    }

    .sidebar-item {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .sidebar-item:hover {
      transform: translateX(4px);
    }
    .glassmorphism {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .active-menu {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
  <!-- Sidebar -->
  <aside class="fixed left-0 top-0 w-72 h-full gradient-bg shadow-2xl z-40">
    <!-- Logo/Header -->
    <div class="p-8 border-b border-white/20">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center glassmorphism">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <div>
          <h1 class="text-xl font-bold text-white">Admin Panel</h1>
          <p class="text-white/70 text-sm">Management System</p>
        </div>
      </div>
    </div>
    
    <!-- Navigation -->
    <nav class="p-6 space-y-2">
  <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center p-4 rounded-xl text-white/90 hover:bg-white/10 hover:text-white active-menu">
        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-4">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
          </svg>
        </div>
        <div>
          <div class="font-medium">Dashboard</div>
          <div class="text-xs text-white/60">Overview & Analytics</div>
        </div>
      </a>
      
      <a href="{{ route('admin.posts.index') }}" class="sidebar-item flex items-center p-4 rounded-xl text-white/90 hover:bg-white/10 hover:text-white">
        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-4">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
        </div>
        <div>
          <div class="font-medium">Posts</div>
          <div class="text-xs text-white/60">Manage content</div>
        </div>
      </a>

      <a href="{{ route('admin.books.index') }}" class="sidebar-item flex items-center p-4 rounded-xl text-white/90 hover:bg-white/10 hover:text-white">
        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-4">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19.5A2.5 2.5 0 006.5 22h11a2.5 2.5 0 002.5-2.5v-15A2.5 2.5 0 0017.5 2h-11A2.5 2.5 0 004 4.5v15zM8 6h8M8 10h8m-8 4h6"/>
          </svg>
        </div>
        <div>
          <div class="font-medium">Buku</div>
          <div class="text-xs text-white/60">Manajemen buku</div>
        </div>
      </a>

      <!-- TEAM MEMBERS -->
        <a href="{{ route('admin.team-members.index') }}" class="sidebar-item flex items-center p-4 rounded-xl text-white/90 hover:bg-white/10 hover:text-white">
    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-4">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0 0V8a4 4 0 118 0v6m-8 0h8"/>
      </svg>
    </div>
    <div>
      <div class="font-medium">Team Members</div>
      <div class="text-xs text-white/60">Manage team</div>
    </div>
  </a>

      
     <a href="{{ route('admin.tryout-programs.index') }}" class="sidebar-item flex items-center p-4 rounded-xl text-white/90 hover:bg-white/10 hover:text-white">
  <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-4">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
    </svg>
  </div>
  <div>
    <div class="font-medium">Tryout</div>
    <div class="text-xs text-white/60">Manage tryouts</div>
  </div>
</a>

<a href="{{ route('admin.bimbel-programs.index') }}" class="sidebar-item flex items-center p-4 rounded-xl text-white/90 hover:bg-white/10 hover:text-white">
  <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-4">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/>
    </svg>
  </div>
  <div>
    <div class="font-medium">Bimbel</div>
    <div class="text-xs text-white/60">Manage Bimbel Programs</div>
  </div>
</a>


      
      <a href="{{ route('admin.users.index') }}" class="sidebar-item flex items-center p-4 rounded-xl text-white/90 hover:bg-white/10 hover:text-white">
        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-4">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
          </svg>
        </div>
        <div>
          <div class="font-medium">Users</div>
          <div class="text-xs text-white/60">User management</div>
        </div>
      </a>
      

      
      <!-- Logout -->
      <div class="pt-6">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="sidebar-item flex items-center p-4 rounded-xl text-red-300 hover:bg-red-500/10 hover:text-red-200 w-full">
            <div class="w-10 h-10 bg-red-500/10 rounded-lg flex items-center justify-center mr-4">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
              </svg>
            </div>
            <div>
              <div class="font-medium">Logout</div>
              <div class="text-xs text-red-300/60">Sign out</div>
            </div>
          </button>
        </form>
      </div>
    </nav>
    
    <!-- User Profile -->
    <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-white/20">
      <div class="flex items-center space-x-3 glassmorphism p-3 rounded-xl">
        <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-violet-500 rounded-lg flex items-center justify-center">
          <span class="text-white font-medium text-sm">AD</span>
        </div>
        <div class="flex-1">
          <div class="text-white font-medium text-sm">Admin User</div>
          <div class="text-white/60 text-xs">administrator</div>
        </div>
        <button class="text-white/60 hover:text-white">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
          </svg>
        </button>
      </div>
    </div>
  </aside>
  
  <!-- Main Content -->
  <main class="ml-72 p-8">
  @yield('content')
  @stack('scripts')
  </main>
  

</body>
</html>
