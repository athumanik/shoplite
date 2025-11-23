<script>
class ReportsDashboard {
    constructor() {
        this.initializeCharts();
    }

    initializeCharts() {
        this.createRevenueChart();
        this.createCategoryChart();
    }

    createRevenueChart() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Collections (TZS)',
                    data: [150000, 180000, 175000, 200000, 220000, 250000, 230000],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' TZS';
                            }
                        }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    createCategoryChart() {
        const ctx = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Cash', 'Mobile Money', 'Card Payments'],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#10b981', '#3b82f6', '#f59e0b'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true }
                    }
                }
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    window.reportsDashboard = new ReportsDashboard();
});
</script>
