
 <!-- Custom JS -->
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         // Initialize AOS animation
         AOS.init({
             duration: 800,
             easing: 'ease-in-out',
             once: true
         });

         // Toggle sidebar
         const sidebar = document.getElementById('sidebar');
         const content = document.getElementById('content');
         const navbar = document.getElementById('navbar');
         const sidebarCollapse = document.getElementById('sidebarCollapse');
         const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');

         // Desktop toggle
         sidebarCollapse.addEventListener('click', function() {
             sidebar.classList.toggle('minimized');
             content.classList.toggle('minimized');
             navbar.classList.toggle('minimized');
         });

         // Mobile toggle
         mobileSidebarToggle.addEventListener('click', function() {
             sidebar.classList.toggle('show');
         });

         // Close sidebar when clicking outside on mobile
         content.addEventListener('click', function() {
             if (window.innerWidth < 768 && sidebar.classList.contains('show')) {
                 sidebar.classList.remove('show');
             }
         });

         // Responsive behavior
         function handleResponsive() {
             if (window.innerWidth >= 768) {
                 sidebar.classList.remove('show');
             }
         }

         window.addEventListener('resize', handleResponsive);
         handleResponsive();

         // Add active class to clicked sidebar items
         const sidebarItems = document.querySelectorAll('.sidebar-item:not(.dropdown-toggle)');
         sidebarItems.forEach(item => {
             item.addEventListener('click', function() {
                 sidebarItems.forEach(i => i.classList.remove('active'));
                 this.classList.add('active');
             });
         });
     });
 </script>
