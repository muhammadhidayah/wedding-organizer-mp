<table class="table">
    <thead>

    </thead>
    <tbody>
        <tr>
            <td>INV. Number</td>
            <td>:</td>
            <td>{{ $order->inv_number }}</td>
        </tr>
        <tr>
            <td>Customer Name</td>
            <td>:</td>
            <td>{{ $order->user->name }}</td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td>:</td>
            <td>{{ $order->user->email}}</td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>:</td>
            <td>{{ $order->user->mobile_phone }}</td>
        </tr>
        <tr>
            <td>Vendor</td>
            <td>:</td>
            <td>{{ $order->package->vendor->vendor_name }}</td>
        </tr>
        <tr>
            <td>Package</td>
            <td>:</td>
            <td>{{ $order->package->title_package }}</td>
        </tr>
        <tr>
            <td>Payment Status</td>
            <td>:</td>
            <td>{{ $order->payment_status }}</td>
        </tr>
        <tr>
            <td>Price</td>
            <td>:</td>
            <td>Rp. {{ $order->total_price }}</td>
        </tr>
    </tbody>
</table>