<template>
    <tr :class="['row-' + payment.id, 'table-primary']">
        <td><strong>{{payment.created_at}}</strong></td>
        <td><strong>{{payment.card_holder}}</strong></td>
        <td><strong>{{payment.card_no}}</strong></td>
        <td><strong>{{status}}</strong></td>
        <td>
            <button type="button"
                    class="ask-otp btn btn-success"
                    @click="askOtp(payment.id)">
                {{ $trans('mpgs.sms') }} {{payment.sms_attempts + 1}}
            </button>
        </td>
        <td>
            <form class="form-inline justify-content-center">
            <button type="button"
                    class="approve-btn btn btn-info"
                    @click="approvePayment(payment.id)">
                {{ $trans('mpgs.approve') }} {{payment.approval_attempts + 1}}
            </button>
            </form>
        </td>
        <td>
            <form class="form-inline justify-content-center">
                <button type="button"
                        class="repeat-btn btn btn-danger mr-2"
                        @click="repeatPayment(payment.id)">
                    {{ $trans('mpgs.repeat') }} {{payment.repeat_attempts + 1}}
                </button>
                <select class="custom-select my-1 mr-sm-2" v-model="repeat_text">
                    <option :value="$trans('mpgs.repeat_text_1')">{{ $trans('mpgs.repeat_1') }}</option>
                    <option :value="$trans('mpgs.repeat_text_2')">{{ $trans('mpgs.repeat_2') }}</option>
                    <option :value="$trans('mpgs.repeat_text_3')">{{ $trans('mpgs.repeat_3') }}</option>
                    <option :value="$trans('mpgs.repeat_text_4')">{{ $trans('mpgs.repeat_4') }}</option>
                </select>
            </form>

        </td>
        <td class="align-middle">
            <form class="form-inline justify-content-center">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" :value="payment.id" v-model="selected" @change="toggleSelected(payment.id)" />
                </div>
            </form>
        </td>
    </tr>
</template>

<script>
export default {
    name: "PaymentPanel",
    props: {
        payment: Object,
    },
    data() {
        return {
            repeat_text: this.$trans('mpgs.repeat_text_1'),
            checked: false
        }
    },
    computed: {
        status: function () {
            if (this.payment.quit !== 0)
                return this.$trans('mpgs.quit');

            var count = this.payment.sms_attempts > this.payment.approval_attempts ?
                this.payment.sms_attempts : this.payment.approval_attempts;
            count = count == 0 ? 1 : count; // Chargement 1 for the first request

            if (this.payment.action === 1)
                if (this.payment.active === 1)
                    return `${this.$trans('mpgs.chargement')} ${count} (${this.$trans('mpgs.active')})`;
                else
                    return `${this.$trans('mpgs.chargement')} ${count} (${this.$trans('mpgs.inactive')})`;
            else {
                if (this.payment.active === 1)
                    return `${this.$trans('mpgs.authentif')} ${count}B (${this.$trans('mpgs.active')})`;
                else
                    return `${this.$trans('mpgs.authentif')} ${count}A (${this.$trans('mpgs.inactive')})`;
            }
        },
        selected: {
            get: function () {
                return this.payment.selected;
            },
            set: function(newValue) {
                this.payment.selected = newValue;
            }
        }
    },
    methods: {
        askOtp(id) {
            axios.post('/api/ask-otp', {
                'payment_id': id,
            }).then((res) => {
                this.$emit('ask-otp', res.data.payment);
            });
        },
        approvePayment(id) {
            axios.post('/api/approve-payment', {
                'payment_id': id,
            }).then((res) => {
                this.$emit('approve-payment', res.data.payment);
            });
        },
        repeatPayment(id) {
            axios.post('/api/repeat-payment', {
                'payment_id': id,
            }).then((res) => {
                this.$emit('repeat-payment', res.data.payment, this.repeat_text);
            });
        },
        toggleSelected(id) {
            axios.post('/api/update-selected', {
                'payment_id': id,
                'selected': this.selected,
            }).then(() => {
                // console.log(res.data.message);
            });
        }
    }
}
</script>

<style scoped>
td {
    text-align: center;
    vertical-align: middle;
}
button {
    font-weight: 800;
}
/*select {*/
/*    border: 1px solid black;*/
/*    width: 170px;*/
/*    height: 33px;*/
/*}*/
</style>
