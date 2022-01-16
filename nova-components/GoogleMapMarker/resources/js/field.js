import * as VueGoogleMaps from 'vue2-google-maps'

Nova.booting((Vue, router, store) => {
  Vue.component('index-google-map-marker', require('./components/IndexField'))
  Vue.component('detail-google-map-marker', require('./components/DetailField'))
  Vue.component('form-google-map-marker', require('./components/FormField'))

  Vue.use(VueGoogleMaps, {
    load: {
      key:  'AIzaSyA9gdc4pIdINj3Ys_eh6jyiyTGRZYq-FFg',
      libraries: 'places',
    }
  });
})
