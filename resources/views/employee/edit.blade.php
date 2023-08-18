<x-app-layout>
    @if ($message = Session::get('error'))
        <div class="modal anchor-modal splash" id="general-dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-header">
                    <img src="{{asset('img/modal-head.jpg')}}">
                </div>
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn hms-btn btn-light pop" data-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="sgx-title">
        <h1>
            <a href="{{route('employee.index')}}"><img src="{{asset('icons/arrow-left-blue.svg')}}" class="separate back"></a> {{$employee->name}} 
        </h1>
    </div>
    <form action="{{ route('employee.update', $id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="sgx-table">
            <div class="form-about">
                Employee Information
            </div>
            <div class="table-wrapper">
                <table class="table">
                  <thead>
                    <tr>
                        <th colspan="99">Work Information</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td class="sgx-w-200 cell-title">Company <small style="color: red">*</small></td>
                        <td class="sgx-w-300 input-td">
                            <select name="company_id" required >
                                @foreach ($companys as $company)
                                    <option value="{{$company->id}}" {{ ($company->id == $employee->company_id) ? 'selected' : ''}}>{{ $company->code . ' - ' . $company->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sgx-w-200 cell-title">Department <small style="color: red">*</small></td>
                        <td class="sgx-w-300 input-td">
                            <select name="departement_id" required>
                                @foreach ($departements as $departement)
                                    <option value="{{$departement->id}}" {{ ($departement->id == $employee->departement_id) ? 'selected' : ''}}>{{$departement->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sgx-w-200 cell-title">Name <small style="color: red">*</small></td>
                        <td class="sgx-w-300 input-td"><input type="text" name="name" value="{{$employee->name}}" required></td>
                    </tr>
                    <tr>
                        <td class="sgx-w-200 cell-title">NIK <small style="color: red">*</small></td>
                        <td class="sgx-w-300 input-td"><input type="text"  name="nik" value="{{$employee->nik}}" required></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sgx-w-200 cell-title">Status <small style="color: red">*</small></td>
                        <td class="sgx-w-300 input-td">
                            <select name="status" required>
                                @foreach ($statuses as $status)
                                    <option value="{{$status}}" {{ ($status == $employee->status) ? 'selected' : ''}}>{{ucwords($status)}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sgx-w-200 cell-title">Join Date <small style="color: red">*</small></td>
                        <td class="sgx-w-300 input-td"><input type="date" value="{{$employee->join_date}}" name="join_date" required></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sgx-w-200 cell-title">Date of Birth</td>
                        <td class="sgx-w-300 input-td"><input type="date" value="{{$employee->date_of_birth}}" name="date_of_birth"></td>
                        <td></td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        <div class="sgx-form">
            <div class="form-section brd-bottom brd-top">
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-sea hms-btn add-spinner white-spinner pop">Update</button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>