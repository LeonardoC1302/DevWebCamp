if(document.querySelector('#map')){
    const lat = 9.976528726901492;
    const lng = -84.15096418242396;
    const zoom = 16;

    const map = L.map('map').setView([lat, lng], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup(`
            <h2 class="map__heading">DevWebCamp</h2>
            <p class="map__text">Costa Rica Convention Center</p>
        `)
        .openPopup();
}