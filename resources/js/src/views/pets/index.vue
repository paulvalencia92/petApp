<template>
  <div>

    <Jumbotrom>
      <template v-slot:action>
        <mdb-btn color="primary" @click="registerPet">Registrar mascota</mdb-btn>
      </template>
    </Jumbotrom>

    <mdb-container>
      <mdb-row>

        <mdb-col col="12" class="text-center mt-4">
          <mdb-btn-group>
            <mdb-btn color="success" @click="searchByStatus('available')">Disponible</mdb-btn>
            <mdb-btn color="warning" @click="searchByStatus('pending')">Pendiente</mdb-btn>
            <mdb-btn color="danger" @click="searchByStatus('sold')">Vendido</mdb-btn>
            <mdb-btn color="primary" @click="getPets()">Todos</mdb-btn>
          </mdb-btn-group>
        </mdb-col>

        <mdb-col v-for="pet in pets" :key="pet.id" col="4">
          <petDetails @updateList="updateList" class="mt-4" :pet="pet"></petDetails>
        </mdb-col>
      </mdb-row>
    </mdb-container>


  </div>

</template>

<script>
import {mdbContainer, mdbRow, mdbCol, mdbBtn, mdbBtnGroup} from 'mdbvue';
import petDetails from "./details";
import Jumbotrom from './../../../components/Jumbotrom'

export default {
  name: "index",
  components: {
    mdbContainer,
    mdbRow,
    mdbCol,
    petDetails,
    mdbBtn,
    mdbBtnGroup,
    Jumbotrom
  },
  created() {
    this.getPets();
  },
  data() {
    return {
      pets: [],
      modal: false,
      show: true
    }
  },
  methods: {
    async getPets() {
      const response = await axios.get('/api/pets');
      this.pets = response.data
    },
    async registerPet() {
      this.$router.push({name: 'add-pet'});
    },
    updateList() {
      this.getPets();
    },
    async searchByStatus(status) {
      const response = await axios.get('/api/pet/findByStatus', {params: {status}});
      this.pets = response.data;
    }
  }
}
</script>

<style scoped>


.placement {
  position: absolute;
  right: 0;
}
</style>
