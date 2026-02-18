<title>HANGOUT</title>
<link href="<?php echo base_url('assets/front/css/podcast.css?rand=342070184') ?>" rel="stylesheet" />
<style>
            :root {
            --bg:#faf7f3;
            --card:#fff;
            --accent:#c37b59;
            --accent-dark:#9b6447;
            --muted:#686868;
            --shadow:0 8px 24px rgba(0,0,0,0.08);
            }

            /* Struktur dasar */
            body {
            font-family: 'Noto Sans', sans-serif;
            margin:0;
            color:#000;
            }

            /* Container utama */
            main {
            margin:30px auto;
            padding:0 20px;
            }

            /* Hero section */
            h1 {
            font-size:28px;
            font-weight:700;
            margin-bottom:10px;
            color:#222;
            text-align:center;
            }
            p {
            color:var(--muted);
            font-size:16px;
            max-width:500px;
            margin:0 auto 30px;
            text-align:center;
            }
	h3 {
		margin: 0 auto;
  font-weight: 700;
  color: #F3143A;
  font-family: 'futurab';
  text-transform: uppercase;
	text-align: center;
		margin-top: 30px;
		
	}
            /* Grid kota */
            .grid {
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(20%,1fr));
            gap:20px;
            }
            .card {
            position:relative;
            border-radius:0px;
            overflow:hidden;
            cursor:pointer;
            box-shadow:var(--shadow);
            background-size:cover;
            background-position:center;
            height:160px;
            display:flex;
            align-items:flex-end;
            transition:transform .25s ease, box-shadow .25s ease;
            }
            .card::after {
            content:"";
            position:absolute;
            inset:0;
            background:linear-gradient(180deg,rgba(0,0,0,0.0) 40%,rgba(0,0,0,0.45));
            }
            .card:hover {
            transform:translateY(-6px);
            box-shadow:0 12px 26px rgba(0,0,0,0.12);
            }
            .label {
            position:relative;
            z-index:2;
            color:#fff;
            font-weight:700;
            font-size:16px;
            padding:12px;
            text-align:center;
            width:100%;
            }

            /* Halaman daftar tempat */
            .places-view {
            animation:fadeIn .35s ease both;
				margin-top: 40px;
            }
            .places-header {
            display:flex;
            align-items:center;
            justify-content:space-between;
            flex-wrap:wrap;
            margin:10px 0 20px;
            }
            .places-title {
            font-size: 22px;
  font-weight: 700;
  color: #000;
  margin: 40px auto 20px;
            }
            .back-btn {
            text-decoration: none;
		  color: #fff;
		  font-weight: 600;
		  font-size: 18px;
		  background-color: #0d306f;
		  padding: 10px 35px;
		  margin-top: 40px;
		  position: relative;
		  text-transform: uppercase;
            }

            /* Daftar tempat per kota */
            .places-grid {
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(20%,1fr));
			 grid-template-columns: 1fr 1fr 1fr 1fr;
            gap:20px;
            }
            .place-card {
            width: 100%;
            background:var(--card);
            border-radius: 0px;
            overflow:hidden;
            box-shadow:var(--shadow);
            display:flex;
            flex-direction:column;
            transition:transform .2s ease, box-shadow .2s ease;
            }
            .place-card:hover {
            transform:translateY(-5px);
            box-shadow:0 14px 30px rgba(0,0,0,0.12);
            }
            .place-photo {
            height:160px;
            background-size:cover;
            background-position:center;
            }
            .place-body {
            padding:14px;
            flex:1;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
            gap:12px;
            }
            .place-name {
            font-weight:700;
            font-size:15px;
            }
            .place-address {
            font-size:13px;
            color:var(--muted);
            }

            /* Tombol Instagram & Gmaps */
            .btn {
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding:8px 12px;
            border-radius:10px;
            font-weight:600;
            font-size:13px;
            text-decoration:none;
            transition:background .2s ease;
            line-height:1.2;
            }
            .btn-ig {
            background:#0d306f;
            color:#fff;
            }
            .btn-ig:hover {
            background:#1c4e95;
				color: #fff
            }
            .btn-maps {
            background:#d20911;
            color:#fff;
            }
            .btn-maps:hover {
            background:#940208;
				color:#fff;
	}.but-back {
		display: block;
		width: 100%;
		text-align: center;
		margin-top: 50px;
	}

            /* Animasi transisi */
            @keyframes fadeIn {
            from { opacity:0; transform:translateY(6px); }
            to { opacity:1; transform:none; }
            }
	@media (min-width: 1400px) {
		.container {
			width : 1320px;
		}
	}
	@media (max-width: 760px){
		.grid {
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(40%,1fr));
            gap:10px;
            }
            .card {
            position:relative;
            border-radius:0px;
            overflow:hidden;
            cursor:pointer;
            box-shadow:var(--shadow);
            background-size:cover;
            background-position:center;
            height:160px;
            display:flex;
            align-items:flex-end;
            transition:transform .25s ease, box-shadow .25s ease;
            }
		  .places-grid {
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(100%,1fr));
            gap:20px;
            }
	}

    </style>
