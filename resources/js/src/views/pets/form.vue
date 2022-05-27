<template>
  <form class="needs-validation" novalidate @submit.prevent="save">
    <div class="grey-text">

      <div class="form-group">
        <label for="name" class="grey-text">Nombre de la mascota</label>
        <input type="text" id="name" v-model="payload.name" required class="form-control"/>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>


      <div class="form-group">
        <label class="grey-text">Categoria</label>
        <select class="form-control" v-model="payload.category_id" required>
          <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
        </select>
      </div>

      <div class="form-group">
        <label class="grey-text">Estado</label>
        <select class="browser-default custom-select" v-model="payload.status" required>
          <option value="available">available</option>
          <option value="pending">pending</option>
          <option value="sold">sold</option>
        </select>
      </div>


      <div class="form-group">
        <label class="grey-text">Tags</label>
        <select class="browser-default custom-select" multiple v-model="payload.tags">
          <option v-for="tag in tags" :value="tag.id" selected>{{ tag.name }}</option>
        </select>
      </div>

      <div class="form-group">
        <label for="name" class="grey-text">Imagen de la mascota</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Cargar</span>
          </div>
          <div class="custom-file">
            <input @change="onFileChange" type="file" class="custom-file-input" id="inputGroupFile01"
                   aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">{{ imgDesc }}</label>
          </div>
        </div>
      </div>


      <figure v-if="picture != ''">
        <img width="200" height="200" :src="picture" alt="Img miniatura">
      </figure>


    </div>
    <div class="text-right">
      <mdb-btn type="submit" color="primary">Guardar</mdb-btn>
    </div>
  </form>
</template>

<script>
import {
  mdbInput,
  mdbBtn,
  mdbContainer
} from 'mdbvue';

export default {
  name: "formPet",
  props: ['pet'],
  components: {
    mdbInput,
    mdbBtn,
    mdbContainer,
  },
  created() {
    if (this.pet) {
      this.payload = this.pet;
      this.payload.tags = this.pet.tags.map(item => item.id);
      this.payload.photoUrls = "";
    }
    this.getCategories();
    this.getTags();
  },
  data() {
    return {
      categories: [],
      tags: [],
      payload: {
        name: '',
        category_id: '',
        status: '',
        tags: [],
        photoUrls: '',
      },
      picture: '',
      imgDesc: 'Elija el archivo...',

    }
  },
  methods: {
    async getCategories() {
      const response = await axios.get('/api/categories');
      this.categories = response.data;
    },
    async getTags() {
      const response = await axios.get('/api/tags');
      this.tags = response.data;
    },
    onFileChange(e) {
      let file = e.target.files[0];
      this.imgDesc = file.name
      this.payload.photoUrls = file;
      this.createImage(file);
    },
    createImage(file) {
      let reader = new FileReader();
      reader.onload = (e) => {
        this.picture = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    save() {
      event.preventDefault();
      event.target.classList.add('was-validated');
      const payload = this.buildFormData();

      this.$emit('save', payload)
    },
    buildFormData() {
      const formData = new FormData();
      for (let prop in this.payload) {
        if (prop == 'tags') {
          if (this.payload[prop].length > 0) {
            formData.append(prop, this.payload[prop])
          }
        } else {
          formData.append(prop, this.payload[prop])
        }
      }
      return formData
    }
  }
}
</script>

<style scoped>

</style>
