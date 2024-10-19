<table>
    <thead>
        <tr>
            <th style="text-align:center;font-size:11px;border:1px solid black; font-weight: bold; padding: 20px; white-space: normal; color:white;"
                bgcolor="#436850">Name</th>
            <th style="text-align:center;font-size:11px;border:1px solid black; font-weight: bold; padding: 20px; white-space: normal; color:white;"
                bgcolor="#436850">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admin as $admins)
            <tr>
                <td  style="text-align:left;font-size:11px;border:1px solid black; padding: 20px">{{ $admins->name }}</td>
                <td  style="text-align:left;font-size:11px;border:1px solid black; padding: 20px">{{ $admins->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
