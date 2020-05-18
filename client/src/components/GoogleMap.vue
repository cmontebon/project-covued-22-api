<template>
    <gmap-map
        ref="mapRef"
      :center="center"
      :zoom="12"
      style="width:100%;  height: 100vh;"
    >
    </gmap-map>
</template>

<script>
export default {
  name: "GoogleMap",
  data() {
    return {
      // default to Montreal to keep it simple
      // change this to whatever makes sense
      center: { lat: 8.4538283, lng: 124.6301833 },
      markers: [],
      places: [],
      currentPlace: null
    };
  },
  mounted() {
    this.$refs.mapRef.$mapPromise.then((map) => {
        var self = this;
        let latlon = new google.maps.MVCArray();

        var response = {
            "success": true,
            "data": [
                {
                "id": 1,
                "age": 58,
                "classification": "PUI",
                "brgy_id": 1,
                "created_at": "2020-05-17 21:10:49",
                "updated_at": "2020-05-17 21:10:49",
                "barangay": {
                    "id": 1,
                    "name": "Nazareth",
                    "lat_long": "8.4710803,124.6461613",
                    "created_at": "2020-05-17 21:09:28",
                    "updated_at": "2020-05-17 22:24:02"
                }
                },
                {
                "id": 3,
                "age": 69,
                "classification": "PUM",
                "brgy_id": 1,
                "created_at": "2020-05-17 21:32:50",
                "updated_at": "2020-05-17 22:06:24",
                "barangay": {
                    "id": 1,
                    "name": "Nazareth",
                    "lat_long": "8.4710803,124.6461613",
                    "created_at": "2020-05-17 21:09:28",
                    "updated_at": "2020-05-17 22:24:02"
                }
                }
            ],
            "message": "Covid cases retrieved successfuly."
            }

        response.data.forEach(function(_case) {
            let coord = _case.barangay.lat_long.split(',')
            console.log(coord);
            latlon.push(new google.maps.LatLng(coord[0], coord[1]));
        });

        let x = new google.maps.visualization.HeatmapLayer({
            data: latlon,
            map: self.$refs.mapRef.$mapObject
        });   
    })
  },
  methods: {
    
  }
};
</script>