<table class="table">
    <tr>
        <td>INV. Number</td>
        <td>:</td>
        <td>{{ $order->inv_number }}</td>
    </tr>
    <tr>
        <td>Client Name</td>
        <td>:</td>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <td>Client Phone</td>
        <td>:</td>
        <td>{{ $user->mobile_phone }}</td>
    </tr>
    <tr>
        <td>Client Email</td>
        <td>:</td>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <td>Package</td>
        <td>:</td>
        <td>{{ $package->title_package }}</td>
    </tr>
    <tr>
        <td>Wedding Date</td>
        <td>:</td>
        <td>{{ $order->wedding_date }}</td>
    </tr>
    <tr>
        <td>Price</td>
        <td>:</td>
        <td>Rp. {{ $order->total_price }}</td>
    </tr>
</table>