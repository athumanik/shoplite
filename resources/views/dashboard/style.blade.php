 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Font Awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
 <!-- AOS Animation -->
 <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
 <!-- Custom CSS -->
 <style>
     :root {
         --sidebar-width: 250px;
         --sidebar-min-width: 80px;
         --primary-blue: #1a73e8;
         --light-blue: #4285f4;
         --dark-blue: #0d47a1;
         --accent-yellow: #fbbc05;
         --light-yellow: #fff3c4;
         --white: #ffffff;
         --glass-bg: rgba(255, 255, 255, 0.85);
         --glass-border: 1px solid rgba(255, 255, 255, 0.18);
     }

     body {
         overflow-x: hidden;
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
         background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
     }

     /* Sidebar Styles */
     #sidebar {
         width: var(--sidebar-width);
         min-height: 100vh;
         background: linear-gradient(180deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
         color: var(--white);
         transition: all 0.3s ease-in-out;
         position: fixed;
         z-index: 1000;
         box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
         backdrop-filter: blur(4px);
         -webkit-backdrop-filter: blur(4px);
     }

     #sidebar.minimized {
         width: var(--sidebar-min-width);
         text-align: center;
     }

     #sidebar.minimized .sidebar-header h3,
     #sidebar.minimized .sidebar-item span,
     #sidebar.minimized .dropdown-toggle::after {
         display: none;
     }

     #sidebar.minimized .sidebar-item {
         padding: 15px 10px;
         justify-content: center;
     }

     #sidebar.minimized .sidebar-item i {
         margin-right: 0;
         font-size: 1.2rem;
     }

     .sidebar-header {
         padding: 20px;
         background: rgba(0, 0, 0, 0.1);
         border-bottom: 1px solid rgba(255, 255, 255, 0.1);
     }

     .sidebar-header h3 {
         font-weight: 600;
         color: var(--white);
         margin: 0;
     }

     .sidebar-item {
         padding: 12px 20px;
         display: flex;
         align-items: center;
         color: var(--white);
         text-decoration: none;
         transition: all 0.2s;
         border-left: 3px solid transparent;
         margin: 2px 10px;
         border-radius: 6px;
     }

     .sidebar-item:hover {
         background: rgba(255, 255, 255, 0.15);
         color: var(--white);
     }

     .sidebar-item.active {
         background: rgba(255, 255, 255, 0.2);
         border-left: 3px solid var(--accent-yellow);
         color: var(--white);
     }

     .sidebar-item i {
         margin-right: 12px;
         font-size: 1.1rem;
         width: 20px;
         text-align: center;
     }

     .sidebar-dropdown {
         padding-left: 20px;
         background: rgba(0, 0, 0, 0.1);
         display: none;
         border-radius: 0 0 6px 6px;
         margin: 0 10px 5px 10px;
     }

     .sidebar-dropdown.show {
         display: block;
         animation: fadeIn 0.3s ease-in-out;
     }

     .dropdown-toggle {
         position: relative;
     }

     .dropdown-toggle::after {
         /* content: '+'; */
         position: absolute;
         right: 20px;
         transition: transform 0.3s;
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
         font-weight: bold;
     }

     .dropdown-toggle[aria-expanded="true"]::after {
         /* content: '-'; */
     }

     /* Navbar Styles */
     #navbar {
         padding: 10px 25px;
         background: var(--glass-bg);
         box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
         position: fixed;
         left: var(--sidebar-width);
         right: 0;
         z-index: 100;
         transition: all 0.3s;
         backdrop-filter: blur(5px);
         -webkit-backdrop-filter: blur(5px);
         border-bottom: var(--glass-border);
     }

     #navbar.minimized {
         left: var(--sidebar-min-width);
     }

     .profile-img {
         width: 36px;
         height: 36px;
         border-radius: 50%;
         object-fit: cover;
         border: 2px solid var(--light-blue);
     }

     .dropdown-menu {
         border: none;
         box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
         border-radius: 10px;
         overflow: hidden;
     }

     a,
     .nav-link,
     .sidebar-item {
         text-decoration: none !important;
     }

     .dropdown-toggle::after {
         content: none !important;
     }

     .dropdown-item {
         padding: 8px 16px;
         transition: all 0.2s;
     }

     .dropdown-item:hover {
         background: linear-gradient(to right, var(--light-blue), var(--primary-blue));
         color: white !important;
     }

     /* Content Styles */
     #content {
         margin-left: var(--sidebar-width);
         padding: 25px;
         padding-top: 80px;
         min-height: 100vh;
         transition: all 0.3s;
     }

     #content.minimized {
         margin-left: var(--sidebar-min-width);
     }

     .card {
         border-radius: 12px;
         box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
         margin-bottom: 25px;
         border: none;
         overflow: hidden;
         background: var(--glass-bg);
         backdrop-filter: blur(5px);
         -webkit-backdrop-filter: blur(5px);
         border: var(--glass-border);
     }

     .card-header {
         background: linear-gradient(to right, var(--primary-blue), var(--light-blue));
         color: white;
         border-bottom: none;
         padding: 15px 20px;
     }

     .card-body {
         padding: 20px;
     }

     /* Stats Cards */
     .stat-card {
         border-radius: 12px;
         overflow: hidden;
         color: white;
         position: relative;
         z-index: 1;
         transition: transform 0.3s;
     }

     .stat-card:hover {
         transform: translateY(-5px);
     }

     .stat-card::before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
         z-index: -1;
     }

     .stat-card.blue {
         background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
     }

     .stat-card.yellow {
         background: linear-gradient(135deg, var(--accent-yellow) 0%, #fdd663 100%);
     }

     .stat-card.white {
         background: linear-gradient(135deg, var(--white) 0%, #f1f3f4 100%);
         color: var(--dark-blue);
     }

     /* Table Styles */
     .table {
         border-collapse: separate;
         border-spacing: 0;
     }

     .table thead th {
         background: linear-gradient(to right, var(--primary-blue), var(--light-blue));
         color: white;
         border: none;
         padding: 12px 15px;
     }

     .table tbody tr {
         transition: all 0.2s;
     }

     .table tbody tr:hover {
         background: rgba(66, 133, 244, 0.05);
     }

     .badge {
         padding: 6px 10px;
         font-weight: 500;
         border-radius: 20px;
     }

     .btn-glass {
         background: rgba(255, 255, 255, 0.2);
         backdrop-filter: blur(5px);
         -webkit-backdrop-filter: blur(5px);
         border: 1px solid rgba(255, 255, 255, 0.3);
         color: white;
         transition: all 0.3s;
     }

     .btn-glass:hover {
         background: rgba(255, 255, 255, 0.3);
         color: white;
     }

     /* Animations */
     @keyframes fadeIn {
         from {
             opacity: 0;
             transform: translateY(-10px);
         }

         to {
             opacity: 1;
             transform: translateY(0);
         }
     }

     /* Responsive Styles */
     @media (max-width: 768px) {
         #sidebar {
             margin-left: -250px;
         }

         #sidebar.minimized {
             margin-left: -80px;
         }

         #sidebar.show {
             margin-left: 0;
         }

         #navbar {
             left: 0;
         }

         #content {
             margin-left: 0;
         }

         #sidebarCollapse {
             display: block;
         }
     }
 </style>
