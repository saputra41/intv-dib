<!DOCTYPE html>
<html>

<head>
    <title>Edit Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Edit Transaction</h1>
        <a class="btn btn-success" href="{{ route('home') }}">Back</a>
        <form id="editProductForm">
            <div class="mb-3">
                <label for="productID" class="form-label">Product ID</label>
                <input type="text" class="form-control" id="productID" name="productID" required>
            </div>
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" required>
            </div>
            <div class="mb-3">
                <label for="customerName" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customerName" name="customerName" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="0">Success</option>
                    <option value="1">Failed</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="transactionDate" class="form-label">Transaction Date</label>
                <input type="datetime-local" class="form-control" id="transactionDate" name="transactionDate" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var id = urlParams.get('id');
            $.ajax({
                url: `/api/products/${id}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#productID').val(response.data.productID);
                    $('#productName').val(response.data.productName);
                    $('#amount').val(response.data.amount);
                    $('#customerName').val(response.data.customerName);
                    $('#status').val(response.data.status);
                    var transactionDate = new Date(response.data.transactionDate);
                    var formattedDate = transactionDate.toISOString().slice(0, 16);
                    $('#transactionDate').val(formattedDate);
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while fetching the product data. Please try again.');
                }
            });

            $('#editProductForm').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: `/api/products/${id}`, // Ganti dengan URL yang sesuai untuk API update
                    method: 'PUT',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        alert('Product updated successfully!');
                        window.location.href = '/';
                    },
                    error: function(xhr, status, error) {
                        alert(
                            'An error occurred while updating the product. Please try again.'
                        );
                    }
                });
            });
        });
    </script>
</body>

</html>
