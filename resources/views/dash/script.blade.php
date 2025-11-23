    <script>
        class ReportsDashboard {
            constructor() {
                this.isSidebarCollapsed = false;
                this.initializeCharts();
                // this.initializeEventListeners();
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
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Revenue',
                            data: [32000, 35000, 38000, 42000, 45000, 48000, 52000, 55000, 58000, 62000, 65000, 68000],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }, {
                            label: 'Target',
                            data: [30000, 33000, 36000, 40000, 43000, 46000, 50000, 53000, 56000, 60000, 63000, 66000],
                            borderColor: '#6b7280',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            fill: false,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false,
                                },
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value.toLocaleString();
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            createCategoryChart() {
                const ctx = document.getElementById('categoryChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Animal Health', 'Crop Protection', 'Feeds & Supplements', 'Farming Equipment'],
                        datasets: [{
                            data: [35, 25, 20, 20],
                            backgroundColor: [
                                '#10b981',
                                '#3b82f6',
                                '#f59e0b',
                                '#8b5cf6'
                            ],
                            borderWidth: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                }
                            }
                        }
                    }
                });
            }
        }

        // Initialize the dashboard when page loads
        document.addEventListener('DOMContentLoaded', function() {
            window.reportsDashboard = new ReportsDashboard();

            // Add fade-in animation to all stat cards
            const cards = document.querySelectorAll('.fade-in');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
