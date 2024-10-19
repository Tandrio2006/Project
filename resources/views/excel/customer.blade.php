<table>
    <thead>
        <tr>
            <th style="text-align:center;font-size:11px;border:1px solid black; font-weight: bold; padding: 20px; white-space: normal; color:white;"
                bgcolor="#436850">Username</th>
            <th style="text-align:center;font-size:11px;border:1px solid black; font-weight: bold; padding: 20px; white-space: normal; color:white;"
                bgcolor="#436850">Email</th>
            <th style="text-align:center;font-size:11px;border:1px solid black; font-weight: bold; padding: 20px; white-space: normal; color:white;"
                bgcolor="#436850">Wa</th>
            <th style="text-align:center;font-size:11px;border:1px solid black; font-weight: bold; padding: 20px; white-space: normal; color:white;"
                bgcolor="#436850">Bank</th>
            <th style="text-align:center;font-size:11px;border:1px solid black; font-weight: bold; padding: 20px; white-space: normal; color:white;"
                bgcolor="#436850">Nama Rek</th>
            <th style="text-align:center;font-size:11px;border:1px solid black; font-weight: bold; padding: 20px; white-space: normal; color:white;"
                bgcolor="#436850">No Rek</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customer as $customers)
            <tr>
                <td  style="text-align:left;font-size:11px;border:1px solid black; padding: 20px">{{ $customers->Username }}</td>
                <td  style="text-align:left;font-size:11px;border:1px solid black; padding: 20px">{{ $customers->Email }}</td>
                <td  style="text-align:left;font-size:11px;border:1px solid black; padding: 20px">{{ $customers->Wa }}</td>
                <td  style="text-align:left;font-size:11px;border:1px solid black; padding: 20px">{{ $customers->Bank }}</td>
                <td  style="text-align:left;font-size:11px;border:1px solid black; padding: 20px">{{ $customers->NamaRek }}</td>
                <td  style="text-align:left;font-size:11px;border:1px solid black; padding: 20px">{{ $customers->NoRek }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
