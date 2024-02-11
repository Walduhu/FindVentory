document.addEventListener('DOMContentLoaded', function () {
    const languageToggleCheckbox = document.getElementById('language-toggle-checkbox');
    const englishLabel = document.getElementById('english-label');
    const germanLabel = document.getElementById('german-label');
    const englishContent = document.getElementById('english-content');
    const germanContent = document.getElementById('german-content');
    const pageTitle = document.getElementById('page-title');
    const storedLanguage = localStorage.getItem('languagePreference');

    if (storedLanguage === 'german') {
        languageToggleCheckbox.checked = true;
        updateContent('german');
    } else {
        updateContent('english');
    }

    languageToggleCheckbox.addEventListener('change', function () {
        const selectedLanguage = languageToggleCheckbox.checked ? 'german' : 'english';
        updateContent(selectedLanguage);

        localStorage.setItem('languagePreference', selectedLanguage);
    });

    function updateContent(language) {
        if (language === 'german') {
            englishContent.style.display = 'none';
            germanContent.style.display = 'block';

            englishLabel.style.opacity = '0.5';
            germanLabel.style.opacity = '1';

            pageTitle.innerText = 'Inventarisierung';
        } else {
            englishContent.style.display = 'block';
            germanContent.style.display = 'none';

            englishLabel.style.opacity = '1';
            germanLabel.style.opacity = '0.5';

            pageTitle.innerText = 'Inventory';
        }
    }
});


