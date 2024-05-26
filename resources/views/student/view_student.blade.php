<!DOCTYPE html>
<html lang="en">

@include('admin_layouts.header')
<link rel="stylesheet" href="{{ url('assets/css/fullcalendar.min.css') }}">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
@livewireStyles()

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .container,
        .container * {
            visibility: visible;
        }

        .container {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>

<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')


        <div class="page-wrapper">
            <div class="content container-fluid">


                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Student Details</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/students') }}">Student</a></li>
                                    <li class="breadcrumb-item active">Student Details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-header invoices-page-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="breadcrumb invoices-breadcrumb">
                                <li class="breadcrumb-item invoices-breadcrumb-item">
                                    <a href="{{ url('admin/students') }}">
                                        <i class='bx bx-arrow-back'></i> Back to Student List
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="about-info">
                                    <h4>Profile <span><a href="javascript:;"><i
                                                    class="feather-more-vertical"></i></a></span></h4>
                                </div>
                                <div class="student-profile-head">
                                    <div class="profile-bg-img">
                                        <img src="{{ url('assets/img/background.jpeg') }}" alt="Profile"
                                            style="height: 150px;">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="profile-user-box">
                                                <div class="profile-user-img">
                                                    @if ($student->getFirstMediaUrl('student_profile_image'))
                                                        <img src="{{ $student->getFirstMediaUrl('student_profile_image') }}"
                                                            alt="Profile Image">
                                                    @else
                                                        <img src="{{ Avatar::create($student->name)->toBase64() }}"
                                                            alt="Profile">
                                                    @endif

                                                </div>
                                                <div class="names-profiles">
                                                    <h4>{{ $student->name }}</h4>
                                                    <h5>DOB: {{ $student->dob }}
                                                        ({{ \Carbon\Carbon::parse($student->dob)->age }} years old)</h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                        </div>
                                        <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                            <div class="follow-btn-group">
                                                {{-- <button type="submit" class="btn btn-info follow-btns">Follow</button> --}}
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#myModal">View Admission Details</button>

                                                <button type="submit" class="btn btn-primary mx-2"
                                                    data-bs-toggle="modal" data-bs-target="#idCard">ID Card</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="student-personals-grp">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="heading-detail">
                                                    <h4>Personal Details :</h4>
                                                </div>
                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-user"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Name</h4>
                                                        <h5>{{ $student->name }}</h5>
                                                    </div>
                                                </div>

                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-users"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Class</h4>
                                                        <h5>{{ $class->class_name }}</h5>
                                                    </div>
                                                </div>


                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-phone-call"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Mobile</h4>
                                                        <h5>{{ $student->mobile_no }}</h5>
                                                    </div>
                                                </div>
                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-mail"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Email</h4>
                                                        <h5>{{ $student->email }}</h5>
                                                    </div>
                                                </div>
                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-user"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Gender</h4>
                                                        <h5>{{ $student->gender }}</h5>
                                                    </div>
                                                </div>
                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-calendar"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Date of Birth</h4>
                                                        <h5>{{ $student->dob }}</h5>
                                                    </div>
                                                </div>

                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-edit-3"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Roll No</h4>
                                                        <h5>{{ $student->roll_number }}</h5>
                                                    </div>
                                                </div>


                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-search"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Admission ID</h4>
                                                        <h5>{{ $student->admission_id }}</h5>
                                                    </div>
                                                </div>

                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-dollar-sign"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Monthly Fee Amount</h4>
                                                        <h5>Rs. {{ $student->monthly_payment_amount }}</h5>
                                                    </div>
                                                </div>

                                                <div class="personal-activity mb-0">
                                                    <div class="personal-icons">
                                                        <i class="feather-map-pin"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Address</h4>
                                                        <h5>{{ $student->address }}</h5>
                                                    </div>
                                                </div>




                                            </div>
                                        </div>
                                    </div>



                                    <div class="student-personals-grp">
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <div class="heading-detail">
                                                    @livewire('due-amount-live-wire', ['studentId' => $student->id])
                                                </div>
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#creditPayment">Pay Due</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-9">
                                    <div class="student-personals-grp">
                                        <div class="card mb-0">
                                            <div class="card-body">


                                                <h5>Monthly Fee History</h5><br>
                                                <div class="table-responsive">
                                                    <table class="table table-striped custom-table" id="table_data">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Payment Date</th>
                                                                <th>Payment Month</th>
                                                                <th>Sub Total</th>
                                                                <th>Discount Amount</th>
                                                                <th>Paid Amount</th>
                                                                <th>Return Amount</th>
                                                                <th>Credit</th>
                                                                <th>Net Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($monthlyFeePayments as $monthlyFeePayment)
                                                                <tr>
                                                                    <td>{{ $monthlyFeePayment->id }}</td>
                                                                    <td>{{ $monthlyFeePayment->nepali_payment_date }}
                                                                    </td>
                                                                    <td>{{ $monthlyFeePayment->month }}</td>
                                                                    <td>{{ $monthlyFeePayment->sub_total }}</td>
                                                                    <td>{{ $monthlyFeePayment->discount_amount }}</td>
                                                                    <td>{{ $monthlyFeePayment->paid_amount }}</td>
                                                                    <td>{{ $monthlyFeePayment->return_amount }}</td>
                                                                    <td>{{ $monthlyFeePayment->credit_amount }}</td>
                                                                    <td>{{ $monthlyFeePayment->net_total }}</td>
                                                                    <td>

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
                            </div>


                        </div>
                    </div>
                </div>
            </div>




            <!-- The Modal -->
            <div class="modal fade" id="creditPayment">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">PAY DUE</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">

                            @livewire('credit-payment-form', ['studentId' => $student->id])
                        </div>



                    </div>
                </div>
            </div>


            <style>
                .modal-header {

                    text-align: center;
                }



                .payment-option input[type="radio"] {
                    display: none;
                }

                .payment-option label {
                    display: block;
                    padding: 15px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #fff;
                    cursor: pointer;
                    transition: background-color 0.3s, box-shadow 0.3s;
                }

                .payment-option input[type="radio"]:checked+label {
                    background-color: #4CAF50;
                    color: white;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                    border-color: #4CAF50;
                }

                /* button {
                    width: 100%;
                    margin-top: 20px;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 5px;
                    background-color: #4CAF50;
                    color: white;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                button:hover {
                    background-color: #45a049;
                } */
            </style>

            <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">{{ $student->name }} Admission Payment Details</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="student-personals-grp">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Student Name: {{ $student->name }}</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p>Enrollment Date: {{ $admission->enrollment_date }}</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p>Payment Mode: {{ $paymentOption->payment_name }}</p>

                                            </div>

                                            <div class="col-md-6">
                                                <p>Gross Total: {{ $paymentOption->payment_name }}</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p>Discount Amount: {{ $paymentOption->payment_name }}</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p>Paid Amount: {{ $paymentOption->payment_name }}</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p>Net Total: {{ $paymentOption->payment_name }}</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p>Billing Status: Paid</p>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="student-personals-grp">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table invoice-tables">
                                                <colgroup>
                                                    <col style="width: 33.33%;">
                                                    <col style="width: 33.33%;">
                                                    <col style="width: 33.33%;">
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ID</th>
                                                        <th class="text-center">Particulars</th>
                                                        <th class="text-center">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $counter = 1;
                                                    $totalAmount = 0; @endphp
                                                    @foreach ($admissionPaymentDetails as $admissionPaymentDetail)
                                                        <tr>
                                                            <td>{{ $counter }}</td>
                                                            <td>{{ $admissionPaymentDetail->particulars }}</td>
                                                            <td class="text-end">
                                                                @if ($admissionPaymentDetail->amount !== null)
                                                                    Rs. {{ $admissionPaymentDetail->amount }}
                                                                @endif
                                                            </td>

                                                        </tr>
                                                        @php
                                                            $counter++;
                                                        @endphp
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                            </div>




                        </div>



                    </div>
                </div>
            </div>


            <!-- The ID Card Modal -->
            <div class="modal" id="idCard">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">{{ $student->name }} ID Card</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="container">
                                <div class="padding">
                                    <div class="font">
                                        <div class="companyname">Pragyan Montessori<br><span class="tab">&
                                                Childcare, PMC </span></div>
                                        <div class="top">
                                            <?php
                                            // Get the URL of the image from the media library
                                            $imageURL = $student->getFirstMediaUrl('student_profile_image');
                                            if (!$imageURL) {
                                                // If no image found in the media library, use a placeholder or default image
                                                $imageURL = url('assets/img/placeholder.jpg');
                                            }
                                            ?>
                                            <img src="{{ $imageURL }}" alt="Profile Image">
                                        </div>
                                        <div class="">
                                            <div class="ename">
                                                <p class="p1"><b>{{ $student->name }}</b></p>

                                            </div>
                                            <div class="edetails">
                                                <P class="mb-0"><b>Mobile No :</b> {{ $student->mobile_no }}</P>
                                                <p class="mb-0"><b>DOB :</b> {{ $student->dob }}</p>
                                                <div class="Address2 mt-0"><b>Address:</b> {{ $student->address }}
                                                </div>

                                            </div>

                                            {{-- <div class="signature">
                                                <img src="{{url('assets/img/qr.png')}}" alt="">
                                            </div> --}}

                                            <div class="barcode">
                                                <img src="{{ url('assets/img/qr.png') }}" alt="">
                                            </div>
                                            <div class="qr">
                                                <img src="{{ url('assets/img/barcode.gif') }}" alt="">
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button onclick="printContainer()" class="btn btn-primary">Print</button>
                            <button onclick="generatePDF()" class="btn btn-primary">Generate PDF</button>
                        </div>

                    </div>
                </div>
            </div>






            @include('admin_layouts.footer2')

            <script>
                $(document).ready(function() {
                    // Initialize DataTables with styling
                    $('#table_data').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "info": true,
                        "autoWidth": false,
                        "order": [
                            [0, 'desc']
                        ],
                        "language": {
                            "paginate": {
                                "next": "Next",
                                "previous": "Prev"
                            }
                        }
                    });
                });
            </script>

            <style>
                .right-bottom-corner {
                    position: absolute;
                    bottom: 0;
                    right: 0;
                }

                .container-relative {
                    position: relative;
                }
            </style>


            {{-- ID Card Style --}}
            <style>
                * {
                    margin: 00px;
                    padding: 00px;

                }


                .container {
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: space-around;
                    flex-wrap: wrap;
                    box-sizing: border-box;
                    flex-direction: row;



                }

                .font {

                    height: 375px;
                    width: 225px;
                    position: relative;
                    border-radius: 10px;
                    background-image: url('{{ asset('assets/img/ecardbgfinal.png') }}');
                    ;
                    background-size: 225px 375px;
                    background-repeat: no-repeat;
                }

                .companyname {
                    color: White;

                    padding: 10px;
                    font-size: 14px;
                }

                .tab {
                    padding-right: 30px;
                }

                .top img {
                    height: 90px;
                    width: 90px;
                    background-color: #e6ebe0;
                    border-radius: 57px;
                    position: absolute;
                    top: 60px;
                    left: 102px;
                    object-fit: content;
                    border: 3px solid rgba(255, 255, 255, .2);

                }

                .ename {
                    position: absolute;
                    top: 160px;
                    left: 90px;
                    color: white;
                    font-size: 16px;
                }

                .edetails {
                    position: absolute;
                    top: 212px;
                    text-transform: capitalize;
                    font-size: 11px;
                    text-emphasis: spacing;
                    margin-left: 5px;
                }

                .signature {
                    position: absolute;
                    top: 75%;
                    height: 80px;
                    width: 160px;
                }

                .signature img {

                    height: 40px;
                    width: 100px;
                    margin: 15px 00px 00px 5px;
                    border-radius: 7px;

                }


                .barcode img {
                    height: 65px;
                    width: 65px;
                    text-align: center;
                    margin: 5px;

                }

                .barcode {
                    text-align: center;
                    position: absolute;
                    top: 62.5%;
                    left: 135px;
                }


                .qr img {
                    position: absolute;
                    top: 85%;
                    left: 32%;
                    height: 30px;
                    width: 120px;
                    margin: 20px;
                    background-color: white;

                }

                .edetails .Address2 {

                    width: 70%;
                    text-align: justify;
                }
            </style>



        </div>

        <script src="{{ url('assets/js/moment.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ url('assets/js/feather.min.js') }}"></script>
        <script src="{{ url('assets/js/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ url('assets/js/script.js') }}"></script>
        <script src="{{ url('assets/js/select2.min.js') }}"></script>
        <script src="{{ url('assets/js/filepond.js') }}"></script>
        <script src="{{ url('assets/js/apexcharts.min.js') }}"></script>
        <script src="{{ url('assets/js/chart-data.js') }}"></script>
        @livewireScripts()

        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <script>
            function printContainer() {
                window.print();
            }

            function generatePDF() {
                const container = document.querySelector('.container');

                // Convert images to Data URIs to embed them directly into the HTML
                const images = container.querySelectorAll('img');
                images.forEach(img => {
                    const imageUrl = img.getAttribute('src');
                    fetch(imageUrl)
                        .then(response => response.blob())
                        .then(blob => {
                            const reader = new FileReader();
                            reader.onloadend = function() {
                                const base64data = reader.result;
                                img.src = base64data;
                            };
                            reader.readAsDataURL(blob);
                        });
                });

                // Generate PDF
                html2pdf().from(container).save();
            }
        </script>

</body>

</html>
