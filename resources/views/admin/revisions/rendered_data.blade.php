@foreach ($query as $q)
    <tr>
        <th scope="row">{{ $q->id }}</th>
        <td>{{ $q->reset_client }}</td>
        <td>{{ $q->reset_translation }}</td>
        <td>
            @if($q->is_revised == 1)
                <i class="fa fa-check" style="color: green;"></i>
            @elseif($q->is_revised == 2)
                <i class="fa fa-check" style="color: green;"></i><i class="fa fa-check" style="color: green;"></i>
            @elseif($q->is_revised == 3)
                <i class="fa fa-times" style="color: red;"></i>
            @else
                <p>لم ترسل للمراجع بعد</p>
            @endif
        </td>
        <td>
            <a href="/show/revise/page/{{$q->id}}" class="btn btn-success">مراجعة</a>
        </td>
    </tr>
@endforeach
