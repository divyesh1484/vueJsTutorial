<script>
  export default{
    inject:['location','updateLocation'],
    props:{
      firstname : String,
      lastname : String,
      increaseBy : Function
    }
    ///emits: ['update:firstname', 'update:lastname']
  }
</script>

<template>
<button @click="this.updateLocation">{{ this.location }}</button>
<p>
  Message to grand child: {{ this.location }}
</p>

<input type="text" :value="firstname" @input="$emit('update:firstname', $event.target.value)" />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" :value="lastname" @input="$emit('update:lastname', $event.target.value)" />

<button @click="$emit('increaseBy', 1)">
  Increase by 1
</button>

</template>