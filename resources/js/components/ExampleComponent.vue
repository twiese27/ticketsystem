<template>
    <div class="container">
        <p style="color: red;">testtext</p>
        <form>
            <button style="background-color: #0000ff; /* Green */
                                                border: none;
                                                color: white;
                                                padding: 15px 32px;
                                                text-align: center;
                                                text-decoration: none;
                                                display: inline-block;
                                                font-size: 16px; margin-bottom: 20px;">Drück mich
            </button>
        </form>
        <form>
            <button variant='danger' type="button" class="btn btn-primary" style="margin-bottom: 20px;">Drück mich mit Bootstrap</button>
        </form>
        <div>
            <b-button>Button</b-button>
            <b-button variant="danger">Button</b-button>
            <b-button variant="success">Button</b-button>
            <b-button variant="outline-primary">Button</b-button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
    import { ButtonPlugin } from 'bootstrap-vue'
    Vue.use(ButtonPlugin)
</script>
