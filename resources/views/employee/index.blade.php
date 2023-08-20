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
            <a href="{{route('employee.index')}}">Remove Filter</a>
        </div>
        <div class="table-wrapper no-scrollbar" id="dataTable">
            
        </div>
        {{-- <div class="paginates text-right">
            <a href="#">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Next</a>
        </div> --}}
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
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control hms-control hms-small first-focus">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn hms-btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn hms-btn btn-sea" id="applySearch">Apply</button>
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
            $(document).on('click', '.paginate', function(e){
                e.preventDefault();
                var searchParams = new URLSearchParams(window.location.search);
                searchParams.set(`page`, '1');
                var newUrl = '?'+searchParams.toString();
                window.history.pushState({}, '', newUrl);
                let page = $(this).data('page');
                let queryString = `page`;
                getQueryString(queryString, page);
            });

            $(document).ready(function () {
                getData();
            });

            // Search
            $(document).on('click', '#applySearch', function(e){
                e.preventDefault();
                var searchParams = new URLSearchParams(window.location.search);
                searchParams.set(`page`, '1');
                var newUrl = '?'+searchParams.toString();
                window.history.pushState({}, '', newUrl);

                let name = $('input[name=name]').val();
                let queryString = `name`;
                getQueryString(queryString, name);
                $("#search-tray").modal('hide');
            });

            function getQueryString(queryString = '', value = '')
            {
                let currentUrl = window.location.href;
                if(currentUrl.indexOf("?page=") > -1)
                {
                    if(currentUrl.indexOf(queryString) > -1)
                    {
                        var parameters = new URLSearchParams(window.location.search);
                        let val = parameters.get(queryString) //1
                        if(value === '')
                        {
                            var searchParams = new URLSearchParams(window.location.search);
                            var newUrl = removeParam(queryString, currentUrl);
                            window.history.pushState({}, '', newUrl);
                            getData(newUrl);
                        }else {
                            if(val !== value)
                            {
                                var searchParams = new URLSearchParams(window.location.search);
                                searchParams.set(queryString, value);
                                var newUrl = '?'+searchParams.toString();
                                window.history.pushState({}, '', newUrl)
                                getData(newUrl);
                            }
                        }
                    }else {
                        let newUrl = currentUrl+'&'+queryString+'='+value;
                        window.history.pushState({}, '', newUrl);
                        getData(newUrl);
                    }
                }else {
                    let newUrl = currentUrl+'?page=1&'+queryString+'='+value;
                    window.history.pushState({}, '', newUrl);
                    getData(newUrl);
                }
            }

            function removeParam(key, sourceURL) {
                var rtn = sourceURL.split("?")[0],
                    param,
                    params_arr = [],
                    queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
                if (queryString !== "") {
                    params_arr = queryString.split("&");
                    for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                        param = params_arr[i].split("=")[0];
                        if (param === key) {
                            params_arr.splice(i, 1);
                        }
                    }
                    if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
                }
                return rtn;
            }

            function getData(url = ''){
                if(url.indexOf("?page=1") > -1){
                    $.ajax({
                        url: url,
                        method: "GET",
                        cache: false,
                        success: function(data)
                        {
                            $('#dataTable').html(data);
                        }
                    });
                }else {
                    let currentUrl = window.location.href;
                    $.ajax({
                        url: currentUrl,
                        method: "GET",
                        cache: false,
                        success: function(data)
                        {
                            $('#dataTable').html(data);
                        }
                    });
                }

            }

            // ========== Detail Employee Modal ==========
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