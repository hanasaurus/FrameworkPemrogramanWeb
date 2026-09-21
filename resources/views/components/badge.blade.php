@props(['status'])

@if ($status == 'Aman')
    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
        Aman
    </span>
@elseif ($status == 'Menipis')
    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">
        Menipis
    </span>
@elseif ($status == 'Habis')
    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">
        Habis
    </span>
@endif