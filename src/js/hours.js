(function(){
    const hours = document.querySelector('#hours');

    if(hours){

        let search = {
            categoryId: '',
            day: ''
        }

        const categoryId = document.querySelector('[name="categoryId"]');
        const days = document.querySelectorAll('[name="day"]');
        const hiddenDayInput = document.querySelector('[name="dayId"]');
        const hiddenHourInput = document.querySelector('[name="hourId"]');
        
        categoryId.addEventListener('change', searchTerm);
        days.forEach(day => day.addEventListener('change', searchTerm))

        function searchTerm(e){
            search[e.target.name] = e.target.value;

            hiddenHourInput.value = '';
            hiddenDayInput.value = '';
            
            const previousHour = document.querySelector('.hours__hour--selected');
            if(previousHour){
                previousHour.classList.remove('hours__hour--selected');
            }

            if(Object.values(search).includes('')){
                return;
            }
            searchEvents();
        }
        
        async function searchEvents(){
            const {day, categoryId} = search;
            const url = `/api/events-schedule?day=${day}&categoryId=${categoryId}`;
            
            const response = await fetch(url);
            const events = await response.json();

            getAvailableHours(events);
        }

        function getAvailableHours(events){
            const hourList = document.querySelectorAll('#hours li');
            hourList.forEach(li => li.classList.add('hours__hour--disabled'));


            const takenHours = events.map(event => event.hourId);
            const hourListArray = Array.from(hourList);
            const result = hourListArray.filter(li => !takenHours.includes(li.dataset.hourid));

            result.forEach(li => li.classList.remove('hours__hour--disabled'));

            const availableHours = document.querySelectorAll('#hours li:not(.hours__hour--disabled)');
            availableHours.forEach(hour => hour.addEventListener('click', selectHour));
        }

        function selectHour(e){
            const previousHour = document.querySelector('.hours__hour--selected');
            if(previousHour){
                previousHour.classList.remove('hours__hour--selected');
            }
            e.target.classList.add('hours__hour--selected')

            hiddenHourInput.value = e.target.dataset.hourid;
            hiddenDayInput.value = document.querySelector('[name="day"]:checked').value;
        }
    }
})();