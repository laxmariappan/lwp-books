// Show hide subscription form on click.
document.addEventListener('DOMContentLoaded', function() {
    const subscribeButton = document.getElementById('show-lwp-subscription-form');
    const subscribeForm = document.querySelector('.lwp-subscription-form');

    // Toggle visibility of subscription form on button click.
    subscribeButton.addEventListener('click', function() {
        subscribeForm.classList.toggle('hidden');
    });


});