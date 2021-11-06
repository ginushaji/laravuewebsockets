<template>
    <table class="w-100 table table-bordered">
        <thead>
            <tr class="bg-dark text-white">
                <th>{{ $trans('mpgs.date') }}</th>
                <th>{{ $trans('mpgs.name') }}</th>
                <th>{{ $trans('mpgs.card_number') }}</th>
                <th>{{ $trans('mpgs.state') }}</th>
                <th>{{ $trans('mpgs.sms') }}</th>
                <th>{{ $trans('mpgs.approve') }}</th>
                <th>{{ $trans('mpgs.final') }}</th>
                <th>{{ $trans('mpgs.delete') }}</th>
            </tr>
        </thead>
        <tbody>
            <template v-for="payment in payments">
                <payment-panel :payment="payment"
                               @ask-otp="askOtp"
                               @approve-payment="approvePayment"
                               @repeat-payment="repeatPayment" />
                <payment-content :payment="payment" />
            </template>
            <page-footer @delete-selected="deleteSelected" @delete-all="deleteAll" />
        </tbody>
    </table>
</template>

<script>
import PaymentPanel from "./PaymentPanel";
import PaymentContent from "./PaymentContent";
import PageFooter from "./PageFooter";

export default {
    name: "PaymentList",
    components: {
        PaymentPanel,
        PaymentContent,
        PageFooter,
    },
    props: {
        payments: {
            type: Array,
            required: true
        },
    },
    methods: {
        askOtp(payment) {
            this.$emit('ask-otp', payment);
        },
        approvePayment(payment) {
            this.$emit('approve-payment', payment);
        },
        repeatPayment(payment, text) {
            this.$emit('repeat-payment', payment, text);
        },
        deleteSelected() {
            this.$emit('delete-selected');
        },
        deleteAll() {
            this.$emit('delete-all');
        }
    }
}
</script>

<style scoped>
th {
    text-align: center;
}
</style>
