@extends('template.app')

@section('page_content')
<div class="container">
    <h1>{{ $page_title }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal Transaksi</th>
                <th>Jumlah Transaksi</th>
                <th>Status Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->created_at }}</td>
                <td>{{ $transaction->total_amount }}</td>
                <td>{{ $transaction->status }}</td>
                <td>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#transactionModal" data-id="{{ $transaction->id }}">Lihat Selengkapnya</button>
                </td>
                @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="transactionDetails"></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#transactionModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var transactionId = button.data('id');

            $.ajax({
                url: '/transactions/' + transactionId,
                method: 'GET',
                success: function(response) {
                    var details = '<ul>';
                    details += '<li>Tanggal: ' + response.created_at + '</li>';
                    details += '<li>Total: ' + response.total_amount + '</li>';
                    details += '<li>Status: ' + response.status + '</li>';
                    details += '<li>Details:</li>';
                    details += '<ul>';
                    response.transaction_details.forEach(function(detail) {
                        details += '<li>Produk: ' + detail.product.name + ' - Jumlah: ' + detail.quantity + ' - Harga: ' + detail.price + '</li>';
                    });
                    details += '</ul>';
                    details += '</ul>';
                    $('#transactionDetails').html(details);
                },
                error: function() {
                    $('#transactionDetails').html('<p>Error loading details</p>');
                }
            });
        });
    });
</script>
@endsection