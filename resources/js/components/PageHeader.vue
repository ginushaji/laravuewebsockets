<template>
    <div>
        <h3 class="text-center pt-4 pb-2">
            {{ $trans('mpgs.active_visitors') }}: <strong class="mr-5 text-danger">{{ activeCount }}</strong>
            {{ $trans('mpgs.last_visitors') }}: <strong class="text-danger">{{ lastCount }}</strong>
        </h3>

<!--        <div class="float-right form-inline mr-3 mb-2">-->
<!--            <label class="my-1 mr-2" for="selectYourLang"><strong>{{ $trans('mpgs.select_language') }} : </strong></label>-->
<!--            <select class="custom-select my-1 mr-sm-2" id="selectYourLang" v-model="lang" @change="selectLang()">-->
<!--                <option selected value="en">English</option>-->
<!--                <option value="fr">French</option>-->
<!--                <option value="it">Italian</option>-->
<!--            </select>-->
<!--        </div>-->
    </div>
</template>

<script>
export default {
    name: "PageHeader",
    // data() {
    //     return {
    //         lang: 'en'
    //     };
    // },
    // methods: {
    //     selectLang() {
    //         this.$lang.setLocale(this.lang);
    //         localStorage.setItem('locale', this.lang);
    //     },
    // },
    props: {
        activeCount: Number,
        lastCount: Number,
    },
    // created() {
    //     if (localStorage.getItem('locale')) {
    //         this.lang = localStorage.getItem('locale');
    //     } else {
    //         this.lang = 'en';
    //     }
    //     this.$lang.setLocale(this.lang);
    // }
}
</script>

<style scoped>

</style>
