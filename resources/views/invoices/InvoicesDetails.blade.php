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
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('delete'))
        <div class="alert alert-danger" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Colse">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">

                    <div class="card mg-b-20" id="tabs-style2">
                        <div class="card-body">

                            <div class="text-wrap">
                                <div class="example">
                                    <div class="panel panel-primary tabs-style-2">
                                        <div class=" tab-menu-heading">
                                            <div class="tabs-menu1">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs main-nav-line">
                                                    <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات
                                                            الفاتورة</a></li>
                                                    <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a>
                                                    </li>
                                                    <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>



                                        <div class="panel-body tabs-menu-body main-content-body-right border">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab4">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">رقم الفاتورة</th>
                                                                <th scope="row">{{ $invoices->invoice_number }}</th>
                                                                <th scope="row">تارخ الاصدار</th>
                                                                <th scope="row">{{ $invoices->invoice_Date }}</th>
                                                                <th scope="row">تارخ الاستحقاق</th>
                                                                <th scope="row">{{ $invoices->Due_date }}</th>
                                                                <th scope="row">القسم</th>
                                                                <th scope="row">{{ $invoices->section->section_name }}
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">المنتج</th>
                                                                </th>
                                                                <th scope="row">{{ $invoices->product }}</th>
                                                                <th scope="row"> مبلغ التحصيل</th>
                                                                <th scope="row">{{ $invoices->Amount_collection }}</th>
                                                                <th scope="row">مبلغ العمولة</th>
                                                                <th scope="row">{{ $invoices->Amount_Commission }}</th>
                                                                <th scope="row">الخصم</th>
                                                                <th scope="row">{{ $invoices->Discount }}</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">نسبة الضريبة </th>
                                                                <th scope="row">{{ $invoices->Rate_VAT }}</th>
                                                                <th scope="row">قيمة الضريبة</th>
                                                                <th scope="row">{{ $invoices->Value_VAT }}</th>
                                                                <th scope="row">الاجمالي مع الضريبة</th>
                                                                <th scope="row">{{ $invoices->Total }}</th>
                                                                <th scope="row">الحالة الحالية</th>



                                                                @if ($invoices->Value_Status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $invoices->Status }}</span>
                                                                </td>
                                                            @elseif($invoices->Value_Status == 2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $invoices->Status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $invoices->Status }}</span>
                                                                </td>
                                                            @endif





                                                            </tr>
                                                            <tr>

                                                                <td>ملاحظات</td>
                                                                <td>{{ $invoices->note }}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>



                                                </div>



                                                {{-- حالات الدفع --}}
                                                <div class="tab-pane" id="tab5">
                                                    <table class="table table-striped">
                                                        <thead>

                                                            <tr>
                                                                <th scope="row">رقم الفاتورة</th>
                                                                <th scope="row">نوع المنتج</th>
                                                                <th scope="row"> القسم</th>
                                                                <th scope="row">حالة الدفع</th>
                                                                <th scope="row">تارخ الدفع</th>
                                                                <th scope="row">ملاحظات</th>
                                                                <th scope="row">تاريخ الاضافة</th>
                                                                <th scope="row">المستخدم</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                             @foreach ($details as $detail)
                                                            <tr>
                                                                <th scope="row">{{$detail->invoice_number}}</th>
                                                                </th>
                                                                <th scope="row">{{ $detail->product }}</th>
                                                                <th scope="row"> {{ $invoices->section->section_name }}
                                                                </th>


                                                                @if ($detail->Value_Status == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $detail->Status }}</span>
                                                                    </td>
                                                                @elseif($detail->Value_Status == 3)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $detail->Status }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $detail->Status }}</span>
                                                                    </td>
                                                                @endif



                                                                <th scope="row">{{$detail->Payment_Date}}  </th>
                                                                <th scope="row">{{ $detail->note }}</th>
                                                                <th scope="row">{{$invoices->invoice_Date }}</th>
                                                                <th scope="row">{{$detail->user}}</th>
                                                            </tr>

                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <br>


                                                <div class="tab-pane" id="tab6">
                                                    <!--المرفقات-->
                                                    <div class="card card-statistics">

                                                        <div class="card-body">
                                                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                            <h5 class="card-title">اضافة مرفقات</h5>
                                                            <form method="post" action="{{ url('/InvoiceAttachments') }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="customFile" name="file_name" required>
                                                                    <input type="hidden" id="customFile"
                                                                        name="invoice_number"
                                                                        value="{{ $invoices->invoice_number }}">
                                                                    <input type="hidden" id="invoice_id"
                                                                        name="invoice_id" value="{{ $invoices->id }}">
                                                                    <label class="custom-file-label" for="customFile">حدد
                                                                        المرفق</label>
                                                                </div><br><br>
                                                                <button type="submit" class="btn btn-primary btn-sm "
                                                                    name="uploadedFile">تاكيد</button>
                                                            </form>
                                                        </div>

                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="row">اسم الملف</th>
                                                                    <th scope="row">قام بالاضافة </th>
                                                                    <th scope="row"> تاريخ الاضافة</th>
                                                                    <th scope="row">العمليات </th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                                @foreach ($attachments as $attachment)
                                                                    <tr>
                                                                        <td scope="row">{{ $attachment->file_name }}
                                                                        </td>
                                                                        <td scope="row">{{ $attachment->Created_by }}
                                                                        </td>
                                                                        <td scope="row">{{ $attachment->created_at }}
                                                                        </td>
                                                                        <td scope="row">

                                                                            <a class="btn btn-outline-success btn-sm"
                                                                                target="_blank"
                                                                                href="{{ url('View_file') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                                                                                role="button"><i
                                                                                    class="fas fa-eye"></i>&nbsp;
                                                                                عرض</a>

                                                                            <a class="btn btn-outline-info btn-sm"
                                                                                href="{{ url('download') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                                                                                role="button"><i
                                                                                    class="fas fa-download"></i>&nbsp;
                                                                                تحميل</a>


                                                                            <button class="btn btn-outline-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-file_name="{{ $attachment->file_name }}"
                                                                                data-invoice_number="{{ $attachment->invoice_number }}"
                                                                                data-id_file="{{ $attachment->id }}"
                                                                                data-target="#delete_file">حذف</button>



                                                                        </td>
                                                                    </tr>
                                                                @endforeach



                                                            </tbody>
                                                        </table>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <!-- /row -->
                                </div>


                                <div class="modal fade" id="delete_file" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('delete_file') }}" method="post">

                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <p class="text-center">
                                                    <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                                                    </p>

                                                    <input type="hidden" name="id_file" id="id_file" value="">
                                                    <input type="hidden" name="file_name" id="file_name"
                                                        value="">
                                                    <input type="hidden" name="invoice_number" id="invoice_number"
                                                        value="">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Container closed -->
                        </div>
                        <!-- main-content closed -->
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
                        <script>
                            $('#delete_file').on('show.bs.modal', function(event) {
                                var button = $(event.relatedTarget)
                                var id_file = button.data('id_file')
                                var file_name = button.data('file_name')
                                var invoice_number = button.data('invoice_number')
                                var modal = $(this)
                                modal.find('.modal-body #id_file').val(id_file);
                                modal.find('.modal-body #file_name').val(file_name);
                                modal.find('.modal-body #invoice_number').val(invoice_number);
                            })
                        </script>
                    @endsection
