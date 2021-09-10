<template>
    <div>
        <p class="h1">Ticketsystem</p>
        <b-form id="entryForm" @submit="onSubmit">
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
            </p>
            <b-form-group id="input-group-1" 
                          label="Vorname:"  
                          label-for="input-1">
                <b-form-input id="input-1" 
                              v-model="$v.form.name.$model"
                              :state="validateState('name')"
                              
                              aria-describedby="input-1-live-feedback"
                              placeholder="Enter first-name"
                              >
                </b-form-input>

                <b-form-invalid-feedback id="input-1-live-feedback">
                    This is a required field and must be at least 3 characters.
                </b-form-invalid-feedback>

            </b-form-group>
            <b-form-group id="input-group-2" 
                          label="Nachname:" 
                          label-for="input-2">
                <b-form-input id="input-2" 
                              v-model="form.name2"
                              
                              placeholder="Enter last-name"
                              >
                </b-form-input>
            </b-form-group>
            <b-form-group id="input-group-3" 
                          label="Kundennummer:" 
                          label-for="input-3">
                <b-form-input type="number" 
                              v-model="$v.form.customernumber.$model"
                              :state="validateState('customernumber')"
                              
                              aria-describedby="input-3-live-feedback" 
                              id="input-3" 
                              placeholder="Enter number"
                              >
                </b-form-input>

                <b-form-invalid-feedback id="input-3-live-feedback">
                    This is a required field and must be 5 characters.
                </b-form-invalid-feedback>

            </b-form-group>
            <b-form-group id="input-group-4" 
                          label="Email Adresse:" 
                          label-for="input-4" 
                          description="We'll never share your email with anyone else.">
                <b-form-input id="input-4" 
                              v-model="form.email"
                              
                              type="email" 
                              placeholder="Enter email"
                              >
                </b-form-input>
            </b-form-group>
            <b-form-group id="input-group-5" 
                          label="Thema:" 
                          label-for="input-5">
                <b-form-select id="input-5" 
                               v-model="form.topic" 
                               :options="topics"
                                 
                               value-field="id" 
                               text-field="topic"
                               >
                </b-form-select>
            </b-form-group>
            <b-form-group id="input-group-6" 
                          label="Text:" 
                          label-for="input-6">
                        <b-form-textarea
                            id="input-6" 
                            v-model="$v.form.text.$model"
                            :state="validateState('text')"
                            aria-describedby="input-6-live-feedback"
                                
                            placeholder="Enter text"
                            rows="3"
                            max-rows="8"
                            no-auto-shrink
                        ></b-form-textarea>

                        <b-form-invalid-feedback id="input-6-live-feedback">
                            This is a required field and must be at least 25 characters.
                        </b-form-invalid-feedback> 

            </b-form-group>
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
import FormComponent from './FormComponent.vue';
import SuccesPageComponent from './SuccesPageComponent.vue';

import { validationMixin } from "vuelidate";
import { required, minLength, maxLength, numeric, text } from "vuelidate/lib/validators";
export default {
        mixins: [validationMixin],
        mounted() {
            /* console.log('Component mounted.'); */
            axios
                .get('/api/category')
                .then(response => {
                    this.topics.push(...response.data.data);
            })
        },
        components: {
            FormComponent,
            SuccesPageComponent 
        },
        data() {
            return {
                url: 'https://www.ticketsystem.loc',
                errors: [],
                form: {
                    name: /* null */'tjade',  
                    name2: /* null */ 'wiese',
                    customernumber: /* null */ '00020', 
                    email: /* null */ 'tjade.wiese@gmail.com',
                    topic: null,
                    text: /* null */ 'hallo mein name ist tjade wiese, test test'
                },
                topics: [
                    {
                        selected: true,
                        id: null,
                        topic: 'Bitte Auswählen'
                    }
                ]
            }
        },
        validations: {
            form: {
                name: {
                    required,
                    minLength: minLength(3)
                },
                customernumber: {
                    required,
                    maxLength: maxLength(5),
                    minLength: minLength(5),
                },
                text: {
                    required,
                    minLength: minLength(25)
                }
            }
        }, 
        methods:{
            validateState(name) {
                const { $dirty, $error } = this.$v.form[name];
                return $dirty ? !$error : null;
            },
            
            onSubmit(evt) {
                evt.preventDefault(); 

                this.errors = [];  

                this.$v.form.$touch();
                if (this.$v.form.$anyError) {
                    this.errors.push('Hallo Fehler');
                }

                if (!this.form.name) {
                    this.errors.push('First Name required.');
                }

                if (!this.form.name2) {
                    this.errors.push('Last Name required.');
                }

                if (!this.form.customernumber) {
                    this.errors.push('Customernumber required.');
                }
                
                if (!this.form.email) {
                    this.errors.push('email required.');
                }
                else if (!this.validEmail(this.form.email)) {
                    this.errors.push('Valid email required.')
                }

                if (!this.form.topic){
                    this.errors.push('Select a topic')
                }

                if (!this.form.text) {
                    this.errors.push('Text required.');
                }

                if (this.form.name && this.form.name2 && this.form.customernumber && this.form.email && this.form.topic && this.form.text && this.$v.form.$anyError) {
                    return true; 
                }  
                if (this.errors.length == 0) {
                    axios
                        .post('/api/entry',{
                            formData: this.form
                        })
                        .then(response => {
                            this.entry = response.data.data;
                            this.$emit('completed', true, this.entry)
                        })  
                        .catch(error => {
                            console.log("failure" + response)
                            this.$emit('failed', true)
                        })
                }

            },
            validEmail: function (email) {
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            onReset(evt) {
                //if (this.errors.length == 0) {    
                    //evt.preventDefault();
                    this.form.name = null;
                    this.form.name2 = null;
                    this.form.customernumber = null;
                    this.form.email = null;
                    this.form.text = null;
                //}
            }
        },
        computed: {
            isDisabled: function() {
                return !( this.form.name && this.form.name2 && this.form.customernumber && this.form.email && this.form.topic && this.form.text && !this.$v.$error);
            }
        }
    }
</script>
 