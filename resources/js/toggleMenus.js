const setupUI = () => {

    function toggleLanguageSelect() {
        const translateRadio = document.querySelector('input[name="prompt"][value="2"]');
        const languageSelect = document.getElementById('languageSelect');
        if (languageSelect && translateRadio) {
            languageSelect.style.display = translateRadio.checked ? 'block' : 'none';
        }
    }

    function toggleModal(e) {
        e.preventDefault();
        const modal = document.getElementById('settingsModal');
        if (modal) {
            modal.classList.toggle('hidden');
        }
    }

    const translateRadios = document.querySelectorAll('input[name="prompt"]');
    translateRadios.forEach(radio => {
        radio.addEventListener('change', toggleLanguageSelect);
    });

    const modalTriggers = document.querySelectorAll('[data-modal-trigger]');
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', toggleModal);
    });

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('settingsModal');
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });

    window.addEventListener('keydown', function(event) {
        const modal = document.getElementById('settingsModal');
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
        }
    });

    toggleLanguageSelect();
};

export default setupUI;