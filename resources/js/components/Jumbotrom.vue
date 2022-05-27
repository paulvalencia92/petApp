<template>
  <mdb-card class="card-image"
            style="background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient12.webp)">
    <div class="text-white text-center py-5 px-4 my-5">
      <div>
        <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>App Pets</strong></h2>
        <p class="mx-5 mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias architecto aut blanditiis
          consequuntur corporis cupiditate dolore dolorem eveniet explicabo illum impedit inventore ipsam laboriosam
          minus molestias nam natus nihil obcaecati placeat, qui quos recusandae repellat reprehenderit saepe sapiente
          soluta vero voluptatibus? Ad amet architecto atque corporis culpa delectus.
        </p>
        <slot name="action"></slot>

      </div>
    </div>
  </mdb-card>
</template>

<script>
import {mdbCard} from 'mdbvue';

export default {
  name: "Jumbotrom",
  components: {
    mdbCard
  }
}
</script>

<style scoped>

</style>
