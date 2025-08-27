@extends('admin.layout')

@section('content')
<h1>Admin Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 mt-8">
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
    <canvas id="visitsChart" height="100"></canvas>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('visitsChart').getContext('2d');
const visitsChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($visitsPerDay->pluck('date')->reverse()->values()),
        datasets: [{
            label: 'Visits',
            data: @json($visitsPerDay->pluck('total')->reverse()->values()),
            borderColor: 'rgba(59,130,246,1)',
            backgroundColor: 'rgba(59,130,246,0.1)',
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endpush

<p>Selamat datang di panel admin.</p>
@endsection
