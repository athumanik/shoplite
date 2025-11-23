    @php
       if (!Auth::check()) {
            return redirect(route('login'));
        }

        $user = Auth::user();
    @endphp
    <div class="border-t border-gray-200 p-4">
        <div class="flex items-center">
            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">

                <span class="text-green-600 font-medium text-sm">{{ $user->initials }}</span>
            </div>
            <div class="ml-3 sidebar-text">
                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                <div class="text-xs text-gray-500">Wholesale {{ $user->role_title }}</div>
            </div>
        </div>
    </div>
