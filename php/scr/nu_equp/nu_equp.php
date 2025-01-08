<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .user-info {
            text-align: right;
            margin-bottom: 20px;
        }

        .user-info span {
            font-size: 1.2em;
            color: #007bff;
        }

        .links {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .links a {
            text-decoration: none;
            color: #007bff;
            font-size: 1.1em;
            border: 1px solid #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .links a:hover {
            background-color: #007bff;
            color: white;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f9;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .links {
                flex-direction: column;
                gap: 10px;
            }

            .links a {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
    <div class="container">
        <div class="user-info">
            Welcome, <span>Admin Name</span>
            <a href="../ChangePass.php" style="margin-left: 20px;">Change Password</a>
            <a href="../logout.php">Sign Out</a>
        </div>

        <div class="links">
            <a href="create_new.php">Create New</a>
            <a href="view_page.php">View Page</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sample Item</td>
                    <td>10</td>
                    <td>100.00</td>
                    <td>1,000.00</td>
                    <td>
                        <a href="edit_item.php">Edit</a> |
                        <a href="delete_item.php" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <!-- Additional rows can be dynamically added here -->
            </tbody>
        </table>
    </div>
    <footer>
        &copy; <?php echo date('Y'); ?> Admin Dashboard. All rights reserved.
    </footer>
</body>
</html>
