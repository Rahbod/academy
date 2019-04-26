<template>
    <input class="form-control" :class="{hasError:'border-danger'}" :type="info.type" v-model="input_value"
           :name="getName(info.name)" :id="getId(info.name)">
</template>

<script>
    import InputMixin from '../../../../mixins/InputMixin.vue'

    export default {
        mixins: [InputMixin],
    }
</script>