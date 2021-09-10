<template >
    <div id="app">
        
                
        <div class="row col-md-6 offset-md-3">
            <h2>Ihre Ticketdaten lauten:</h2>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
                Ticketnummer:
            </div>
            <div class="col-md-5">
                 {{ entry.ticketnumber }}
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
                Vorname
            </div>
            <div class="col-md-5">
                {{ entry.first_name }}
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
                Nachname:
            </div>
            <div class="col-md-5">
                {{ entry.last_name }}
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
               Kundennummer: 
            </div>
            <div class="col-md-5">
                {{ entry.customer_number }}
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
               Email: 
            </div>
            <div class="col-md-5">
                {{ entry.email }}
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
               Thema: 
            </div>
            <div class="col-md-5">
                {{ entry.category.topic }}
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
               Text: 
            </div>
            <div class="col-md-5">
                {{ entry.text }}
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
               Status: 
            </div>
            <div class="col-md-5">
                {{ entry.status_id }}
            </div>
        </div>
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
    mounted() {
        /* console.log('Component mounted.'); */
        axios
            .post('/api/ticketinfo',{
                    formData: window.location.pathname
                })
            .then(response => {
                this.entry = response.data.data;
                console.log(this.entry);
                //window.open(this.link);
            }) 
            .catch(error => {
                console.log("failure" + response)
                //this.$emit('failed', true)
            })
    },    
    data() {
        return {
            url: 'https://www.ticketsystem.loc',
            entry:'',
            ticketnumber: ''
        }
    }
}
</script>