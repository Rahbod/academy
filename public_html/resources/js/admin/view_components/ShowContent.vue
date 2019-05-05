<template>
    <div>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
            <tr>
                <th colspan="2" style="text-align: center"><b v-text="$t(resource+':title')"></b></th>
            </tr>
            </thead>
            <tbody>
            <!--<tr v-for="(model_info,key) in info" v-if="model[model_info.name] !== undefined && !Array.isArray(model[model_info.name])">-->
            <tr v-for="(model_info,key) in info" v-if="key !== 'items' && model[model_info.name] !== undefined">
                <th style="text-align: center;"><b v-text="$t(resource+':items.'+model_info.name)"> </b></th>
                <td v-html="model[model_info.name]"></td>
            </tr>

            <template v-for="relation in info.items"
                      v-if="info.items!== undefined && model[relation.name ]!== undefined && !Array.isArray(model[relation.name])">
                <tr v-for="(model_info,key) in relation.info"
                    v-if="model[relation.name ][model_info.name] !== undefined">
                    <th style="text-align: center;"><b
                            v-text="$t(resource+':items.'+relation.name+'.'+model_info.name)"> </b></th>
                    <td v-html="model[relation.name ][model_info.name]"></td>
                </tr>
            </template>
            </tbody>
        </table>

        <!--<template v-for="relation in info.items"-->
                  <!--v-if="info.items!== undefined && model[relation.name ]!== undefined && !Array.isArray(model[relation.name])">-->
            <!--<table class="table table-bordered table-hover">-->
                <!--<thead class="thead-dark">-->
                <!--<tr>-->
                    <!--<th colspan="2" style="text-align: center"><b v-text="$t(resource+':relations.'+relation.name)"></b>-->
                    <!--</th>-->
                <!--</tr>-->
                <!--</thead>-->
                <!--<tbody>-->
                <!--&lt;!&ndash;<tr v-for="(model_info,key) in info" v-if="model[model_info.name] !== undefined && !Array.isArray(model[model_info.name])">&ndash;&gt;-->
                <!--<tr v-for="(model_info,key) in relation.info"-->
                    <!--v-if="model[relation.name ][model_info.name] !== undefined">-->
                    <!--<th style="text-align: center;"><b-->
                            <!--v-text="$t(resource+':items.'+relation.name+'.'+model_info.name)"> </b></th>-->
                    <!--<td v-html="model[relation.name ][model_info.name]"></td>-->
                <!--</tr>-->
                <!--</tbody>-->
            <!--</table>-->
        <!--</template>-->

    </div>

</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        computed: {
            ...mapGetters('show', ['model', 'info']),
            ...mapGetters(['resource']),
        },
    }
</script>