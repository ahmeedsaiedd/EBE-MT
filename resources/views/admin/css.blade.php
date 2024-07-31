<head>
    <link rel="icon" type="image/x-icon" href="resources\favicon.png">

    <style>
        
        .dropdown-menu {
            display: none;
        }

        .dropdown-menu.block {
            display: block;
        }

        #checkbox-form-modal {
            display: none;
        }
         <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EBE-MT Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }

        .btn-toggle.active {
            color: #4A5568;
            /* Tailwind's `text-gray-800` */
            background-color: #E2E8F0;
            /* Tailwind's `bg-gray-100` */
            border-left: 4px solid #4A5568;
            /* Highlight active button */
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 90;
            margin-top: 0.5rem;
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 0.375rem;
            width: 12rem;
            z-index: 50;
        }

        .dropdown-menu.show {
            display: block;
        }

        .btn-toggle.active {
            color: #4A5568;
            /* Tailwind's `text-gray-800` */
            background-color: #E2E8F0;
            /* Tailwind's `bg-gray-100` */
            border-left: 4px solid #4A5568;
            /* Highlight active button */
        }

        /* Hide modal by default */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            align-items: center;
            justify-content: center;
        }

        /* Modal content styling */
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 600px;
            /* Adjust width as needed */
            height: 600;
        }
    </style>
    </style>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EBE Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="admin/assets/css/tailwind.output.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
</head>