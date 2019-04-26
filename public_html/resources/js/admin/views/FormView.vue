<template>
    <BasicForm></BasicForm>
</template>

<script>
    import BasicForm from '../view_components/forms/basic_form/Form.vue'
    import view_mixin from '../mixins/form/FormViewMixin.vue';

    export default {
        components: {BasicForm},
        mixins:[view_mixin],

    }
</script>
