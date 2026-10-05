<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trường Đại học Xây dựng Hà Nội')</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #333333;
            line-height: 1.6;
        }

        .main-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-area {
            flex-grow: 1;
            width: 100%;
            padding: 40px 30px;
            display: flex;
            gap: 40px;
        }

        /* Nav Sidebar inside content */
        .content-sidebar {
            width: 280px;
            flex-shrink: 0;
        }

        .sidebar-menu-list {
            list-style: none;
            border-top: 1px solid #eee;
        }
        
        .sidebar-menu-list li {
            border-bottom: 1px solid #eee;
        }

        .sidebar-menu-list a {
            display: block;
            padding: 12px 15px;
            text-decoration: none;
            color: #444;
            font-size: 15px;
            transition: all 0.2s;
        }

        .sidebar-menu-list a:hover {
            color: #012b5d;
            background-color: #f8f9fa;
        }

        .sidebar-menu-list .active > a {
            color: #012b5d;
            font-weight: bold;
            background-color: #f1f5f9;
            border-left: 3px solid #012b5d;
        }

        .sidebar-menu-list li i {
            margin-right: 8px;
            color: #999;
            font-size: 12px;
        }

        .main-content {
            flex-grow: 1;
            min-width: 0;
        }

        .list-search {
            margin-bottom: 18px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 3px 12px rgb(15 23 42 / 4%);
        }

        .list-search label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .list-search-controls {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .list-search-options {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 14px;
        }

        .list-search-field {
            min-width: 0;
        }

        .list-search-field label {
            margin-bottom: 5px;
        }

        .list-search input {
            flex: 1;
            min-width: 0;
            min-height: 42px;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            color: #1e293b;
            font-size: 14px;
            transition: border-color .15s, box-shadow .15s;
        }

        .list-search select {
            width: 100%;
            min-height: 42px;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: #fff;
            color: #1e293b;
            font-size: 14px;
        }

        .list-search input::placeholder {
            color: #94a3b8;
        }

        .list-search input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgb(59 130 246 / 15%);
            outline: 0;
        }

        .list-search select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgb(59 130 246 / 15%);
            outline: 0;
        }

        .list-search-button,
        .list-search-clear {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 9px 14px;
            border: 1px solid transparent;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
            transition: background-color .15s, border-color .15s;
        }

        .list-search-button {
            background: #4169f5;
            color: #fff;
        }

        .list-search-button:hover {
            background: #3154d8;
        }

        .list-search-clear {
            border-color: #cbd5e1;
            background: #fff;
            color: #475569;
        }

        .list-search-clear:hover {
            background: #f8fafc;
        }

        .list-search-error {
            margin-top: 7px;
            color: #b91c1c;
            font-size: 13px;
        }

        .list-search-results {
            margin: 0 0 14px;
            color: #475569;
            font-size: 14px;
        }

        .list-search-results strong {
            color: #0f172a;
        }

        .list-search-button:focus-visible,
        .list-search-clear:focus-visible,
        .list-search select:focus-visible {
            outline: 3px solid #93c5fd;
            outline-offset: 2px;
        }

        h1.page-title {
            color: #012b5d;
            font-size: 24px;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
            margin: 0;
            flex-wrap: wrap;
        }
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin: 20px 0;
        }
        .pagination-summary {
            color: #6c757d;
            font-size: 14px;
        }
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #012b5d;
            border-color: #012b5d;
        }
        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }
        .page-link {
            position: relative;
            display: block;
            color: #012b5d;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #dee2e6;
            padding: 8px 12px;
            margin-left: -1px;
            transition: all .2s;
        }
        .page-link:hover {
            z-index: 2;
            color: #011a38;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
        .page-item:first-child .page-link {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }
        .page-item:last-child .page-link {
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }
        p.small.text-muted {
            margin-top: 10px;
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 0;
        }
        .d-flex { display: flex !important; }
        .d-none { display: none !important; }
        .d-sm-none { display: none !important; }
        .d-sm-flex { display: flex !important; }
        .justify-content-between { justify-content: space-between !important; }
        .align-items-center { align-items: center !important; }
        .align-items-sm-center { align-items: center !important; }
        .flex-fill { flex: 1 1 auto !important; }
        .flex-sm-fill { flex: 1 1 auto !important; }
        
        @media (min-width: 576px) {
            .d-sm-none { display: none !important; }
            .d-sm-flex { display: flex !important; }
        }

        @media (max-width: 900px) {
            .content-area {
                gap: 28px;
                padding: 28px 24px;
            }

            .content-sidebar {
                width: 220px;
            }
        }

        @media (max-width: 700px) {
            .content-area {
                flex-direction: column;
                gap: 24px;
                padding: 24px 16px;
            }

            .content-sidebar {
                width: 100%;
            }

            .sidebar-menu-list {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                border-top: 0;
            }

            .sidebar-menu-list a {
                height: 100%;
                padding: 10px 12px;
                font-size: 14px;
            }

            h1.page-title {
                font-size: 21px;
            }

            .list-search-controls {
                align-items: stretch;
                flex-wrap: wrap;
            }

            .list-search input {
                flex-basis: 100%;
            }

            .list-search-options {
                grid-template-columns: 1fr;
                gap: 8px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="main-wrapper">
        <!-- Header (Top, Nav, Breadcrumbs) -->
        @include('partials.header')

        <!-- Content -->
        <main class="content-area">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('partials.footer')
    </div>

    @stack('scripts')
</body>
</html>
