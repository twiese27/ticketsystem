<template>
    <div>
        <p class="h1">Ticketsystem</p>
        <vue-good-table v-if="state == 'admin'" :columns="columns" :rows="entries"  @on-cell-click="onCellClick"><!-- @on-row-click="onRowClick" -->
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field === 'details'">
                <button type="button" class="btn btn-primary">View Details</button>
                </span>
                <span v-else> {{ props.formattedRow[props.column.field] }} </span>
            </template>
        </vue-good-table>
        <detail-page-component :entries="entries" @answer="onAnswer" @back="getBack" v-if="state == 'success'"></detail-page-component>

        <b-modal ref="my-modal" hide-footer title="Using Component Methods">
            <div class="d-block text-center">
                <h3>Status ändern</h3>
                <b-form-group id="input-group-5"
                          label="Status:"
                          label-for="input-5">
                    <b-form-select id="input-5"
                                v-model="status"
                                :options="statusoptions"
                                value-field="id"
                                text-field="status"
                                >
                    </b-form-select>
                </b-form-group>
            </div>
            <b-button class="mt-3" variant="outline" block @click="hideModal">Speichern und Schließen</b-button>
            <b-button class="mt-2" variant="outline-warning" block @click="toggleModal">Abbrechen</b-button>
        </b-modal>


    </div>

</template>

<script>
import { validationMixin } from "vuelidate";
import { required, minLength, maxLength, numeric, text } from "vuelidate/lib/validators";
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';
import DetailPageComponent from './DetailPageComponent.vue';
export default {
        components: {
            DetailPageComponent,
        },
        mixins: [validationMixin],
        mounted() {
            axios
                .get('/api/entry')
                .then(response => {
                    this.entries = response.data.data;
                    //console.log(this.entries);
                })

        },
        data() {
            return {
                entry: "",
                entries: [],
                state: "admin",
                response: null,
                selectEntry: 0,
                selectEntry2: 0,
                //form: {
                    status: null,
                //,
                statusoptions: [
                    {
                        selected: true,
                        id: null,
                        status: 'Bitte Auswählen'
                    }
                ],
                counter: 0,
                columns: [
                    {
                        label: "Ticketnummer",
                        field: "ticketnumber"
                    },
                    {
                        label: "E-Mail",
                        field: "email"
                    },
                    {
                        label: "Kundennummer",
                        field: "customer_number"
                    },
                    {
                        label: "Thema",
                        field: "category.topic"
                    },
                    {
                        label: "Nachricht",
                        field: "text"
                    },
                    {
                        label: "Datum",
                        field: "created_at"
                    },
                    {
                        label: "status",
                        field: "status_id",
                        type: "number"
                    }
                ]
            }
        },
        methods:{
            onCellClick(entries) {
                this.selectEntry = entries.rowIndex;
                this.selectEntry2 = entries.column.field;
                if (this.entries[this.selectEntry].status_id == 2  || this.entries[this.selectEntry].status_id == 1) {
                    if ((this.entries[this.selectEntry].status_id == 2  || this.entries[this.selectEntry].status_id == 1) && this.selectEntry2 == 'status_id') {
                        axios
                            .get('/api/statusoptions')
                            .then(response => {
                                this.statusoptions.push(...response.data.data);
                                //console.log(this.entries);
                            })
                        this.showModal();
                    }
                    else {
                        this.state = "success";
                        //this.selectEntry = entries.pageIndex;
                        this.entries = entries;
                    }

                }
                else {
                    //console.log(this.selectEntry);
                    console.log(this.selectEntry2);
                }
            },
            showModal() {
                this.$refs['my-modal'].show()
            },
            hideModal() {
                this.statusoptions = null;
                this.$refs['my-modal'].hide()
                if (this.status.id != 0 || this.status.id != 3)
                    axios
                        .post('/api/statusoptions',{
                            changedStatus: this.status,
                            temporaryEntry: this.entries[this.selectEntry]
                        })
                        .then(response => {
                            this.entry = response.data.data;
                            this.$emit('completed', true, this.entry)
                        })
                        .catch(error => {
                            console.log("failure" + response)
                            this.$emit('failed', true)
                        })
                location.reload();
            },
            toggleModal() {
                this.statusoptions = null;
                this.$refs['my-modal'].toggle('#toggle-btn')
                location.reload();
            },
            onAnswer: function (success, entry) {
                this.state = 'admin';
                this.get();
            },
            getBack () {
                location.reload();
            },
            get() {
                axios
                .get('/api/entry')
                .then(response => {
                    this.entries = response.data.data;
            })
            }
        }
    }
</script>
