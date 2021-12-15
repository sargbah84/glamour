@extends('frontend.layouts.app')

@section('title', __('Order Status'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center section-waiting">
            <div class="col-md-7">
                <div class="clearfix bg-white p-4 mb-4 shadow-sm">
                    <h4 class="pb-2">Please wait getting transaction status.</h4>
                    <table class="table clearfix w-100 mb-0">
                    </table>

                </div>
            </div><!--col-md-10-->
        </div><!--row-->
        <div class="row justify-content-center section-success" style="display: none;">
            <div class="col-md-7">
                <div class="clearfix bg-white p-4 mb-4 shadow-sm">
                    <h4 class="pb-2">Congratulations transaction was made successfully.</h4>
                    <table class="table clearfix w-100 mb-0">
                    </table>

                </div>
                <div class="clearfix w-75 mx-auto my-4">
                    <a href="{{ url('courses') }}"
                       class="text-danger d-inline-block py-1">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Back to courses') }}
                    </a>
                </div>
            </div><!--col-md-10-->
        </div><!--row-->
        <div class="row justify-content-center section-error " style="display: none;">
            <div class="col-md-7">
                <div class="clearfix bg-white p-4 mb-4 shadow-sm">
                    <h4 class="pb-2">Ups.. something is wrong can't process payment</h4>
                    <table class="table clearfix w-100 mb-0">
                    </table>

                </div>
                <div class="clearfix w-75 mx-auto my-4">
                    <a href="{{ url('plans') }}"
                       class="text-danger d-inline-block py-1">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Back to plans') }}
                    </a>
                </div>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection

@push('after-scripts')
    <script type="text/javascript">
        $(function () {
            let attempt = 0,
                maxAttempt = 5;

            setTimeout(transactionStatus, 5 * 1000);

            function transactionStatus() {
                $.ajax({
                    type: "POST",
                    datatype: "JSON",
                    url: '{{route('payments.transaction-status',$provider)}}',
                    data: {
                        order_id: '{{request()->input('order_id')}}'
                    },
                    success: function (response) {
                        if (response.status !== 'SUCCESS') {
                            if (maxAttempt === attempt) {
                                $('.section-waiting').hide()
                                $('.section-error').show();
                            } else {
                                setTimeout(transactionStatus, 15 * 1000);
                            }
                        } else {
                            $('.section-waiting').hide()
                            $('.section-success').show();
                        }
                    }
                });
                attempt++;
            }
        });
    </script>
@endpush
