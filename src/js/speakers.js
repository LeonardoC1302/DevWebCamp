(function(){
    const speakerInput = document.querySelector('#speakers');

    if (speakerInput) {
        let speakers = [];
        let filteredSpeakers = [];

        const listSpeakers = document.querySelector('#speakers-list');
        const hiddenSpeaker = document.querySelector('[name="speakerId"]');

        getSpeakers();
        speakerInput.addEventListener('input', searchSpeaker);

        if(hiddenSpeaker.value){
            (async() => {
                const speaker = await getSpeaker(hiddenSpeaker.value);
                const {name, lastName} = speaker;
                
                const speakerHTML = document.createElement('li');
                speakerHTML.classList.add('speakers-list__speaker', 'speakers-list__speaker--selected');
                speakerHTML.textContent = `${name.trim()} ${lastName.trim()}`;

                listSpeakers.appendChild(speakerHTML);
            })();
        }

        async function getSpeakers() {
            const url = `/api/speakers`;
            
            const response = await fetch(url);
            const result = await response.json();

            formatSpeakers(result);
        }

        async function getSpeaker(id){
            const url = `/api/speaker?id=${id}`;
            const response = await fetch(url);
            const result = await response.json();

            return result;
        }

        function formatSpeakers(arraySpeakers = []){
            speakers = arraySpeakers.map( speaker => {
                return {
                    name: `${speaker.name.trim()} ${speaker.lastName.trim()}`,
                    id: speaker.id
                }
            })
        }

        function searchSpeaker(e){
            const search = e.target.value.trim();
            if(search.length >= 3){
                const expression = new RegExp(search, 'i');
                filteredSpeakers = speakers.filter( speaker => {
                    if(speaker.name.toLowerCase().search(expression) != -1){
                        return speaker;
                    }
                });
            } else{
                filteredSpeakers = [];
            }
            showSpeakers();
        }

        function showSpeakers(){
            while(listSpeakers.firstChild){
                listSpeakers.removeChild(listSpeakers.firstChild);
            }

            if(filteredSpeakers.length > 0){
                filteredSpeakers.forEach( speaker => {
                    const speakerHTML = document.createElement('li');
                    speakerHTML.classList.add('speakers-list__speaker');
                    speakerHTML.textContent = speaker.name;
                    speakerHTML.dataset.speakerId = speaker.id;
                    speakerHTML.onclick = selectSpeaker;

                    listSpeakers.appendChild(speakerHTML);
                })
            } else{
                const noResults = document.createElement('P');
                noResults.classList.add('speakers-list__no-result');
                noResults.textContent = 'No Results Found';
                listSpeakers.appendChild(noResults);
            }
        }

        function selectSpeaker(e){
            const speaker = e.target;

            const previousSpeaker = document.querySelector('.speakers-list__speaker--selected');
            if(previousSpeaker){
                previousSpeaker.classList.remove('speakers-list__speaker--selected');
            }

            speaker.classList.add('speakers-list__speaker--selected');

            hiddenSpeaker.value = speaker.dataset.speakerId;
        }
    }
})();