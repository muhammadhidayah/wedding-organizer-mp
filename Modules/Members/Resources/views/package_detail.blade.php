<table class="table">
    <tbody>
        <tr>
            <td>Package Name</td>
            <td>:</td>
            <td>
                {{ $package->title_package}}
            </td>
        </tr>
        <tr>
            <td>Price</td>
            <td>:</td>
            <td>
                Rp. {{ $package->price_package }}
            </td>
        </tr>
        <tr>
            <td>Down Payment</td>
            <td>:</td>
            <td>
                {{ $package->dropdown_paymenl_val }}% - (Rp. {{ $dp_in_idr }})
            </td>
        </tr>
        <tr>
            <td>Description</td>
            <td>:</td>
            <td>
                {{ $package->detail_package}}
            </td>
        </tr>
    </tbody>
</table>