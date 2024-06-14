<!DOCTYPE html>
<html>

<head>
    <title>Redirecting...</title>
</head>

<body>
    
    <form id="redirectForm" method="POST" action="{{ route('transactions.show', $transaction->id) }}">
        @csrf
        <noscript>
            <button type="submit">Click here if you are not redirected</button>
        </noscript>
    </form>
    <script type="text/javascript">
        document.getElementById('redirectForm').submit();
    </script>
</body>

</html>