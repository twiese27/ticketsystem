<template v-else= "this.test == false">
    <div>
        <p class="h1">Ticketsystem</p>
        <p class="bg-danger">Ihre Eingabe ist fehlgeschlagen, bitte überprüfen Sie ihre Eingabe</p>
    </div>
</template>


<script>
import { validationMixin } from "vuelidate";
import { required, minLength, maxLength, numeric, text } from "vuelidate/lib/validators";
export default {
        mixins: [validationMixin],
        mounted() {

        },
        data() {
            return{
                url: 'https://www.ticketsystem.loc',
                errors: []
            }
        },
        methods:{},
        computed: {
            isDisabled: function() {
                return !( this.form.name && this.form.name2 && this.form.customernumber && this.form.email && this.form.topic && this.form.text && !this.$v.$error);
            }
        }
    }
</script>
