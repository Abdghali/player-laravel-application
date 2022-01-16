<template>
  <default-field
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    :full-width-content="true"
  >
    <template slot="field">
      <div>
        <div>
          <GmapAutocomplete
            class="w-full form-control form-input form-input-bordered"
            @place_changed="setPlace"
            :placeholder="field.name"
          />
        </div>
        <br />
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
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ["resourceName", "resourceId", "field"],

  data() {
    return {
      center: { lat: this.field.lat, lng: this.field.lng },
      currentPlace: null,
      markers: [],
      places: [],
      location: {},
    };
  },
  mounted() {
    this.geolocate();
  },
  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || "";

      if (this.value) {
        setTimeout(() => {
          const location = JSON.parse(this.value);

          const marker = {
            lat: location.latlng.lat,
            lng: location.latlng.lng,
          };

          this.address = location.value;

          this.center = marker;

          this.markers.push({ position: marker });
        }, 100);
      }
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      let location = null;

      if (this.location) {
        location = {
          latlng: this.location.latlng,
          value: this.location.value,
        };
      }
      formData.append(this.field.attribute, JSON.stringify(location) || "");
    },

    setPlace(place) {
      this.currentPlace = place;
      this.location.value = place.formatted_address;
      this.addMarker();
    },
    addMarker() {
      if (this.currentPlace) {
        const marker = {
          lat: this.currentPlace.geometry.location.lat(),
          lng: this.currentPlace.geometry.location.lng(),
        };

        this.location.latlng = marker;

        this.markers = [];
        this.places = [];

        this.markers.push({ position: marker });
        this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
      }
    },
    geolocate: function () {
      navigator.geolocation.getCurrentPosition((position) => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };
      });
    },
  },
};
</script>
