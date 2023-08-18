<x-app-layout>
    <div class="sgx-title">
        <h1>{{$title}}</h1>
    </div>
    <div class="sgx-stats">
        <div class="item">
            <div class="big-val">{{$employees->total_employee}} <img src="{{'icons/chart-line-blue.svg'}}" class="icon o10"></div>
            <div class="small-val font-size-11"><img src="{{'icons/users-dark.svg'}}" class="inline-icon">Total Employees</div>
        </div>
        <div class="item">
            <div class="big-val text-success">{{$employees->active_employee}}</div>
            <div class="small-val font-size-11"><img src="{{'icons/users-dark.svg'}}" class="inline-icon">Active Employees</div>
        </div>
        <div class="item">
            <div class="big-val text-danger">{{$employees->inactive_employee}}</div>
            <div class="small-val font-size-11"><img src="{{'icons/users-dark.svg'}}" class="inline-icon">Inactive Employees</div>
        </div>
    </div>
    <div class="sgx-table alt">
        <div class="options no-scrollbar">
            <a href="{{route('employee.create')}}" class="item">
                <img src="{{'icons/plus-dark.svg'}}" class="icon">Register
            </a>
            <a href="#" class="item" data-toggle="modal" data-target="#search-tray">
                <img src="{{'icons/search-dark.svg'}}" class="icon">Search
            </a>
        </div>
        <div class="info">
            <!-- <em>Showing 25 out items</em> -->
            <em>Showing 25 out of 240 filtered items - <a href="{{route('employee.index')}}">Remove Filter</a></em>
        </div>
        <div class="table-wrapper no-scrollbar">
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
                    @foreach ($employees->list as $item)
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
        </div>
        <div class="paginates text-right">
            <a href="#">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Next</a>
        </div>
    </div>

    {{-- ================ Modals ================ --}}
    @if ($message = Session::get('success'))
        <div class="modal anchor-modal splash" id="general-dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-header">
                    <img src="{{asset('img/modal-head.jpg')}}">
                </div>
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="alert alert-success" role="alert">{{$message}}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn hms-btn btn-light pop" data-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal anchor-modal" id="search-tray">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="img/modal-head.jpg">
                </div>
                <div class="modal-desc">
                    Employee Database Search
                </div>
                <div class="modal-body">
                    <form action="arrivals.php">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control hms-control hms-small first-focus">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn hms-btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn hms-btn btn-sea add-spinner white-spinner">Apply</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal anchor-modal" id="view-tray">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{ asset('img/modal-head.jpg')}}">
                </div>
                <div class="modal-spinner">
                    <div class="spinner-contain"><div class="spinner-border"></div></div>
                </div>
                <div class="modal-body" id="modalDetailEmp">
                    
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn hms-btn btn-light pop" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script type="text/javascript">
            $('.page-item').click(function() {
                $('#filter-offset').val($(this).data('offset'));
                var off = $(this).data('offset');

                submitData(true);
            });

            $(document).on('click', '#detailEmployee', function(e){
                e.preventDefault();
                let url = $(this).attr('data-href');
                let id = $(this).attr('data-id');
                // alert(id)
                $("#view-tray").modal('show');
                $('#bungkus').remove();

                $.ajax({
                    url: url,
                    method: "GET",
                    cache: false,
                    success: function(data)
                    {
                        const obj   = JSON.parse(data);
                        let url     = '{{ route('employee.edit') }}/'+obj.id+'';

                        let html = `<div id="bungkus">
                            <div class="view-bg">
                                <img src="{{ asset('img/curve1.svg')}}" class="curve">
                            </div>
                            <div class="view-id mb-20">
                                <img src="https://lh3.googleusercontent.com/Oi2BFP9cVXQCxeKGezTqpJsplw7QpvHgiCgkhcTOVg9wfIQ_KQ1ccp__u-F4m-HShR7HE80Q_GRn4cz38DAQ8XdowkoCkiirByEpzQ=w286" class="thumb">
                                <div class="info">
                                    <div class="big-title">${obj.name}</div>
                                    <div class="meta-title">${obj.company} - ${obj.departement} - ${obj.age} yrs old</div>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="view-status inactive">${obj.status}</div>
                            </div>
                            <div class="pb-20"></div>
                            <div class="text-center">
                                <a href="${url}" class="btn hms-btn btn-sea add-spinner pop has-icon"><img src="{{ asset('icons/search.svg')}}" class="inline-icon">View Employee</a>
                            </div>
                            <div class="pb-50"></div>
                            <div class="row no-gutters">
                                <div class="col-4 text-center">
                                    <div class="view-pin mb-20">
                                        <div class="title">NIK</div>
                                        <div class="value">${obj.nik}</div>
                                    </div>    
                                </div>
                                <div class="col-4 text-center">
                                    <div class="view-pin mb-20">
                                        <div class="title">Service Year</div>
                                        <div class="value">${obj.service_year}</div>
                                    </div>    
                                </div>
                                <div class="col-4 text-center">
                                    <div class="view-pin mb-20">
                                        <div class="title">Joined</div>
                                        <div class="value">${obj.join_date}</div>
                                    </div>    
                                </div>
                            </div>
                        </div>`;

                        $('#modalDetailEmp').append(html);
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>