<div class='min-height'>
  <div class='container'>
    <div class='row'>
      <!-- HOME HERO -->
      <div class='col-md-12'>
        <h3>Temuin ruang yang nyatu sama vibe lo!</h3>
        <p style="font-size: 18px; color: #000; margin-top: 20px; margin-bottom: 0px;">Mau itu <strong>Event</strong> atau cuma <strong>Hangout</strong>, pilih <strong>Scene</strong> lo di sini</p>
      </div>
    </div>
    <main>
      <!-- HANGOUT PAGE -->
      <section id="hangoutPage" class="places-view">
        <div class="places-header">
          <h3 class="places-title">Pilih Kota</h2>
        </div>
		
		
		
		<!--<div align="center">
    <img src="https://authenticity.ext.grid.co.id/assets/front/img/peta-ind.jpg" alt="Workplace" width="100%" usemap="#workmap">&nbsp;
    <map name="workmap">
      <area shape="rect" coords="277,231,297,248" alt="Phone" href="semarang.htm">
      <area shape="rect" coords="240,242,259,260" alt="Computer" href="bandung.htm">
  <area shape="rect" coords="218,219,237,237" alt="Computer" href="jakarta.htm">
  <area shape="rect" coords="320,236,340,253" alt="Phone" href="surabaya.htm">
    </map>
</div>-->
		
        <div class="grid" id="cityGrid"></div>
      </section>

      <!-- CAFE PAGE -->
      <section id="cafesPage" class="places-view">
        <div class="places-header">
          <h2 class="places-title" id="cityTitle"></h2>
        </div>
        <div class="places-grid" id="placesGrid"></div>
		<div class="but-back"><a href="#" class="back-btn" id="backToCities">← Kembali</a></div>
      </section>
    </main>
  </div>
</div>
<script>
 // === AUTO OPEN CITY DARI URL PARAM ===
document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const urlCity = params.get("city");

    if (!urlCity) return;

    // Ubah menjadi kapital semua
    const formattedCity = urlCity.trim().toUpperCase();

    let retry = 0;
    const tryOpenCity = () => {
        retry++;

        // Buat list kota dari FULL_DATA juga dalam huruf kapital
        const cities = [...new Set(FULL_DATA.map(p => p.city.toUpperCase()))];

        if (cities.includes(formattedCity)) {

            // Untuk openCity(), harus kembali ke format normal (Capitalized)
            const properName = formattedCity.charAt(0) + formattedCity.slice(1).toUpperCase();

            openCity(properName);
            return;
        }

        // retry sampai 10 kali, tiap 150ms
        if (retry < 10) {
            setTimeout(tryOpenCity, 100);
        }
    };

    tryOpenCity();
});

</script>

<script>
// const FULL_DATA = [
//   { city:"Bandung", name:"HAFA WAREHOUSE", address:"Hafa Warehouse", ig:"hafawarehouse" },
//   { city:"Bandung", name:"SEIN KIRI", address:"SEINKIRI Coffee Kitchen Space", ig:"seinkiri.id" },
//   { city:"Bandung", name:"LALANA SPACE", address:"Lalana Space", ig:"lalana.space" },
//   { city:"Jakarta", name:"HOTEL IBIS", address:"Jl. Gajah Mada No.3, Jakarta Pusat", ig:"ibisstyles" },
//   { city:"Palembang", name:"OMAH KOPI", address:"Jl. Mayor Ruslan No.17, Palembang", ig:"omahkopirupa" },
//   { city:"Semarang", name:"APERIO", address:"Aperio Dining and Soiree", ig:"aperio.smg" },
//   { city:"Tasikmalaya", name:"PRAYA COFFEE", address:"Praya Coffee, Tasikmalaya", ig:"prayacoffee" },
//   { city:"Lampung", name:"DUNNO COFFEE", address:"Jl. Zainal Abidin Pagar Alam, Bandar Lampung", ig:"dunnocoffee_" },
//   { city:"Kendari", name:"DILOOKA COFFEE", address:"Jl. Abunawas No.35, Kendari", ig:"looca" },
//   { city:"Serang", name:"KOPI 113", address:"Jl. Raya Taktakan No.15, Serang, Banten", ig:"" },
//   { city:"Padang", name:"JALAN PUSAT", address:"Jl. Jakarta No.1, Padang", ig:"jalan.pusat" },
// ];
const FULL_DATA = [
<?php foreach($outlet as $row): ?>
  { 
    city: "<?= ucwords($row['kota']) ?>",
    name: "<?= addslashes($row['nama_outlet']) ?>",
    address: "<?= addslashes($row['alamat']) ?>",
    mediasources: "<?= addslashes($row['media_source']) ?>",
    ig: "<?= $row['sosmed'] ?>",
    igurl: "<?= $row['sosmed_url'] ?>"
  },
<?php endforeach; ?>
];
const cityImages = {
<?php foreach($kota as $row): ?>
    "<?= ucwords($row['nama_kota']); ?>": "<?= $row['url_gambar']; ?>",
<?php endforeach; ?>
};

