    <script>
        class Dashboard {
            constructor() {
                this.isSidebarCollapsed = false;
                this.initializeEventListeners();
            }

            initializeEventListeners() {
                // Sidebar toggle
                document.getElementById('sidebar-toggle').addEventListener('click', () => this.toggleSidebar());
            }

            toggleSidebar() {
                const sidebar = document.querySelector('.sidebar');
                const mainContent = document.querySelector('.main-content');
                const toggleIcon = document.querySelector('#sidebar-toggle i');

                this.isSidebarCollapsed = !this.isSidebarCollapsed;

                sidebar.classList.toggle('collapsed');

                if (this.isSidebarCollapsed) {
                    toggleIcon.className = 'fas fa-chevron-right text-gray-600 text-xs';
                } else {
                    toggleIcon.className = 'fas fa-chevron-left text-gray-600 text-xs';
                }
            }
        }


        // Initialize the dashboard when page loads
        document.addEventListener('DOMContentLoaded', function() {
            window.dashboard = new Dashboard();

        });
    </script>
