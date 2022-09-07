<template>
  <div class="counter">
    <h1>FizzBuzz</h1>
    <h2>{{ count }}</h2>
    <button id="button" v-on:click="count+=1">+1</button>
  </div>
</template>

<script>
export default {
  name: 'Counter-test',
  data() {
    return {
      count : 0
    }
  }
}
</script>