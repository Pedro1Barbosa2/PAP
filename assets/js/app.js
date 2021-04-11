var modBtn = document.querySelector('.buttonbg');
var modbg = document.querySelector('.modal-bg');
var modclose = document.querySelector('.modal-close');

modBtn.addEventListener('click', function(){
    modbg.classList.add('bg-active');
});
modclose.addEventListener('click', function(){
    modbg.classList.remove('bg-active');
});