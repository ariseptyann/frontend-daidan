<table class="table hoverable">
    <thead>
        <tr>
            <th class="sgx-w-100">Name</th>
            <th class="sgx-w-50">Status</th>
            <th class="sgx-w-50">NIK</th>
            <th class="sgx-w-50">Joined</th>
            <th class="sgx-w-50">Srv Year</th>
            <th class="sgx-w-50">Company</th>
            <th class="sgx-w-100">Department</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data->data as $item)
            <tr>
                <td>
                    <div class="one-line text-nowrap d-block" style="cursor: pointer">
                        <img src="{{ asset('img/initials/1_a.png') }}" class="thumb s15 round">
                        <a data-href="{{route('employee.show', $item->id)}}" data-id="{{$item->id}}" id="detailEmployee" style="color: #007bff">{{$item->name}}</a>
                    </div>
                </td>
                @if ($item->status == 'active')
                    <td class="text-center bg-light-blue">{{strtoupper($item->status)}}</td>
                @else
                <td class="text-center bg-light-red">{{strtoupper($item->status)}}</td>
                @endif
                <td>{{$item->nik}}</td>
                <td>{{$item->join_date}}</td>
                <td>
                    @php
                        $time = \Carbon\Carbon::now()->diff($item->join_date);
                    @endphp
                    <img class="inline-icon" src="{{ asset('icons/clock-dark.svg ') }}"> {{ $time->y . 'y ' . $time->m . 'm'}}
                </td>
                <td>{{$item->company->name}}</td>
                <td>{{$item->departement->name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="info">
    <em>Showing {{$current_page}} to {{$last_page}} of {{$total}} entries</em>
</div>
@if ($data->last_page > 1)
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-right pagination-separate pagination-round pagination-flat">
            {!! getPrevious($data->current_page, $data->current_page-1 ) !!}
            @php
                $no = 1;
            @endphp
            @if ($data->current_page > 2 )
                <li class="page-item">
                    <a href="javascript:void(0)" class="page-link paginate" data-page="{{ '1' }}">1</a>
                </li>
            @endif
            @if($data->current_page > 3)
                <li class="page-item"><span>.</span></li>
            @endif
            @foreach(range(1, $data->last_page) as $i)
                @if($i >= $data->current_page - 1 && $i <= $data->current_page + 1)
                    @if ($i == $data->current_page)
                        <li class="page-item active">
                            <a href="javascript:void(0)" class="page-link" aria-controls="exit-goods" data-dt-idx="1" tabindex="0">
                                {{ $i }}
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a href="javascript:void(0)" class="page-link paginate" data-page="{{ $i }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endif
                @endif
                @endforeach
                @if($data->current_page < $data->last_page - 2)
                    <li class="page-item"><span>.</span></li>
                @endif
                @if($data->current_page < $data->last_page - 1)
                    <li class="page-item">
                        <a href="javascript:void(0)" class="page-link paginate" data-page="{{ $data->last_page }}">{{ $data->last_page }}</a>
                    </li>
                @endif
            {!! getNext($data->current_page, $data->last_page, $data->current_page+1 ) !!}
        </ul>
    </nav>
@endif