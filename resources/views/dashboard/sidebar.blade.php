<style>
    /* Sidebar Styles */
    #sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        background: linear-gradient(180deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        color: var(--white);
        transition: all 0.3s ease-in-out;
        position: fixed;
        z-index: 1000;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        display: flex;
        flex-direction: column;
    }

    .sidebar-header {
        padding: 15px 20px;
        background: rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        flex-shrink: 0;
    }

    .sidebar-header h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
        color: var(--white);
    }

    .sidebar-menu-container {
        flex: 1;
        overflow-y: auto;
        padding-bottom: 20px;
    }

    .sidebar-menu {
        padding: 0 10px;
    }

    .sidebar-item {
        padding: 10px 15px;
        display: flex;
        align-items: center;
        color: var(--white);
        text-decoration: none;
        transition: all 0.2s;
        border-radius: 6px;
        margin: 4px 0;
        font-size: 0.9rem;
    }

    .sidebar-item:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .sidebar-item.active {
        background: rgba(255, 255, 255, 0.2);
        border-left: 3px solid var(--accent-yellow);
    }

    .sidebar-item i {
        margin-right: 12px;
        font-size: 1rem;
        width: 20px;
        text-align: center;
    }

    .sidebar-item span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Minimized state */
    #sidebar.minimized {
        width: var(--sidebar-min-width);
    }

    #sidebar.minimized .sidebar-header h3,
    #sidebar.minimized .sidebar-item span {
        display: none;
    }

    #sidebar.minimized .sidebar-item {
        padding: 12px;
        justify-content: center;
    }

    #sidebar.minimized .sidebar-item i {
        margin-right: 0;
        font-size: 1.1rem;
    }

    /* Scrollbar styling */
    .sidebar-menu-container::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-menu-container::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
    }

    .sidebar-menu-container::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .sidebar-menu-container::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>

<!-- Sidebar -->
<div id="sidebar">
    <div class="sidebar-header d-flex justify-content-between align-items-center">
        <h3 class="m-0">AGROVET</h3>
        <button id="sidebarCollapse" class="btn btn-sm btn-glass">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="sidebar-menu-container">
        <div class="sidebar-menu pt-2">
            <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pos.index') }}" target="_blank" rel="noopener noreferrer"
                class="sidebar-item {{ request()->routeIs('pos.index') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart text-yellow-500"></i>
                <span>POS</span>
            </a>

            <a href="{{ route('sales.index') }}"
                class="sidebar-item {{ request()->routeIs('sales.index') ? 'active' : '' }}">
                <i class="fas fa-box-open text-green-400"></i>
                <span>Sales</span>
            </a>


            <a href="{{ route('inventory.index') }}"
                class="sidebar-item {{ request()->routeIs('inventory.index') ? 'active' : '' }}">
                <i class="fas fa-warehouse "></i>
                <span>Inventory</span>
            </a>


        </div>
    </div>
</div>
