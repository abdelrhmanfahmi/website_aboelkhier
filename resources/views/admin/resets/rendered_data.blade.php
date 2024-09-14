@if(count($query) > 0)
    @foreach ($query as $q)
        <tr>
            <th scope="row">{{ $q->id }}</th>
            <td>{{ $q->reset_client }}</td>
            <td>{{ $q->reset_translation }}</td>
            <td>{{ $q->is_draft == 1 ? 'مكتملة' : 'غير مكتملة' }}</td>
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
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu">
                            <li><a href="/resets/{{$q->id}}/print" class="dropdown-item">طباعة الفاتورة احتياطي</a></li>
                            &nbsp;
                            @if($q->reset_cost_not_paid == 0)
                                <li><a href="/resets/{{$q->id}}/print" class="dropdown-item">طباعة الفاتورة للعميل</a></li>
                            @else
                                <li><a href="/reset/check/payed/{{ $q->id }}" class="dropdown-item">طباعة الفاتورة للعميل</a></li>
                            @endif
                            &nbsp;
                            <li><a href="/resets/{{$q->id}}/printForSystem" class="dropdown-item">طباعة الفاتورة للشركة</a></li>
                            &nbsp;
                            <li><a href="/resets/{{$q->id}}/edit" class="btn btn-success dropdown-item">تعديل الفاتورة</a></li>
                            &nbsp;
                            <li><a data-id="{{ $q->id }}" class="btn btn-primary copyReset dropdown-item">نسخ الفاتورة</a></li>

                            &nbsp;

                            <li>
                                <form method="POST" action="resets/{{$q->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <div class="">
                                        <input type="submit" class="btn btn-danger dropdown-item" value="مسح الفاتورة">
                                    </div>
                                </form>
                            </li>

                            &nbsp;

                            @if ($q->is_revised == 0 && $q->is_draft == 0)
                                <li><a class="btn btn-secondary disabledLink dropdown-item" >هذه الفاتورة لم يتم استكمالها</a></li>
                            @elseif($q->is_revised == 0 && $q->is_draft == 1)
                                <li><a data-id="{{ $q->id }}" class="btn btn-warning SendRevise dropdown-item">مراجعة</a></li>
                            @elseif($q->is_revised == 3)
                                <li><a href="/show/reset/reason/{{ $q->id }}" class="dropdown-item">تم استرحعها من المراجع</a></li>
                            @else
                                <li><a href="/reset/check/payed/{{ $q->id }}" class="btn btn-secondary dropdown-item" >جاهزة للاستلام</a></li>
                            @endif

                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr class="text-center"><td colspan="6"></td></tr>
@endif
