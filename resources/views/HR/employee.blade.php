@extends('layouts.master')
@section('content')
    <!-- Page-content -->
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Employee List</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">HR Management</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Employee List
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Employee List</h6>
                        <div class="shrink-0">
                            <button data-modal-target="addEmployeeModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="plus" class="lucide lucide-plus inline-block size-4">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg> 
                                <span class="align-middle">Add Employee</span>
                            </button>
                        </div>
                    </div>
                    <br>
                   
<table id="alternativePagination" class="display" style="width:100%">
    <thead>
        <tr class="text-slate-500 dark:text-zink-200">
            <th class="px-3.5 py-2.5 font-semibold border-b">No</th>
            <th class="px-3.5 py-2.5 font-semibold border-b">Employee ID</th>
            <th class="px-3.5 py-2.5 font-semibold border-b text-left">Name</th>
            <th class="px-3.5 py-2.5 font-semibold border-b">Email</th>
            <th class="px-3.5 py-2.5 font-semibold border-b">Status</th>
            <th class="px-3.5 py-2.5 font-semibold border-b">Quick Pay</th> <th class="px-3.5 py-2.5 font-semibold border-b">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employeeList as $key => $employee)
            @php
                $fullName = $employee->name;
                $parts = explode(' ', $fullName);
                $initials = '';
                foreach ($parts as $part) {
                    $initials .= strtoupper(substr($part, 0, 1));
                }
            @endphp
            <tr class="border-b border-slate-200 dark:border-zink-500">
                <td class="px-3.5 py-2.5">{{ ++$key }}</td>
                <td class="px-3.5 py-2.5">{{ $employee->user_id }}</td>
                <td class="px-3.5 py-2.5">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center justify-center font-medium rounded-full size-8 shrink-0 bg-slate-200 text-slate-800 text-xs">
                            @if(!empty($employee->avatar))
                                <img src="{{ URL::to('assets/images/user/'.$employee->avatar) }}" alt="" class="size-8 rounded-full">
                            @else  
                                {{ $initials }}
                            @endif
                        </div>
                        <span class="font-medium">{{ $employee->name }}</span>
                    </div>
                </td>
                <td class="px-3.5 py-2.5 text-sm">{{ $employee->email }}</td>
                <td class="px-3.5 py-2.5">
                    <span class="px-2 py-0.5 text-[10px] font-medium rounded border {{ $employee->status == 'Active' ? 'bg-green-100 text-green-500' : 'bg-red-100 text-red-500' }}">
                        {{ $employee->status }}
                    </span>
                </td>
                
                <td class="px-3.5 py-2.5">
                    <form action="{{ route('invoices.store') }}" method="POST" class="flex items-center gap-1">
                        @csrf
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-1.5 text-gray-500 text-[10px] font-bold">৳</span>
                            <input type="number" name="amount" placeholder="Amount" 
                                   class="w-20 pl-4 pr-1 py-1 text-xs border border-slate-200 rounded focus:ring-1 focus:ring-emerald-500 outline-none dark:bg-zink-600 dark:border-zink-500" 
                                   required>
                        </div>
                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-2 py-1 rounded text-xs font-bold transition-colors">
                            Pay
                        </button>
                    </form>
                </td>
                <td class="px-3.5 py-2.5">
                    <div class="flex gap-2">
                        <a href="#!" class="text-slate-500 hover:text-custom-500"><i data-lucide="eye" class="size-4"></i></a>
                        <a href="#!" class="text-slate-500 hover:text-red-500"><i data-lucide="trash-2" class="size-4"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->

    <!--add Employee-->
    <div id="addEmployeeModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                <h5 class="text-16">Add Employee</h5>
                <button data-modal-close="addEmployeeModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <form class="create-form" id="create-form" action="{{ route('hr/employee/save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="" name="id" id="id">
                    <input type="hidden" value="add" name="action" id="action">
                    <input type="hidden" id="id-field">
                    <div id="alert-error-msg" class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20"></div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                        <div class="xl:col-span-12">
                            <div class="relative mx-auto mb-4 rounded-full shadow-md size-24 bg-slate-100 profile-user dark:bg-zink-500">
                                <img src="{{ URL::to('assets/images/user.png') }}" alt="" class="object-cover w-full h-full rounded-full user-profile-image">
                                <div class="absolute bottom-0 flex items-center justify-center rounded-full size-8 ltr:right-0 rtl:left-0 profile-photo-edit">
                                    <input id="profile-img-file-input" name="photo" type="file" class="hidden profile-img-file-input">
                                    <label for="profile-img-file-input" class="flex items-center justify-center bg-white rounded-full shadow-lg cursor-pointer size-8 dark:bg-zink-600 profile-photo-edit">
                                        <i data-lucide="image-plus" class="size-4 text-slate-500 fill-slate-200 dark:text-zink-200 dark:fill-zink-500"></i>
                                    </label>
                                </div>
                            </div>
                            @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="margin-left: 30%;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-12">
                            <label for="employeeId" class="inline-block mb-2 text-base font-medium">Employee ID</label>
                            <input type="text" id="employeeId" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ $employeeId }}" disabled="">
                        </div>
                        <div class="xl:col-span-12">
                            <label for="employeeInput" class="inline-block mb-2 text-base font-medium">Name</label>
                            <input type="text" name="name" id="employeeInput" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('name') is-invalid @enderror " placeholder="Employee name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-12">
                            <label for="emailInput" class="inline-block mb-2 text-base font-medium">Email</label>
                            <input type="text" name="email" id="emailInput" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('email') is-invalid @enderror " placeholder="example@starcode.com" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-12">
                            <label for="positionInput" class="inline-block mb-2 text-base font-medium">Position</label>
                            <select name="position" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices="" data-choices-search-false="" id="typeSelect">
                                <option value="">-- Select Position --</option>
                                @foreach($position as $key => $value)
                                <option value="{{ $value->position }}">{{ $value->position }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-12">
                            <label for="positionInput" class="inline-block mb-2 text-base font-medium">Department</label>
                            <input type="text" name="department" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('email') is-invalid @enderror " placeholder="Enter department" value="{{ old('department') }}">
                            @error('department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="role_name" class="inline-block mb-2 text-base font-medium">Role Name</label>
                            <select name="role_name" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices="" data-choices-search-false="" id="typeSelect">
                                <option value="">-- Select Role Name --</option>
                                @foreach($roleName as $key => $value)
                                <option value="{{ $value->role_type }}">{{ $value->role_type }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="status" class="inline-block mb-2 text-base font-medium">Status</label>
                            <select name="status" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices="" data-choices-search-false="" id="typeSelect">
                                <option value="">-- Select Status --</option>
                                @foreach($statusUser as $key => $value)
                                <option value="{{ $value->type_name }}">{{ $value->type_name }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="phoneNumberInput" class="inline-block mb-2 text-base font-medium">Phone Number</label>
                            <input type="tel" name="phone_number" id="phoneNumberInput" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('phone_number') is-invalid @enderror " placeholder="Enter phone number" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="locationInput" class="inline-block mb-2 text-base font-medium">Location</label>
                            <input type="text" name="location" id="locationInput" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200  @error('location') is-invalid @enderror " placeholder="Enter location" value="{{ old('location') }}">
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="joiningDateInput" class="inline-block mb-2 text-base font-medium">Joining Date</label>
                            <input type="text" name="join_date" id="joiningDateInput" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('join_date') is-invalid @enderror " placeholder="Select date" data-provider="flatpickr" data-date-format="d M, Y" value="{{ old('join_date') }}">
                            @error('join_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="experienceInput" class="inline-block mb-2 text-base font-medium">Experience</label>
                            <input type="number" name="experience" id="experienceInput" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('experience') is-invalid @enderror " placeholder="0.0" value="{{ old('experience') }}">
                            @error('experience')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-12">
                            <label for="designationSelect" class="inline-block mb-2 text-base font-medium">Designation</label>
                            <select name="designation" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices="" data-choices-search-false="" id="typeSelect">
                                <option value="">-- Select Designation --</option>
                                @foreach($position as $key => $value)
                                <option value="{{ $value->position }}">{{ $value->position }}</option>
                                @endforeach
                            </select>
                            @error('designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="close-modal" data-modal-close="addEmployeeModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit" id="addNew" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 addEmployeeModal">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end add Employee-->

    <!--edit Employee-->
    <div id="editEmployeeModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                <h5 class="text-16">Edit Employee</h5>
                <button data-modal-close="editEmployeeModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <form class="create-form" id="create-form" action="{{ route('hr/employee/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="e_id">
                    <input type="hidden" value="add" name="action" id="action">
                    <input type="hidden" id="id-field">
                    <input type="hidden" name="old_photo" id="old_photo">
                    <div id="alert-error-msg" class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20"></div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                        <div class="xl:col-span-12">
                            <div class="relative mx-auto mb-4 rounded-full shadow-md size-24 bg-slate-100 profile-user dark:bg-zink-500">
                                <img id="e_photo_edit" src="{{ URL::to('assets/images/user.png') }}" alt="" class="object-cover w-full h-full rounded-full edit-user-profile-image">
                                <div class="absolute bottom-0 flex items-center justify-center rounded-full size-8 ltr:right-0 rtl:left-0 profile-photo-edit">
                                    <input id="edit-profile-img-file-input" name="photo" type="file" class="hidden edit-profile-img-file-input">
                                    <label for="edit-profile-img-file-input" class="flex items-center justify-center bg-white rounded-full shadow-lg cursor-pointer size-8 dark:bg-zink-600 profile-photo-edit">
                                        <i data-lucide="image-plus" class="size-4 text-slate-500 fill-slate-200 dark:text-zink-200 dark:fill-zink-500"></i>
                                    </label>
                                </div>
                            </div>
                            @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="margin-left: 30%;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-12">
                            <label for="employeeId" class="inline-block mb-2 text-base font-medium">Employee ID</label>
                            <input type="text" name="employee_id" id="e_employee_id" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" readonly="">
                        </div>
                        <div class="xl:col-span-12">
                            <label for="employeeInput" class="inline-block mb-2 text-base font-medium">Name</label>
                            <input type="text" name="name" id="e_name" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('name') is-invalid @enderror " placeholder="Employee name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-12">
                            <label for="emailInput" class="inline-block mb-2 text-base font-medium">Email</label>
                            <input type="text" name="email" id="e_email" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('email') is-invalid @enderror " placeholder="example@starcode.com" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-12">
                            <label for="positionInput" class="inline-block mb-2 text-base font-medium">Position</label>
                            <select name="position" id="e_position" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices-search-false="" id="typeSelect">
                                <option value="">-- Select Position --</option>
                                @foreach($position as $key => $value)
                                <option value="{{ $value->position }}">{{ $value->position }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-12">
                            <label for="positionInput" class="inline-block mb-2 text-base font-medium">Department</label>
                            <input type="text" name="department" id="e_department" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('email') is-invalid @enderror " placeholder="Enter department" value="{{ old('department') }}">
                            @error('department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="role_name" class="inline-block mb-2 text-base font-medium">Role Name</label>
                            <select name="role_name" id="e_role_name" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices-search-false="" id="typeSelect">
                                <option value="">-- Select Role Name --</option>
                                @foreach($roleName as $key => $value)
                                <option value="{{ $value->role_type }}">{{ $value->role_type }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="status" class="inline-block mb-2 text-base font-medium">Status</label>
                            <select name="status" id="e_status" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices-search-false="" id="typeSelect">
                                <option value="">-- Select Status --</option>
                                @foreach($statusUser as $key => $value)
                                <option value="{{ $value->type_name }}">{{ $value->type_name }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="phoneNumberInput" class="inline-block mb-2 text-base font-medium">Phone Number</label>
                            <input type="tel" name="phone_number" id="e_phone_number" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('phone_number') is-invalid @enderror " placeholder="Enter phone number" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="locationInput" class="inline-block mb-2 text-base font-medium">Location</label>
                            <input type="text" name="location" id="e_location" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200  @error('location') is-invalid @enderror " placeholder="Enter location" value="{{ old('location') }}">
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="joiningDateInput" class="inline-block mb-2 text-base font-medium">Joining Date</label>
                            <input type="text" name="join_date" id="e_join_date" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('join_date') is-invalid @enderror " placeholder="Select date" data-provider="flatpickr" data-date-format="d M, Y" value="{{ old('join_date') }}">
                            @error('join_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-6">
                            <label for="experienceInput" class="inline-block mb-2 text-base font-medium">Experience</label>
                            <input type="number" name="experience" id="e_experience" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('experience') is-invalid @enderror " placeholder="0.0" value="{{ old('experience') }}">
                            @error('experience')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="xl:col-span-12">
                            <label for="designationSelect" class="inline-block mb-2 text-base font-medium">Designation</label>
                            <select name="designation" id="e_designation" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices-search-false="" id="typeSelect">
                                <option value="">-- Select Designation --</option>
                                @foreach($position as $key => $value)
                                <option value="{{ $value->position }}">{{ $value->position }}</option>
                                @endforeach
                            </select>
                            @error('designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="close-modal" data-modal-close="editEmployeeModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit" id="addNew" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Update Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end edit Employee-->

    <!-- delete modal-->
    <div id="deleteModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                <div class="float-right">
                    <button data-modal-close="deleteModal" class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <img src="data:image/png;base64,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" alt="" class="block h-12 mx-auto">
                <form action="{{ route('hr/employee/delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_delete" id="e_idDelete">
                    <input type="hidden" name="del_photo" id="del_photo">
                    <div class="mt-5 text-center">
                        <h5 class="mb-1">Are you sure?</h5>
                        <p class="text-slate-500 dark:text-zink-200">Are you certain you want to delete this record?</p>
                        <div class="flex justify-center gap-2 mt-6">
                            <button type="reset" data-modal-close="deleteModal" class="bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-600 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10">Cancel</button>
                            <button type="submit" class="text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">Yes, Delete It!</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end delete modal-->

@section('script')
    <!-- update js -->
    <script>
        $(document).on('click', '#editEmployee', function () {
            var _this = $(this).closest('tr'); // use .closest() instead of .parents() for clarity

            // Handle photo
            var photo = _this.find('.photo').text().trim();
            var photos = photo 
                ? "{{ asset('assets/images/user') }}/" + photo 
                : "{{ asset('assets/images/user.png') }}";
            $('#e_photo_edit').attr("src", photos);
            $('#old_photo').val(photo);

            // Assign text values to inputs
            $('#e_id').val(_this.find('.id').text().trim());
            $('#e_employee_id').val(_this.find('.user_id').text().trim());
            $('#e_name').val(_this.find('.name').text().trim());
            $('#e_email').val(_this.find('.email').text().trim());
            $('#e_position').val(_this.find('.position').text().trim());
            $('#e_phone_number').val(_this.find('.phone_number').text().trim());
            $('#e_location').val(_this.find('.location').text().trim());
            $('#e_join_date').val(_this.find('.join_date').text().trim());
            $('#e_experience').val(_this.find('.experience').text().trim());
            $('#e_designation').val(_this.find('.designation').text().trim());

            // For select fields (department, role, status)
            $('#e_department').val(_this.find('.department').text().trim()).trigger('change');
            $('#e_role_name').val(_this.find('.role_name').text().trim()).trigger('change');
            $('#e_status').val(_this.find('.statuss').text().trim()).trigger('change');
        });
    </script>

    <!-- delete js -->
    <script>
        $(document).on('click','#deleteRecord',function()
        {
            var _this = $(this).parents('tr');
            $('#e_idDelete').val(_this.find('.ids').text());
            $('#del_photo').val(_this.find('.photo').text());
        });
    </script>

    <script>
        //for add profile
        if (document.querySelector("#profile-img-file-input")) {
            document.querySelector("#profile-img-file-input").addEventListener("change", function () {
                var preview = document.querySelector(".user-profile-image");
                var file = document.querySelector(".profile-img-file-input").files[0];
                var reader = new FileReader();
                reader.addEventListener(
                    "load",
                    function () {
                        preview.src = reader.result;
                    },
                    false
                );
                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        }
        //for edit profile
        if (document.querySelector("#edit-profile-img-file-input")) {
            document.querySelector("#edit-profile-img-file-input").addEventListener("change", function () {
                var preview = document.querySelector(".edit-user-profile-image");
                var file = document.querySelector(".edit-profile-img-file-input").files[0];
                var reader = new FileReader();
                reader.addEventListener(
                    "load",
                    function () {
                        preview.src = reader.result;
                    },
                    false
                );
                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
@endsection
@endsection
