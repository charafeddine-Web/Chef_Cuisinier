let profileButton = document.getElementById('profile');
let profileForm = document.getElementById('profileForm');

profileButton.addEventListener('click', function() {
    profileForm.classList.toggle('hidden');
});

let close=document.getElementById('close');
close.addEventListener('click', function() {
    profileForm.classList.toggle('hidden');
});
