@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
    role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif

@if (session('error'))
<div class="bg-red-100 border-red-400 text-red-600 p-4 mb-4 rounded">
    {{ session('error') }}
</div>
@endif