<template>
  <div>
    <mdb-card>
      <mdb-card-image :src="`/storage/pets/${pet.photoUrls}`"></mdb-card-image>
      <mdb-card-body>
        <mdb-card-title><b>Nombre:</b> {{ pet.name }}</mdb-card-title>
        <mdb-card-title v-if="pet.category"><b>Categoria:</b> {{ pet.category.name }}</mdb-card-title>
        <mdb-btn size="sm" :color="pet.status | statusColors">{{ pet.status }}</mdb-btn>
        <mdb-btn @click="toGoDetails()" size="sm">
          <mdb-icon far icon="eye"/>
        </mdb-btn>

        <hr>

        <div v-if="pet.tags.length">
          <p class="lead">Tags</p>
          <mdb-badge v-for="tag in pet.tags" :key="tag.id" color="primary" class="mr-2">
            {{ tag.name }}
          </mdb-badge>
        </div>

        <hr>
        <p class="lead">Acciones</p>
        <mdb-btn-group>
          <mdb-btn @click="editPet(pet)" color="primary" size="sm">Editar</mdb-btn>
          <mdb-btn @click="modalDeletePet(pet.id)" color="danger" size="sm">Eliminar</mdb-btn>
        </mdb-btn-group>
      </mdb-card-body>
    </mdb-card>

    <!--============================
        MODAL PET
    ==============================-->
    <mdb-modal :show="modal" @close="modal = false">
      <mdb-modal-header>
        <mdb-modal-title>Formulario Mascotas</mdb-modal-title>
      </mdb-modal-header>
      <mdb-modal-body>
        <CardErrorValidation v-if="errors.length" :error-messages="errors"></CardErrorValidation>
        <formPet :pet="petDraf" @save="save"></formPet>
      </mdb-modal-body>
    </mdb-modal>


    <!--============================
        MODAL DELETE PET
    ==============================-->
    <mdb-modal :show="modalDelete" @close="modalDelete = false" danger>
      <mdb-modal-header>
        <mdb-modal-title>Eliminar mascota</mdb-modal-title>
      </mdb-modal-header>
      <mdb-modal-body>
        <p class="lead">¿ Esta seguro que desea eliminar la mascota?</p>
      </mdb-modal-body>
      <mdb-modal-footer center>
        <mdb-btn color="danger" @click="deletePet()">Eliminar
          <mdb-icon icon="gem" far class="ml-1" color="white"/>
        </mdb-btn>
        <mdb-btn outline="danger" @click="modalDelete = false">Cancelar</mdb-btn>
      </mdb-modal-footer>
    </mdb-modal>


  </div>
</template>

<script>

import CardErrorValidation from "../../../components/CardErrorValidation";
import {
  mdbCard,
  mdbCardImage,
  mdbCardBody,
  mdbCardTitle,
  mdbCardText,
  mdbBtn,
  mdbBadge,
  mdbBtnGroup,
  mdbIcon,
  mdbModal,
  mdbModalHeader,
  mdbModalTitle,
  mdbModalBody,
  mdbModalFooter
} from 'mdbvue';
import formPet from './form';

export default {
  name: "PetDetails",
  props: ['pet'],
  components: {
    mdbCard,
    mdbCardImage,
    mdbCardBody,
    mdbCardTitle,
    mdbCardText,
    mdbBtn,
    mdbBadge,
    mdbBtnGroup,
    mdbModal,
    mdbModalHeader,
    mdbModalTitle,
    mdbModalBody,
    mdbModalFooter,
    mdbIcon,
    formPet,
    CardErrorValidation
  },
  created() {
    this.errors = []
  },
  data() {
    return {
      petDraf: null,
      petId: '',
      modal: false,
      modalDelete: false,
      errors: []
    }
  },
  methods: {
    editPet(pet) {
      this.modal = true;
      this.petDraf = JSON.parse(JSON.stringify(pet));
    },
    save(data) {
      this.updatePet(data).then(response => {
        this.$emit('updateList', true)
        this.$toast.success("Mascota actualizada correctamente");
        this.modal = false;
      });
    },
    async updatePet(data) {
      try {
        data.append('_method', 'PUT')
        const response = await axios.post('/api/pet/' + data.get('id'), data);
        return Promise.resolve(response.data);
      } catch (e) {
        this.$toast.error("No se pudo registrar los datos");
        this.errors = Object.values(e.response.data.errors);
        return Promise.reject('danger');
      }

    },
    modalDeletePet(petId) {
      this.petId = petId;
      this.modalDelete = true;
    },
    async deletePet() {
      const response = await axios.delete('/api/pet/' + this.petId);
      this.$emit('updateList', true)
      this.modalDelete = false;
    },
    toGoDetails() {
      this.$router.push({name: 'pet-details', params: {id: this.pet.id}})
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
