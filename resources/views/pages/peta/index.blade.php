@extends('components.layout')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
{{-- <link rel="stylesheet" href="{{ asset('assets/Leaflet.BigImage.css') }}">
<script src="{{ asset('assets/Leaflet.BigImage.js') }}"></script> --}}
<style>
    #mapid {
        height: 100vh;
    }
</style>
@endsection

@section('page_content')
<div class="row">
    <div class="col">
        <div id="mapid"></div>
        <div id="images"></div>
    </div>
</div>
@endsection

@section('optional_scripts')
<script src="{{ asset('assets/leaflet-image.js') }}"></script>
<script src="{{ asset('assets/vendor/Leaflet.print/src/Control.Print.js') }}"></script>
<script src="{{ asset('assets/vendor/Leaflet.print/src/copyright.js') }}"></script>
<script src="{{ asset('assets/vendor/Leaflet.print/src/print.Provider.js') }}"></script>
<script>
$.get('/file/Boyolangu.json', function(data) {
    generateMap(data)
})
function generateMap(myLines) {
    var mymap = L.map('mapid').setView([-8.101359, 111.89919900000011], 13);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(mymap);

    var myLayer = L.geoJSON(myLines, {
        style: function(feature) {
            var orig_ogc_fid = feature.properties.orig_ogc_fid
            var color = {
                color: '#5E72E4',
                fillOpacity: 0.5
            }
            if (orig_ogc_fid > 50 && orig_ogc_fid < 100) {
                color.fillColor = 'orange'
            } else if (orig_ogc_fid > 100) {
                color.fillColor = 'red'
            } else {
                color.fillColor = 'green'
            }
            color.fillColor = 'transparent'
            return color;
        },
        onEachFeature: function(feature, layer) {
            layer.bindPopup(feature.properties.NAMOBJ)
            layer.bindTooltip(feature.properties.A4N_BPS, {
                permanent: true,
                direction: 'top'
            })
        }
    }).addTo(mymap);
    myLayer.addData(myLines);
    // var myIcon = L.icon({
    //     iconUrl: window.location.origin + '/file/foto/2021/skck/2-Lambang-tulungagung.jpeg',
    //     iconSize: [70, 'auto']
    // });
    // L.marker([-8.12529, 111.882], {
    //     icon: myIcon
    // }).addTo(mymap)
    var potensiWisata = [
        {
            latLng: [-8.1158774,111.9172392],
            name: 'Candi Sanggrahan',
            image: 'https://lh5.googleusercontent.com/p/AF1QipNPdSiuo6_pZQJHahlWgmWwWWkQLAv8VtAwdNbU=w408-h306-k-no'
        },
        {
            latLng: [-8.1162671,111.8871612],
            name: 'Candi Gayatri',
            image: 'https://lh5.googleusercontent.com/p/AF1QipOR49XO7NW292ZE0tkGB-WQEJmlkyJTtDFUk8U=w408-h306-k-no'
        },
        {
            latLng: [-8.1187522,111.9220852],
            name: 'Tangga Sewu Boyolangu',
            image: 'https://lh5.googleusercontent.com/p/AF1QipNXjDRfa-wTrtkEczqVMXHlooflGiPxEe2D276Z=w408-h306-k-no'
        },
        {
            latLng: [-8.1137542,111.8813596],
            name: 'Nangkula Park',
            image: 'https://lh5.googleusercontent.com/p/AF1QipNX_8cdws7yNpGnx_Uc5buwwqZ-R6BQBoEijLfX=w426-h240-k-no'
        },
        {
            latLng: [-8.0960442,111.8740284],
            name: 'Njegong Park',
            image: 'https://lh5.googleusercontent.com/p/AF1QipOkXtJ5DWdABxGcj4tI7PMwf_QHonPzrcX438hN=w426-h240-k-no'
        },
        {
            latLng: [-8.1248923,111.912266],
            name: 'Selo Green',
            image: 'https://lh5.googleusercontent.com/p/AF1QipPeb1n_b3jdIJUw0wMNx9c1egPYHxN0ACbPde1l=w408-h306-k-no'
        },
        {
            latLng: [-8.0918251,111.873743],
            name: 'Agro Wisata Blimbing Mulyono',
            image: 'https://lh5.googleusercontent.com/p/AF1QipOto5YFIuWQuE8uK9eZZlsuItCIyXcz0m0FmR3m=w408-h306-k-no'
        },
        {
            latLng: [-8.0963094,111.8697181],
            name: 'Tegal Pule',
            image: 'https://lh5.googleusercontent.com/p/AF1QipOtsqa3D1buRzC2eU-Fl8j28U-fessQFj-ZKIzx=w408-h408-k-no'
        },
        {
            latLng: [-8.1276414,111.9147386],
            name: 'Goa Selomangleng',
            image: 'https://lh5.googleusercontent.com/p/AF1QipPXa8awCCjcqjxw-cTjB4a35b00C2s-I5z-ZJOv=w426-h240-k-no'
        },
        {
            latLng: [-8.0839061,111.8898826],
            name: 'Kolam Renang Azka Tirta',
            image: 'https://lh5.googleusercontent.com/p/AF1QipMg698vildLAdnXEYJP0Hpid5QhillVJt_afRvE=w408-h306-k-no'
        },
        {
            latLng: [-8.0781096,111.892505],
            name: 'Brond Waterpark',
            image: 'https://lh5.googleusercontent.com/p/AF1QipPAC3-Mkk5Zwl-Pdzw7rz4jmEysHvre03_aQKhP=w408-h306-k-no'
        },
        {
            latLng: [-8.0853551,111.9073663],
            name: 'Kolam Renang Banyu Biru',
            image: 'https://lh5.googleusercontent.com/p/AF1QipMa_AAOG-fBcnJ-cQaXUhvSxucAJ15zHAfipv7X=w408-h544-k-no'
        },
        // Gambar perlu diganti
        {
            latLng: [-8.1180, 111.9036],
            name: 'Wisata Watu Joli',
            image: window.location.origin + '/file/foto/potensi_kecamatan/watu_joli.jpg'
        },
        {
            latLng: [-8.1221, 111.9079],
            name: 'Taman Sowono',
            image: window.location.origin + '/file/foto/potensi_kecamatan/taman_sowono.jpg'
        },
        {
            latLng: [-8.1193, 111.9236],
            name: 'Gunung Cilik Park',
            image: window.location.origin + '/file/foto/potensi_kecamatan/gcp.jpg'
        },
        {
            latLng: [-8.1183, 111.9235],
            name: 'Industri Cowek Desa Sanggrahan',
            image: window.location.origin + '/file/foto/potensi_kecamatan/industri_cowek.jpg'
        },
        {
            latLng: [-8.1032, 111.9090],
            name: 'Sumur Jobong',
            image: window.location.origin + '/file/foto/potensi_kecamatan/sumur_jobong.jpg'
        },
        {
            latLng: [-8.1028, 111.9110],
            name: 'Budidaya Ikan Desa Wajak Lor',
            image: window.location.origin + '/file/foto/potensi_kecamatan/budidaya_ikan_wajak_lor.jpg'
        },
    ]
    potensiWisata.forEach(function(value) {
        L.popup({
            autoClose: false,
            closeOnClick: false,
            closeOnEscapeKey: false,
            closeButton: false
        })
            .setLatLng(value.latLng)
            .setContent('<table style="text-align: center;"><tbody><tr><td><img width="150" src="'+value.image+'" alt=""></td></tr><tr><td><b>'+value.name+'</b></td></tr></tbody></table>')
            .openOn(mymap);
    })
    var printProvider = L.print.provider({
        method: 'GET',
        url: window.location.origin + '/mapfish/print',
        autoLoad: true,
        dpi: 90
    });

    var printControl = L.control.print({
        provider: printProvider
    });        
    mymap.addControl(printControl);
}
</script>
@endsection