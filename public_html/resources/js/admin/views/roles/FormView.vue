<template>
    <BasicForm></BasicForm>
</template>

<script>
    import BasicForm from '../../view_components/forms/RoleForm.vue'
    import view_mixin from '../../mixins/form/FormViewMixin.vue';

    import {mapActions,mapMutations,mapGetters} from 'vuex';

    export default {
        components: {BasicForm},
        mixins:[view_mixin],

    }
</script>
