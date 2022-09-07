<template>
  <div class="login">
    <div class="form-item">
      <label for="name">Name</label>
      <input
        id="name"
        autocomplete="off"
        type="text"
        v-model="name"
      >
    </div>
    <div class="form-item">
      <label for="email">Email</label>
      <input
        id="email"
        autocomplete="off"
        type="text"
        v-model="email"
      >
    </div>
    <div class="form-item">
      <label for="password">Password</label>
      <input
        id="password"
        autocomplete="off"
        type="password"
        v-model="password"
      >
    </div>
    <div class="form-item">
      <button class="button" @click="createNewUser">新規登録</button>
    </div>
  </div>
</template>


<script>
import axios from 'axios';
export default({
  data () {
    return {
      name: '',
      email: '',
      password: '',
    }
  },
  methods : {
    createNewUser: async function() {
      await axios.get('/api/signup',{
            name: this.name,
            email: this.email,
            password: this.password,
            // headers: {
            //   "Content-Type": "application/json"
            // }
          })
          .then((res) => {
            console.log(res);
          })
          .catch((err) => {
            console.log(err);
          });
    }
  }
})

</script>