<!DOCTYPE html>
<html>

<head>
    <title>Transaction List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 id="title-transaction">Transaction List</h1>
        <a class="btn btn-success" href="{{ route('home') }}">Back</a>
        <table class="table" id="product-table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                    <th>Transaction Date</th>
                    <th>Created By</th>
                    <th>Created On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var yearMonth = urlParams.get('year_month');
            $("#title-transaction").html(`Transaction List ${yearMonth}`);
            $.ajax({
                url: `/api/list/${yearMonth}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var products = response.data;
                    var tableBody = $('#product-table tbody');

                    $.each(products, function(index, product) {
                        var row = $('<tr></tr>');
                        var status = product.status == 0 ? 'Success' : 'Failed'
                        row.append('<td>' + product.productID + '</td>');
                        row.append('<td>' + product.productName + '</td>');
                        row.append('<td>' + product.amount + '</td>');
                        row.append('<td>' + product.customerName + '</td>');
                        row.append('<td>' + status + '</td>');
                        row.append('<td>' + product.transactionDate + '</td>');
                        row.append('<td>' + product.createBy + '</td>');
                        row.append('<td>' + product.createOn + '</td>');
                        var updateLink =
                            `<td><a class="btn btn-primary" href="{{ route('edit') }}?id=${product.id}">Update</a></td>`;
                        row.append(updateLink);
                        var destroyLink =
                            `<td><a class="btn btn-danger" onclick="deleteProduct(${product.id})">Destroy</a></td>`;
                        row.append(destroyLink);



                        tableBody.append(row);
                    });
                }
            });
        });

        function deleteProduct(productId) {
            $.ajax({
                url: `/api/products/${productId}`,
                method: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    alert('Transaction delete successfully!');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while delete the product. Please try again.');
                }
            });
        }
    </script>
</body>

</html>
