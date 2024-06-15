@extends('template.app')

@section('page_content')
<div class="container">

    <table id="transactions_table" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Delivery Type</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Service Fee</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>Rp. {{ number_format($transaction->total_amount) }}</td>
                <td>
                    @php
                    $statusClass = '';
                    switch(strtolower($transaction->status)) {
                    case 'completed':
                    $statusClass = 'badge badge-success';
                    break;
                    case 'pending':
                    $statusClass = 'badge badge-primary';
                    break;
                    case 'canceled':
                    $statusClass = 'badge badge-danger';
                    break;
                    case 'ready':
                    $statusClass = 'badge badge-warning';
                    break;
                    case 'on delivery':
                    $statusClass = 'badge badge-info';
                    break;



                    default:
                    $statusClass = 'badge badge-secondary';
                    }
                    @endphp
                    <span class="{{ $statusClass }}">{{ ucfirst($transaction->status) }}</span>
                </td>
                <td>{{ str_replace('_', ' ', ucfirst($transaction->delivery_type)) }}</td>
                <td>{{ $transaction->address ?? 'N/A' }}</td>
                <td>{{ $transaction->phone_number }}</td>
                <td>Rp. {{ number_format($transaction->service_fee) }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>
                    <button class="btn sm btn-primary edit-status-btn" data-id="{{ $transaction->id }}">Status</button>
                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusModalLabel">Edit Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editStatusForm">
                    @csrf
                    <input type="hidden" name="transaction_id" id="transaction_id">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Completed">Completed</option>
                            <option value="Pending">Pending</option>
                            <option value="Ready">Ready</option>
                            <option value="On Delivery">On Delivery</option>
                            <option value="cancel">Cancel</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveStatusBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#transactions_table').DataTable();

        // Handle edit status button click
        $('.edit-status-btn').on('click', function() {
            var transactionId = $(this).data('id');
            $.get('{{ url("/transactions") }}/' + transactionId + '/edit-status', function(data) {
                $('#transaction_id').val(data.id);
                $('#status').val(data.status);
                $('#editStatusModal').modal('show');
            });
        });

        // Handle save changes button click
        $('#saveStatusBtn').on('click', function() {
            var formData = $('#editStatusForm').serialize();
            var transactionId = $('#transaction_id').val();
            $.post('{{ url("/transactions") }}/' + transactionId + '/update-status', formData, function(response) {
                location.reload();
            });
        });
    });
</script>
@endsection