// const cityImages = {
//   "Bandung":"https://asset.kompas.com/crops/GEIiQSsEkCKrIGWEjOp_GaYHIHA=/0x0:1000x667/1200x800/data/photo/2022/07/25/62dec6809a479.jpg",
//   "Jakarta":"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4MnN5gmOG-SiKj6C5BrKhQ9sV3DpcbHzbCw&s",
//   "Palembang":"https://asset.kompas.com/crops/yjJphZ_AK3o2a--v1r0Ne1uWFao=/0x0:0x0/1200x800/data/photo/2021/09/28/61530b8121ee8.jpg",
//   "Semarang":"https://sdnsadeng03.dikdas.semarangkota.go.id/uploads/gallery/media/11.jpg",
//   "Tasikmalaya":"https://assets.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/2022/07/05/3756066958.jpg",
//   "Lampung":"https://www.agoda.com/wp-content/uploads/2024/06/Lampungs-landmark-siger-tower.jpg",
//   "Kendari":"https://cdn.rri.co.id/berita/Ternate/o/1730092402870-IMG_5680/z487dmzdq36o0d4.jpeg",
//   "Serang":"https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0b/f2/70/6d/menara.jpg?w=500&h=500&s=1",
//   "Padang":"https://asset.kompas.com/crops/jbgjGxOn3X773sen40WZH1DB6pg=/0x0:1000x667/1200x800/data/photo/2020/08/28/5f48688bddfb2.jpg"
// };

const hangoutPage = document.getElementById('hangoutPage');
const cafesPage = document.getElementById('cafesPage');
const cityGrid = document.getElementById('cityGrid');
const cityTitle = document.getElementById('cityTitle');
const placesGrid = document.getElementById('placesGrid');

// Jalankan langsung saat halaman dibuka
document.addEventListener('DOMContentLoaded', loadCities);

function loadCities(){
  cityGrid.innerHTML='';
  const cities = [...new Set(FULL_DATA.map(p=>p.city))];
  cities.forEach(city=>{
    const div = document.createElement('div');
    div.className='card';
    div.style.backgroundImage = `url('${cityImages[city] || "https://source.unsplash.com/900x600/?city"}')`;
    div.innerHTML=`<div class="label">${city}</div>`;
    div.onclick=()=>openCity(city);
    cityGrid.appendChild(div);
  });
}

function openCity(city){
  updateCityUrl(city); //load url
  const data = FULL_DATA.filter(p=>p.city===city);
  cityTitle.textContent = city;
  placesGrid.innerHTML='';
  data.forEach(p=>{
    const div = document.createElement('div');
    div.className='place-card';
    div.innerHTML=`
      <div class="place-photo" style="background-image:url('${p.mediasources}')"></div>
      <div class="place-body">
        <div>
          <div class="place-name">${p.name}</div>
          <div class="place-address">${p.ig}</div>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
          ${p.ig?`<a class="btn btn-ig" href="${p.igurl}" target="_blank">Instagram</a>`:''}
          <a class="btn btn-maps" href="${p.address}" target="_blank">Gmaps</a>
        </div>
      </div>`;
    placesGrid.appendChild(div);
  });
  hangoutPage.style.display='none';
  cafesPage.style.display='block';
  window.scrollTo({top:0,behavior:'smooth'});
}

function updateCityUrl(city) {
    const params = new URLSearchParams(window.location.search);
    params.set('city', city.toLowerCase());
    const newUrl = window.location.pathname + '?' + params.toString();
    window.history.pushState({}, '', newUrl);
}

document.getElementById('backToCities').onclick = (e)=>{
  e.preventDefault();
  cafesPage.style.display='none';
  hangoutPage.style.display='block';
};

</script>