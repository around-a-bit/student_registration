@include('layouts.studentHeader')
<main class="container p-3 mt-5 main-container">
    <div class="card">
        <div class="card-main">


            <div class="card-title">
                <div class="title">Fees Payment</div>
            </div>

            <div class="card-body">
                <div class="container-payment-list">
                    <!-- Header Row -->
                    <div class="row row-head fw-bold border-bottom py-2">
                        <div class="col-md-1" style="text-align: center;">Semester</div>
                        <div class="col-md-1" style="text-align: center;">Amount (₹)</div>
                        <div class="col-md-1" style="text-align: center;">Late Fine (₹)</div>
                        <div class="col-md-2" style="text-align: center;">Total Amount (₹)</div>
                        <div class="col-md-2" style="text-align: center;">Start Date</div>
                        <div class="col-md-2" style="text-align: center;">End Date</div>
                        <div class="col-md-1" style="text-align: center;">Status </div>
                        <div class="col-md-2" style="text-align: center;">Date of Payment (YYYY-MM-DD)</div>
                    </div>
                    <!-- Data Row -->

                    @if(isset($fees_schedule))
                    @foreach($fees_schedule as $fee)
                    <div class="row row-data py-2 border-bottom">
                        <div class="col-md-1" style="text-align: center;">{{$fee->semester_name ?? '--'}}</div>
                        <div class="col-md-1" style="text-align: center;">{{$fee->total_amount ?? '--'}}</div>

                        @php
                        $late_fine = 0;
                        $late_per_day = (float)($fee->late_fine ?? 0);

                        // Parse dates
                        $current_date = new DateTime(now()->format('Y-m-d'));
                        $payment_date = !empty($fee->payment_date) ? new DateTime($fee->payment_date) : null;
                        $extended_date = !empty($fee->extended_date) ? new DateTime($fee->extended_date) : null;
                        $end_date = !empty($fee->end_date) ? new DateTime($fee->end_date) : null;

                        // Determine base due date (either extended_date or end_date)
                        $due_date = $extended_date ?? $end_date;

                        // 💡 Case 1: Payment made ON or BEFORE due_date
                        if ($payment_date && $due_date && $payment_date <= $due_date) {
                            $late_fine=0;
                            }

                            // 💡 Case 2: Payment made AFTER due_date
                            elseif ($payment_date && $due_date && $payment_date> $due_date) {
                            $days_late = $due_date->diff($payment_date)->days;
                            $late_fine = $days_late * $late_per_day;
                            }

                            // 💡 Case 3: Payment NOT YET made, but due_date has passed
                            elseif (!$payment_date && $due_date && $current_date > $due_date) {
                            $days_late = $due_date->diff($current_date)->days;
                            $late_fine = $days_late * $late_per_day;
                            }
                            @endphp





                            <div class="col-md-1" style="text-align: center;">{{ number_format($late_fine, 2) }}</div>
                            <div class="col-md-2" style="text-align: center;">{{ isset($fee->total_amount) ? number_format($fee->total_amount + $late_fine, 2) : '--' }}</div>
                            <div class="col-md-2" style="text-align: center;">{{$fee->start_date ?? '--'}}</div>
                            @if(empty($fee->extended_date))
                            <div class="col-md-2" style="text-align: center;">{{$fee->end_date ?? '--'}}</div>
                            @else
                            <div class="col-md-2" style="text-align: center;">{{$fee->extended_date ?? '--'}}</div>
                            @endif
                            @if($fee->start_date <= now()->format('Y-m-d'))
                                @if(!$fee->payment_table_id)
                                <div class="col-md-1" style="text-align: center;">
                                    <form action="{{ route('student.pay.fees.submit') }}" id="student-pay-{{$fee->fees_structure_id}}" method="POST">
                                        @method('POST')
                                        @csrf
                                        @if($late_fine)
                                        <input type="hidden" name="total_amount" value="{{ $fee->total_amount + $late_fine }}">
                                        <input type="hidden" name="late_fine" value="{{ $late_fine }}">
                                        @else
                                        <input type="hidden" name="late_fine" value="{{ $late_fine }}">
                                        <input type="hidden" name="total_amount" value="{{ $fee->total_amount }}">
                                        @endif

                                        <input type="hidden" name="student_id" value="{{ session('student_id') }}">

                                        <input type="hidden" name="fees_structure_id" value="{{$fee->fees_structure_id }}">

                                        <button type="button" class="btn btn-primary btn-sm" onclick="alertMessage(event, 'pay-student', '{{ $fee->fees_structure_id }}')">pay</button>

                                    </form>

                                </div>
                                @else
                                <div class="col-md-1" style="text-align: center;">
                                    <button type="submit" class="btn btn-success"> Paid </button>


                                    <form action="{{ route('student.pay.fees.print') }}" method="POST">
                                        @csrf

                                        @method('POST')

                                        <input type="hidden" name="student_id" value="{{ session('student_id') }}">


                                        <input type="hidden" name="fees_structure_id" value="{{ $fee->fees_structure_id }}">

                                        <button type="submit" class="btn btn-primary btn-sm">Invoice</button>
                                    </form>
                                </div>

                                @endif

                                @else
                                <div class="col-md-1" style="text-align: center;">
                                    <button type="submit" class="btn btn-secondary" disabled> Pay </button>
                                </div>
                                @endif
                                <div class="col-md-2" style="text-align: center;">{{ $fee->payment_date ?? '--'}}</div>


                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.footer')
</body>

</html>