<template>
    <div>
        <succes-page-component :entry="entry" :state="state" v-if="state == 'success'"></succes-page-component>
        <failure-page-component @failed="onFailed" v-if="state == 'failure'"></failure-page-component>
        <form-component @failed="onFailed" @completed="onComplete" v-if="['form', 'failure'].indexOf(state) > - 1"></form-component>
    </div>
</template>


<script>
import FormComponent from './FormComponent.vue';
import SuccesPageComponent from './SuccesPageComponent.vue';
import FailurePageComponent from './FailurePageComponent.vue';
//import { component } from 'vue/types/umd';
import { validationMixin } from "vuelidate";
import { required, minLength, maxLength, numeric, text } from "vuelidate/lib/validators"; 
export default {
    components: {
        FormComponent,
        SuccesPageComponent,
        FailurePageComponent 
    },
    data: function() {
        return {
            url: 'https://www.ticketsystem.loc',
            state: "form", 
            entry: null
        }
    },
    methods: {
        onComplete: function (success, entry) {
            console.log("hallo hat funktioniert");
            this.state = 'success';
            this.entry = entry;
        },
        onFailed: function (failed) {
            console.log("hat nicht funktioniert");
            this.state = 'failure';
        },
        onBack: function (back) {
            this.state = back;
        }
    }
}
</script>