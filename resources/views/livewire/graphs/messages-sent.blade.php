<div class="bg-white p-5 ml-4 mr-4 shadow-xl rounded" style="width: 26rem">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <h2 class="font-bold pb-3 text-center">Sent Messages</h2>
    <div class="flex flex-row text-center w-full justify-between">
        <div class="flex flex-col">
            <span class="font-bold text-lg text-gray-600">{{ number_format($thisWeek) }}</span>
            <span class="opacity-50">This Week</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold text-lg text-gray-600">{{ number_format($thisYear) }}</span>
            <span class="opacity-50">This Year</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold text-lg text-gray-600">{{ number_format($thisMonth) }}</span>
            <span class="opacity-50">Last Month</span>
        </div>
    </div>

    <canvas id="messagesTrendChart" width="350" class="mt-5" height="300"></canvas>
    <script>
        let ctx2 = document.getElementById('messagesTrendChart').getContext('2d');
        let messagesChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: [{{ $six }}, {{ $five }}, {{ $four }}, {{ $three }}, {{ $two }}, {{ $one }}],
                datasets: [{
                    label: '',
                    data: [{{ $thisYear }}, {{ $lastYear }}, {{ $secondLastYear }}, {{ $thirdLastYear }}, {{ $fourthLastYear }}, {{ $fifthLastYear }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                }
            }
        });
    </script>
</div>
