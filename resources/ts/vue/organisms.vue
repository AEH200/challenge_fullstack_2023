<template>

   
   <div>

       <h2> Organism list ({{ organisms.data.length }}) </h2>

       <table class="pure-table pure-table-horizontal">
            <thead>
                <tr>
                    <th>Genus</th>
                    <th>Species</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="organism of organisms.data" :key="organism.code">
                    <td>{{ organism.genus }}</td>
                    <td>{{ organism.species }}</td>
                </tr>
            </tbody>
        </table>

   </div>


</template>


<style lang="scss" scoped >


</style>


<script lang="ts">

import {Vue, Component, Prop, Watch} from 'vue-property-decorator';
import axios from 'axios';


@Component({})
export default class OrganismsVue extends Vue {

    organisms = [];

    
    mounted(){
        // cargamos la lista de organisms
        this.loadOrganism();
    }

    /**
     * Recieve the samples from the api endpoint
     */
    async loadOrganism(){
        this.organisms = (await axios.get('/api/organisms/')).data;
    }
}
</script>
