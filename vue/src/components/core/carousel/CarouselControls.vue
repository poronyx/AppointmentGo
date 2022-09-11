<template>
  <!-- in vue 2.x you need wrap these buttons in a div -->

  <button class="carousel-control left bg-gray-800 text-white rounded-r-md py-2 border-l border-gray-200 hover:text-white px-3" @click="$emit('prev')">
    <div class="flex flex-row align-middle">
      <svg class="w-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
          clip-rule="evenodd"></path>
      </svg>
    </div>
  </button>
  <button class="carousel-control right bg-gray-800 text-white rounded-l-md py-2 border-l border-gray-200 hover:text-white px-3" @click="$emit('next')">
    <div class="flex flex-row align-middle">
      <svg class="w-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
          clip-rule="evenodd"></path>
      </svg>
    </div>
  </button>
</template>

<script>

export default {
  emits: ["prev", "next"], // vue v3
};
</script>
<style scoped>
.carousel-control {
  background-color: rgba(0, 0, 0, 0.5);
  border: none;
  display: inline-block;
  position: absolute;
  height: 50px;
  width: 70px;
  top: calc(50% - 25px);
  color: #f3f3f3;
  cursor: pointer;
}

.left {
  left: 0;
}

.right {
  right: 0;
}
</style>
