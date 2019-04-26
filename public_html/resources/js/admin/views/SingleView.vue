<template>
    <component v-if="getComponent !== null" :is="getComponent"></component>
</template>

<script>
    const ListView = resolve => {
        require.ensure(['../views/ListView.vue'], () => {
            resolve(require('../views/ListView.vue'))
        })
    };
    const FormView = resolve => {
        require.ensure(['../views/FormView.vue'], () => {
            resolve(require('../views/FormView.vue'))
        })
    };
    const FileManagerView = resolve => {
        require.ensure(['../views/FileManagerView.vue'], () => {
            resolve(require('../views/FileManagerView.vue'))
        })
    };
    const UpdateSettingFormView = resolve => {
        require.ensure(['../views/settings/FormView.vue'], () => {
            resolve(require('../views/settings/FormView.vue'))
        })
    };
    const Profile = resolve => {
        require.ensure(['../views/Profile.vue'], () => {
            resolve(require('../views/Profile.vue'))
        })
    };
    const Dashboard = resolve => {
        require.ensure(['../views/Dashboard.vue'], () => {
            resolve(require('../views/Dashboard.vue'))
        })
    };

    import view_mixin from '../mixins/RouterViewMixin.vue';
    export default {
        mixins:[view_mixin],
        components:{ListView,FormView,FileManagerView,UpdateSettingFormView,Profile,Dashboard},
        computed:{
            getComponent(){
                let component=null;
                switch (this.action){
                    case 'create':
                    case 'edit':
                        component='FormView';
                        break;
                    case 'listView':
                        component='ListView';
                        break;
                    case 'showFileManager':
                        component='FileManagerView';
                        break;
                    case 'updateSettings':
                        component='UpdateSettingFormView';
                        break;
                    case 'show':
                        switch (this.resource){
                            case 'profile':
                                component='Profile';
                                break;
                            case 'dashboard':
                                component='Dashboard';
                                break;
                        }
                        break;
                }
                return component;
            }
        }
    }
</script>