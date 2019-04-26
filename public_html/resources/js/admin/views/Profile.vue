<template>
    <div v-if="!loading">
        <basic_info></basic_info>
        <personal_info></personal_info>
        <about_user></about_user>
        <update_password></update_password>
    </div>

</template>

<script>
    import basic_info from '../view_components/profile/BasicInfo.vue'
    import personal_info from '../view_components/profile/PesonalInfo.vue'
    import about_user from '../view_components/profile/AboutUser.vue'
    import update_password from '../view_components/profile/UpdatePassword.vue'
    import {mapGetters, mapMutations} from 'vuex';

    export default {
        components: {basic_info, personal_info, about_user, update_password},
        computed: {
            ...mapGetters(['loading', 'user']),
        },
        methods: {
            ...mapMutations('form', ['setModel']),
        },
        mounted() {
            this.setModel(this.user);
        }
    }
</script>

<style>
    .fade-enter{
        opacity: 0;
    }
    .fade-enter-active{
        transition: opacity 1s;
        /*-webkit-animation: slide-in 1s ease-out forwards;*/
        /*-o-animation: slide-in 1s ease-out forwards;*/
        /*animation: slide-in 1s ease-out forwards;*/
    }
    .fade-leave{
    }
    .fade-leave-active{
        transition: opacity 1s;
        opacity: 0;
        /*-webkit-animation: slide-out 1s ease-out forwards;*/
        /*-o-animation: slide-out 1s ease-out forwards;*/
        /*animation: slide-out 1s ease-out forwards;*/
    }

    @keyframes slide-in {
        from{
            transform: translateY(20px);
        }
        to{
            transform: translateY(0);
        }
    }
    @keyframes slide-out {
        from{
            transform: translateY(0);
        }
        to{
            transform: translateY(20px);
        }
    }
</style>