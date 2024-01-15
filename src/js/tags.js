(function(){
    const tagsInput = document.querySelector('#tags__input');

    if(tagsInput){
        const tagsDiv = document.querySelector('#tags');
        const tagsHiddenInput = document.querySelector('[name="tags"]');
        let tags = [];
        if(tagsHiddenInput.value !== ''){
            tags = tagsHiddenInput.value.split(',');
            showTags();
        }

        tagsInput.addEventListener('keypress', saveTag);

        function saveTag(e){
            if(e.keyCode === 44){
                if(e.target.value.trim() === '' || e.target.value < 1){
                    return;
                }
                e.preventDefault();
                tags = [...tags, e.target.value.trim()];
                tagsInput.value = '';
                
                showTags();
            }
        }

        function showTags(){
            tagsDiv.textContent = '';
            tags.forEach(tag => {
                const tagDiv = document.createElement('LI');
                tagDiv.classList.add('form__tag');
                tagDiv.textContent = tag;
                tagDiv.ondblclick = deleteTag;
                tagsDiv.appendChild(tagDiv);
            })

            updateHiddenInput();
        }

        function deleteTag(e){
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);
            updateHiddenInput();
        }

        function updateHiddenInput(){
            tagsHiddenInput.value = tags.join(',');
        }
    }
})();