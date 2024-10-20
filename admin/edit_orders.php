<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shine Cosmetic - Cart</title>

    <!-- jQuery and DataTables for table management -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/admin/dataTables.dataTables.css">
    <script src="https://cdn.datatables.net/2.1.7/admin/dataTables.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
        }

        h1 {
            color: #ec407a;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn-warning {
            background-color: #ff9800 !important;
            border-color: #fb8c00;
        }

        .btn-danger {
            background-color: #e53935 !important;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .product-image {
            max-height: 120px;
        }

        .category-filter {
            max-width: 200px;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();

            $('#category').change(function () {
                var categoryId = $(this).val();
                $('#myTable tbody tr').each(function () {
                    var rowCategoryId = $(this).data('category-id');
                    if (categoryId) {
                        $(this).toggle(rowCategoryId == categoryId);
                    } else {
                        $(this).show();
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <a href="type.php" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-square-fill"></i> Back
                </a>
                <select id="category" class="form-select category-filter">
                    <option value="">All Categories</option>
                    <?php
                    include_once("connectdb.php");
                    $sql2 = "SELECT * FROM `category` ORDER BY c_name ASC";
                    $rs2 = mysqli_query($conn, $sql2);
                    while ($data2 = mysqli_fetch_array($rs2)) {
                        echo '<option value="'.$data2['c_id'].'">'.$data2['c_name'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <center>
            <img src="../admin/459176263_518078740831527_7142297360152062850_n.jpg" alt="Logo" class="mb-3" width="200" height="200">
            <h1>ShineCosmetics</h1>
        </center>

        <table id="myTable" class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Picture</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Detail</th>
                    <th>Price</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM product ORDER BY p_id ASC";
                $rs = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_array($rs)) {
                    echo '<tr data-category-id="'.$data['c_id'].'">';
                    echo '<td><a href="update.php?pid='.$data['p_id'].'" class="btn btn-warning btn-sm"><i class="bi bi-pen"></i> Edit</a></td>';
                    echo '<td><a href="delete.php?pid='.$data['p_id'].'&ext='.$data['p_picture'].'" onclick="return confirm(\'Are you sure you want to delete?\');" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</a></td>';
                    echo '<td><img src="images/'.$data['p_id'].'.'.$data['p_picture'].'" class="img-thumbnail product-image"></td>';
                    echo '<td>'.$data['p_id'].'</td>';
                    echo '<td>'.$data['p_name'].'</td>';
                    echo '<td>'.$data['p_detail'].'</td>';
                    echo '<td>฿'.$data['p_price'].'</td>';
                    echo '<td>'.$data['c_id'].'</td>';
                    echo '</tr>';
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
