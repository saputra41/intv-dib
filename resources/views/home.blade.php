<!DOCTYPE html>
<html>

<head>
    <title>Transaction List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Transaction List</h1>
        <a class="btn btn-success" href="{{ route('create') }}">Add Transaction</a>
        <table class="table" id="product-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Transaction Date</th>
                    <th>Total Transaction</th>
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
            $.ajax({
                url: '/api/products',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var products = response.data;
                    var tableBody = $('#product-table tbody');
                    var number = 1;
                    $.each(products, function(index, product) {
                        var row = $('<tr></tr>');

                        row.append(`<td>${number++}</td>`);
                        row.append(`<td>${product.tanggal}</td>`);
                        row.append(`<td>${product.total}</td>`);
                        var detailLink =
                            `<td><a class="btn btn-info" href="{{ route('list') }}?year_month=${product.tanggal}">Detail</a></td>`;
                        row.append(detailLink);

                        tableBody.append(row);
                    });
                }
            });
        });
    </script>
</body>

</html>
