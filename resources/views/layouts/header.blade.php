<header class="bg-white shadow">
    <div class="container mx-auto px-8 py-4 flex justify-between items-center">
        <a href="/projects" class="text-xl font-bold text-gray-800">DevTask Hub</a>
        <nav class="flex items-center gap-4">
            <a href="/organisations" class="text-sm font-semibold {{ request()->is('organisations') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                Organisation
            </a>
            <a href="/projects" class="text-sm font-semibold {{ request()->is('projects') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                Projects
            </a>
            <a href="/dashboard" class="text-sm font-semibold {{ request()->is('dashboard') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                Dashboard
            </a>
            <a href="/projects/create" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 font-semibold text-sm shadow">
                + New Project
            </a>
        </nav>
    </div>
</header>
