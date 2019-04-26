<template>
    <BasicForm @refreshInputData="initView"></BasicForm>
</template>

<script>
    import BasicForm from '../../view_components/forms/UpdateSettingForm.vue'
    import view_mixin from '../../mixins/form/FormViewMixin.vue';

    import {mapActions, mapMutations, mapGetters} from 'vuex';

    export default {
        components: {BasicForm},
        mixins: [view_mixin],
        computed: {
            ...mapGetters(['base_resource_url', 'resource'])
        },
        methods: {
            ...mapMutations('form', ['setLoading', 'updateForm']),
            ...mapActions(['sendRequest']),
            initView() {
                this.resetForm();
                this.getFormData();
            },
            getFormData() {
                this.setLoading(true);
                let url;
                if (this.resource === 'settings') {
                    url = this.base_resource_url + '/update_all_settings';
                }
                else {
                    url = this.base_resource_url + '/settings/form';
                }

                this.sendRequest({url: url, method: 'get', el: this.$el})
                    .then(response => {
                        this.updateForm(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => {
                        this.setLoading(false);
                    });
            }
        }

    }
</script>
