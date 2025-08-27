@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-6">📊 Analytics Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 shadow rounded">
        <p class="text-gray-500">Total Visits</p>
        <h2 class="text-3xl font-bold">{{ $totalVisits }}</h2>
    </div>
</div>

<div class="bg-white p-4 shadow rounded mb-6">
    <h2 class="text-xl font-bold mb-2">Top Pages</h2>
    <ul class="list-disc pl-6 text-gray-700">
        @foreach($mostVisitedPages as $url)
            <li>{{ $url }}</li>
        @endforeach
    </ul>
</div>

<div class="bg-white p-4 shadow rounded">
    <h2 class="text-xl font-bold mb-2">Visits per Day (Last 7 Days)</h2>
    <ul class="text-gray-700">
        @foreach($visitsPerDay as $v)
            <li>{{ $v->date }}: {{ $v->total }}</li>
        @endforeach
    </ul>
</div>
@endsection
