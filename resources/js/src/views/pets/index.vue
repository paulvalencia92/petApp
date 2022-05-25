<template>
  <div>
    <mdb-btn>Crear Bandida</mdb-btn>
  </div>
</template>

<script>
import {
  mdbBtn
} from 'mdbvue';
export default {
  name: "index",
  components: {mdbBtn},
  created() {
    this.getPets();
  },
  methods: {
    async getPets() {
      const response = await axios.get('/api/pets');
      console.log(response.data)
    }
  }
}
</script>

<style scoped>

</style>
