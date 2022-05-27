<template>
  <div>

    <Jumbotrom>
      <template v-slot:action>
        <mdb-btn color="primary" @click="toGoPetsList">Lista de mascotas</mdb-btn>
      </template>
    </Jumbotrom>


    <mdb-container>
      <mdb-row class="d-flex justify-content-center mt-4">
        <mdb-col col="8" v-if="pet">
          <mdb-card>
            <mdb-card-image :src="`/storage/pets/${pet.photoUrls}`"></mdb-card-image>
            <mdb-card-body>
              <mdb-card-title><b>Nombre:</b> {{ pet.name }}</mdb-card-title>
              <mdb-card-title v-if="pet.category"><b>Categoria:</b> {{ pet.category.name }}</mdb-card-title>
              <mdb-btn size="sm" :color="pet.status | statusColors">{{ pet.status }}</mdb-btn>
              <hr>
              <div v-if="pet.tags.length">
                <p class="lead">Tags</p>
                <mdb-badge v-for="tag in pet.tags" :key="tag.id" color="primary" class="mr-2">
                  {{ tag.name }}
                </mdb-badge>
              </div>
            </mdb-card-body>
          </mdb-card>
        </mdb-col>

      </mdb-row>
    </mdb-container>


  </div>
</template>

<script>
import axios from 'axios'
import Jumbotrom from "../../../components/Jumbotrom";
import petDetails from './details'
import {
  mdbContainer, mdbRow, mdbCol, mdbBtn, mdbCardImage,
  mdbCard, mdbCardBody, mdbCardTitle, mdbCardText, mdbBadge
} from 'mdbvue';


export default {
  name: "show",
  props: ['id'],
  components: {
    Jumbotrom,
    petDetails,
    mdbRow, mdbContainer, mdbCol, mdbBtn,
    mdbCard, mdbCardImage, mdbCardBody, mdbCardTitle, mdbCardText, mdbBadge
  },
  created() {
    this.findPet();
  },
  data() {
    return {
      pet: null
    }
  },
  methods: {
    async findPet() {
      const response = await axios.get('/api/pet/' + this.id);
      this.pet = response.data;
    },
    toGoPetsList() {
      this.$router.push({name: 'pets'})
    }
  },
  filters: {
    statusColors(value) {
      let color = "";
      if (value == 'available') {
        color = 'success';
      } else if (value == 'pending') {
        color = 'warning';
      } else if (value == 'sold') {
        color = 'danger';
      }
      return color
    }
  }
}
</script>

<style scoped>

</style>
