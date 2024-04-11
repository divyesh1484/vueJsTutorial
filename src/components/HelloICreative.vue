<template>
  <div class="hello">
    <h1>Hello {{ company }} !!</h1>
    <p>
      We are a specialized ecommerce development agency. Grow your sales with our expertise. Our Consultants have the industry experience you need to work with your business, your customers, and the industry successfully. We have professional ecommerce Consultants with over 10 years of experience providing the perfect web solutions.
      <a href="https://icreativetechnologies.com/#homepage" target="_blank" rel="noopener">Get in Touch</a>.
    </p>
    <h3>About ICreative</h3>
    <p> Founded in 2014, we at  iCreative Technologies  Inc. work with passion to bring your ideas to life and create stunning Web and Mobile applications for our Partners. Customer support being a demanding service, our  Ecommerce enablers  have an expert team to manage this professionally. We focus on building brand image and boosting your sales up.</p>
  </div>
</template>

<script>
export default {
  name: 'HelloICreative',
  props: {
    company: String
  }
}
</script>

<style lang="css" scoped>
</style>