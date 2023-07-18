@forelse($customers as $customer)
    <tr>
        <td>{{ $customer->name }}</td>
        <td>{{ $customer->mobile }}</td>
        <td>
            @if($customer->email == null)
                N/A
            @else
                {{ $customer->email }}
            @endif
        </td>
        <td>{{  $customer->dob }}</td>
        <td>
            <a href="javascript:void(0)" class="btn btn-sm text-success" onclick="editcustomer({{ $customer->id }})" title='Edit'>
                <i class="mdi mdi-pencil" style="font-size: 17px"></i>
            </a>

            <a href="javascript:void(0)" class="text-danger btn btn-sm" onclick="deletecustomer({{ $customer->id }})" title='Delete'>
                <i class="mdi mdi-delete" style="font-size: 17px"></i>
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5"><h5 class="text-center text-white">No Data Found</h5></td>
    <tr>
@endforelse
