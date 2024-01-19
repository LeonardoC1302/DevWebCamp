import Swal from "sweetalert2";

(function(){
    let events = [];
    const summary = document.querySelector('#register-summary');

    if(summary){

        const eventButtons =  document.querySelectorAll('.event__add');
        eventButtons.forEach(button => button.addEventListener('click', selectEvent));
        const registerForm = document.querySelector('#register');
        registerForm.addEventListener('submit', submitForm);

        showEvents();
    
        function selectEvent(e){
            if(events.length < 5){
                e.target.disabled = true;
                events = [...events, {
                    id: e.target.dataset.id,
                    title: e.target.parentElement.querySelector('.event__name').textContent.trim()
                }];
        
                showEvents();
            } else{
                Swal.fire({
                    title: 'Error',
                    text: 'You can only select 5 events',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            }
        }
    
        function showEvents(){
            clearEvents();
    
            if(events.length > 0){
                events.forEach(event => {
                    const eventDOM = document.createElement('div');
                    eventDOM.classList.add('register__event');
    
                    const title = document.createElement('h3');
                    title.classList.add('register__name');
                    title.textContent = event.title;
    
                    const deleteButton = document.createElement('button');
                    deleteButton.classList.add('register__delete');
                    deleteButton.innerHTML = `<i class="fa-solid fa-trash"></i>`;
                    deleteButton.onclick = function(){
                        deleteEvent(event.id);
                    }
    
                    eventDOM.appendChild(title);
                    eventDOM.appendChild(deleteButton);
                    summary.appendChild(eventDOM);
                });
            } else{
                const noRegister = document.createElement('p');
                noRegister.textContent = 'No events selected, add up to 5 events';
                noRegister.classList.add('register__text');
                summary.appendChild(noRegister);
            }
        }
    
        function deleteEvent(id){
            events = events.filter(event => event.id !== id);
            const buttonAdd = document.querySelector(`[data-id="${id}"]`);
            buttonAdd.disabled = false;
            showEvents();
        }
    
        function clearEvents(){
            while(summary.firstChild){
                summary.removeChild(summary.firstChild);
            }
        }

        async function submitForm(e){
            e.preventDefault();

            const giftId = document.querySelector('#gift').value;
            const eventsId = events.map(event => event.id);

            if(eventsId.length === 0 || giftId === ''){
                Swal.fire({
                    title: 'Error',
                    text: 'Choose at least one event and a gift',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
                return;
            }

            const data = new FormData();
            data.append('events', eventsId);
            data.append('giftId', giftId)

            const url = '/finish-registration/conferences';
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });
            const result = await response.json();

            if(result.result){
                Swal.fire(
                    'Successfull registration',
                    'Your conference has been registered, we will be waiting for you in DevWebCamp',
                    'success'
                ).then(() => location.href = `/ticket?id=${result.token}`)
            } else{
                Swal.fire({
                    title: 'Error',
                    text: 'There was an error, try again later',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                }).then(() => location.reload());
            }
        }
    }

})();