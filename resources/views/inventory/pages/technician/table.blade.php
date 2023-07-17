@forelse($technicians as $key => $technician)
    <tr>
        <td>{{ $technician->name }}</td>
        <td>{{ $technician->email }}</td>
        <td>{{ $technician->contact_number }}</td>
        <td> {{ $technician->dob }} </td>
        <td>{{ $technician->present_address }}</td>
        <td>
            <a href="javascript:void(0)" class="btn btn-sm text-success" onclick="technicianEdit({{ $technician->id }})" title='Edit'>
                <i class="mdi mdi-pencil" style="font-size: 17px"></i>
            </a>

            <a href="javascript:void(0)" class="text-danger btn btn-sm" onclick="technicianDelete({{ $technician->id }})" title='Delete'>
                <i class="mdi mdi-delete" style="font-size: 17px"></i>
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5"><h5 class="text-center text-white">No Data Found</h5></td>
    <tr>
@endforelse
