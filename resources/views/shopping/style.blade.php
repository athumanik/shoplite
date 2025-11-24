<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #f8fafc;
    }

    .main-content {
        transition: all 0.3s ease;
    }

    .stat-card {
        transition: transform 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
    }

    .table-row:hover {
        background-color: #f9fafb;
    }

    .form-card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }

    .search-dropdown {
        max-height: 300px;
        overflow-y: auto;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .product-option:hover {
        background-color: #f3f4f6;
    }

    .mobile-search-modal {
        background: rgba(0, 0, 0, 0.5);
    }

    @media (max-width: 768px) {
        .stat-card {
            margin-bottom: 1rem;
        }
    }
</style>
