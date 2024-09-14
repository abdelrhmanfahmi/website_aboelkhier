@if(count($query) > 0)
    @foreach ($query as $q)
        <tr>
            <th scope="row">{{ $q->id }}</th>
            <td>{{ $q->reset_client }}</td>
            <td>{{ $q->reset_translation }}</td>
            <td>{{ $q->is_draft == 1 ? 'مكتمل' : 'غير مكتمل' }}</td>
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
            <td class="d-flex">
                @if($q->is_draft == 0)
                    <a href="resets/{{$q->id}}/edit" class="btn btn-success">متابعة عملية إنشاء الفاتورة</a>
                @else
                    <a style="pointer-events: none;" class="btn">متابعة عملية إنشاء الفاتورة</a>
                @endif
                &nbsp;
                <form method="POST" action="resets/{{$q->id}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="">
                        <input type="submit" class="btn btn-danger" value="مسح الفاتورة">
                    </div>
                </form>
            </td>
        </tr>
    @endforeach
@else
    <tr class="text-center"><td colspan="6">لا توجد نتائج</td></tr>
@endif
