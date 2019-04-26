<template>
    <table class="table table-bordered">
        <tbody>
        <tr v-for="model_info in info" v-if="model[model_info.name] !== undefined && !Array.isArray(model[model_info.name])">
            <th style="text-align: center;"><b v-text="$t(resource+':items.'+model_info.name)"> </b></th>
            <td v-html="model[model_info.name]"></td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        computed: {
            ...mapGetters('show',['model','info']),
            ...mapGetters(['resource']),
        },
    }
</script>