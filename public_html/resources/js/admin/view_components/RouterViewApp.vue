<template>
    <transition name="fade" mode="out-in">
        <router-view v-if="!loading"></router-view>
    </transition>
</template>

<script>
    import view_mixin from '../mixins/RouterViewMixin.vue';

    export default {
        mixins: [view_mixin]
    }
</script>