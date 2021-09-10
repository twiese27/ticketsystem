<template v-else= "this.test == false">
    <div id="app">
        <p class="h1">Ticketsystem</p>
        <p class="h3">Ihr Eingabe war erfolgreich</p>
                
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
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
                Statuslink: 
            </div>
            <div class="col-md-5">
                <!-- <a href="https://www.ticketsystem.loc">trest</a> -->
                <b-button @click= "onClick"> Status ihres Tickets </b-button> 
            </div>
        </div>
        <b-form @submit="onSubmit">
            <b-button type="submit" variant="primary">Zurück zum Hauptmenü</b-button>
        </b-form>
    </div>
</template>


<script>
import { validationMixin } from "vuelidate";
import { required, minLength, maxLength, numeric, text } from "vuelidate/lib/validators";
export default {
        mixins: [validationMixin],
        props: {
            entry: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                link: ''
            }
        },
        methods:{
            onSubmit () {
                console.log('test');
                location.reload();
            },
            onClick () {
                //window.open("https://ticketsystem.loc/ticket/'{{entry.link}}'")
                axios
                    .post('/api/ticket',{
                        formData: this.entry.ticketnumber
                    })
                    .then(response => {
                        this.link = response.data.link;
                        console.log(this.link);
                        window.open(this.link);
                    }) 
                    .catch(error => {
                        console.log("failure" + response)
                        //this.$emit('failed', true)
                    })
            }
        }
    }
</script>
 