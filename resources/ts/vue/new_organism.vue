<template>

   
   <div>
        <h2> Add New Organism </h2>

        <form class="pure-form pure-form-stacked" @submit.prevent="">
            <fieldset class="pure-group">
                <input
                    type="text"
                    v-model="genus"
                    placeholder="Genus"
                    class="pure-input-1"
                >
                <input
                    type="text"
                    v-model="species"
                    placeholder="Species"
                    class="pure-input-1"
                >
            </fieldset>

            <p>{{ msg }}</p>

            <button
                class="pure-button pure-button-primary pure-input-1"
                @click="onClick"
            > Create </button>

        </form>

   </div>


</template>


<style lang="scss" scoped >

</style>


<script lang="ts">

import {Vue, Component, Prop, Watch} from 'vue-property-decorator';
import axios from 'axios';




@Component({})
export default class NewOrganismVue extends Vue {

    genus = ''
    species = '';
    msg = 'Status';

    async onClick(){

        const data = {
            genus: this.genus,
            species: this.species,
        }

        this.msg = 'Adding new organism';

        try {
            if (this.genus && this.species) {
                const response = await axios.post('/api/organisms/', data);
                this.msg = 'Success';
            } else this.msg = 'Fields cannot be empty';
        } catch (e){
            if (axios.isAxiosError(e) && e.response) {
                this.msg = e.response.data.error;
            } else {
                this.msg = 'Other error'
            }

        }


    }

}
</script>
