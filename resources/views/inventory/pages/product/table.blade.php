@forelse($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->model }}</td>
        {{-- <td>{{ $product->description }}</td> --}}
        <td>
            <a href="javascript:void(0)" class="btn btn-sm text-success" onclick="editProduct({{ $product->id }})" title='Edit'>
                <i class="mdi mdi-pencil" style="font-size: 17px"></i>
            </a>

            <a href="javascript:void(0)" class="text-danger btn btn-sm" onclick="deleteProduct({{ $product->id }})" title='Delete'>
                <i class="mdi mdi-delete" style="font-size: 17px"></i>
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5"><h5 class="text-center text-white">No Data Found</h5></td>
    <tr>
@endforelse
