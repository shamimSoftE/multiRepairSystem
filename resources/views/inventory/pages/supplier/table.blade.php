@forelse($suppliers as $key => $supplier)
    <tr>
        <td>{{ $supplier->name }}</td>
        <td>{{ $supplier->address }}</td>
        <td> {{ $supplier->mobile }} </td>
        <td> {{ $supplier->opening_balance }}৳ </td>
        <td>
            <a href="javascript:void(0)" class="btn btn-sm text-success" onclick="supplierEdit({{ $supplier->id }})" title='Edit'>
                <i class="mdi mdi-pencil" style="font-size: 17px"></i>
            </a>

            <a href="javascript:void(0)" class="text-danger btn btn-sm" onclick="supplierDelete({{ $supplier->id }})" title='Delete'>
                <i class="mdi mdi-delete" style="font-size: 17px"></i>
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5"><h5 class="text-center text-white">No Data Found</h5></td>
    <tr>
@endforelse
