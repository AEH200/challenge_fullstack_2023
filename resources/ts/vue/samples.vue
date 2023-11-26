<template>

   <div>
       <h2> Sample list ({{ samples.length }}) </h2>

        <table class="pure-table pure-table-horizontal">
            <thead>
                <tr>
                    <th>Sample code</th>
                    <th>#Abundances</th>
                    <th>Crop</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="sample of samples" :key="sample.code">
                    <td>{{ sample.code }}</td>
                    <td>{{ sample.abundances_count }}</td>
                    <!-- Compobamos la existencia de la relación -->
                    <td >{{ sample.crops ? sample.crops.name : '' }}</td>
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

/**
 * Type of the sample
 */
type SampleT = {
    code: string;
    abundances_count: number;
}

/**
 * This component shows a list of samples with (code and number of abundances)
 */
@Component({})
export default class SamplesVue extends Vue {

    // The list of samples that we receive from the server 
    samples: SampleT[] = [];

    mounted(){
        // Load the samples when the component gets mounted
        this.loadSamples();
    }

    /**
     * Recieve the samples from the api endpoint
     */
    async loadSamples(){
        this.samples = (await axios.get('/api/samples/')).data;
    }

}
</script>
