@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Elements</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Tabs</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Basic Style2 Tabs
                    </div>
                    <p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p>
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات
                                                    الفاتوره</a></li>
                                            {{-- <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع </a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive">
                                                <table id="example" class="table key-buttons text-md-nowrap text-center">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">رقم الفاتوره</th>
                                                            <th class="border-bottom-0">تاريخ الفاتوره</th>
                                                            <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                                            <th class="border-bottom-0">المنتيج</th>
                                                            <th class="border-bottom-0">القسم</th>
                                                            <th class="border-bottom-0">الخصم</th>
                                                            <th class="border-bottom-0">نسبه الضريبه</th>
                                                            <th class="border-bottom-0">قيمه الضريبه</th>
                                                            <th class="border-bottom-0"> الاجمالي</th>
                                                            <th class="border-bottom-0"> الحاله</th>
                                                            {{-- <th class="border-bottom-0"> ملاحظات</th> --}}
                                                            <th class="border-bottom-0"> مبلغ التحصيل</th>
                                                            <th class="border-bottom-0"> مبلغ العموله</th>
                                                            <th class="border-bottom-0"> المستخدم </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $invoices->invoice_number }}</td>
                                                            <td>{{ $invoices->invoice_Date }}</td>
                                                            <td>{{ $invoices->due_date }}</td>
                                                            <td>{{ $invoices->product }}</td>
                                                            <td>
                                                                {{ $invoices->section->section_name }}
                                                            </td>
                                                            <td>{{ $invoices->discount }}</td>
                                                            <td>{{ $invoices->rate_VAT }}</td>
                                                            <td>{{ $invoices->value_VAT }} </td>
                                                            <td> {{ $invoices->total }}</td>
                                                            <td>{{ $invoices->status }}</td>
                                                            </td>
                                                            {{-- <td> {{ $invoices->note }} </td>    --}}
                                                            <td>{{ $invoices->amount_collection }}</td>
                                                            <td>{{ $invoices->amount_Commission }}</td>
                                                            <td>{{ Auth::user()->name }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!---Prism Pre code-->

                        <!---Prism Pre code-->
                    </div> <!-- main-content closed -->
                @endsection
                @section('js')
                    <!--Internal  Datepicker js -->
                    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
                    <!-- Internal Select2 js-->
                    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
                    <!-- Internal Jquery.mCustomScrollbar js-->
                    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
                    <!-- Internal Input tags js-->
                    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
                    <!--- Tabs JS-->
                    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
                    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
                    <!--Internal  Clipboard js-->
                    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
                    <!-- Internal Prism js-->
                    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
                @endsection
