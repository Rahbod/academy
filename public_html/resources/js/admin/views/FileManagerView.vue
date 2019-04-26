<template>
    <file_manager v-if="this.hasAction('showFileManager')"></file_manager>
    <div v-else>
        <div class="alert alert-warning alert-bordered" style="margin: 1rem;">
            شما دسترسی به این بخش ندارید
        </div>
    </div>
</template>

<script>
    import global_mixin from '../mixins/GlobalMixin.vue';
    import file_manager from '../view_components/FileManager.vue'
    export default {
        mixins:[global_mixin],
        components:{file_manager}
    }
</script>