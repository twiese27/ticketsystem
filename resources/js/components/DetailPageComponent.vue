<template v-else= "this.test == false">
    <div id="app">
                
        <div>
            <b-form id="getBack" @back="getBack">
                <b-button v-b-modal.modal-1 
                        type="submit" 
                        variant="info"
                        >
                        Zurück
                </b-button>
            </b-form>
            <h2>Die Ticketdaten lauten:</h2>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
                Ticketnummer:
            </div>
            <div class="col-md-5">
                  {{ entries.row.ticketnumber }}
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
                Vorname
            </div>
            <div class="col-md-5">
                 {{ entries.row.first_name }} 
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
                Nachname:
            </div>
            <div class="col-md-5">
                 {{ entries.row.last_name }} 
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
               Kundennummer: 
            </div>
            <div class="col-md-5">
                 {{ entries.row.customer_number }} 
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
               Email: 
            </div>
            <div class="col-md-5">
                 {{ entries.row.email }}
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
               Thema: 
            </div>
            <div class="col-md-5">
                 {{ entries.row.category.topic }} 
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
               Text: 
            </div>
            <div class="col-md-5">
                 {{ entries.row.text }} 
            </div>
        </div>
        <div class="row col-md-6 offset-md-3">
            <div class="col-md-4">
               Status: 
            </div>
            <div class="col-md-5">
                 {{ entries.row.status }} 
            </div>
        </div>
        <b-form id="answers.form" @submit="onSubmit">
            <b-form-textarea 
            class="m-5"
            id="textarea"
            v-model="text"
            placeholder="Enter something..."
            rows="3"
            max-rows="6"
            ></b-form-textarea>

            <b-button v-b-modal.modal-1 
                      type="submit" 
                      variant="primary"
                      :disabled='isDisabled'
                      >
                      Submit
            </b-button>
        </b-form>
        
        
    </div>
</template>


<script>
import { validationMixin } from "vuelidate";
import { required, minLength, maxLength, numeric, text } from "vuelidate/lib/validators";
export default {
        mixins: [validationMixin],
        data() {
            return {
                text: ''
            }
        },
        props: {
            entries: {
                type: Object,
                required: true
            },
            selectEntry: {
                type: Object,
                required: false
            }
        },
        methods:{
            onSubmit(evt) {
                evt.preventDefault(); 
                    /* console.log('test'); */
                    axios
                        .post('/api/answer',{
                            entryUpdate: this.entries.row,
                            entryAnswer: this.text
                        })
                        .then(response => {
                            /* this.entry = response.data.data;
                            this.$emit('completed', true, this.entry) */
                            console.log('funktioniert');
                            this.$emit('answer', true, 'admin')
                            location.reload();
                        })  
                        .catch(error => {
                            /* console.log("failure" + response)
                            this.$emit('failed', true) */
                            console.log('test');
                        })
            }
        },
        computed: {
            isDisabled: function() {
                /* return !( this.form.name && this.form.name2 && this.form.customernumber && this.form.email && this.form.topic && this.form.text && !this.$v.$error); */
            }
        }
    }
</script>
 