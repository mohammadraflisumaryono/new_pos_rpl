@extends('template.app')

@section('page_content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Transaksi</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('transaksis.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <select class="form-control select2" id="user_id" name="user_id">
                    <!-- Options should be populated from the users database -->
                </select>
            </div>
            <div class="mb-3">
                <label for="details" class="form-label">Details</label>
                <table class="table" id="details-table">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Quantity</th>
                            <th>Harga</th>
                            <th>Delivery Method</th>
                            <th>Alamat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="details-body">
                        <tr>
                            <td><select class="form-control select2" name="details[0][product_id]"></select></td>
                            <td><input type="number" class="form-control" name="details[0][quantity]" min="1"></td>
                            <td><input type="number" class="form-control" name="details[0][harga]" step="0.01"></td>
                            <td>
                                <select class="form-control" name="details[0][delivery_method]">
                                    <option value="pickup">Pickup</option>
                                    <option value="delivery">Delivery</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control" name="details[0][alamat]"></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-success btn-sm add-row">Add Detail</button>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();

        var detailIndex = 1;
        $('.add-row').on('click', function() {
            var newRow = `
                <tr>
                    <td><select class="form-control select2" name="details[${detailIndex}][product_id]"></select></td>
                    <td><input type="number" class="form-control" name="details[${detailIndex}][quantity]" min="1"></td>
                    <td><input type="number" class="form-control" name="details[${detailIndex}][harga]" step="0.01"></td>
                    <td>
                        <select class="form-control" name="details[${detailIndex}][delivery_method]">
                            <option value="pickup">Pickup</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="details[${detailIndex}][alamat]"></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                </tr>
            `;
            $('#details-body').append(newRow);
            $('.select2').select2();
            detailIndex++;
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endsection