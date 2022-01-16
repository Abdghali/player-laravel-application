<template>
  <panel-item :field="field">
    <template slot="value">
      <div v-if="location.value">
        <p class="text-90 mb-2">{{ location.value }}</p>
        <GmapMap
          :center="center"
          :zoom="field.zoom"
          style="width: 100%; height: 400px"
        >
          <GmapMarker
            :key="index"
            v-for="(m, index) in markers"
            :position="m.position"
            @click="center = m.position"
          />
        </GmapMap>
      </div>
      <div v-else>--</div>
    </template>
  </panel-item>
</template>

<script>
export default {
  props: ["resource", "resourceName", "resourceId", "field"],
  mounted() {
    this.location = JSON.parse(this.field.value) || "";

    if (this.location) {
      // Add a little delay to fix panTo not registering on update
      setTimeout(() => {
        const marker = {
          lat: this.location.latlng.lat,
          lng: this.location.latlng.lng,
        };

        this.center = marker;

        this.markers.push({ position: marker });
      }, 100);
    }
  },
  data() {
    return {
      center: { lat: this.field.lat, lng: this.field.lng },
      currentPlace: null,
      markers: [],
      places: [],
      location: {},
    };
  },
};
</script>
