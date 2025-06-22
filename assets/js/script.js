
const boxes = document.querySelectorAll('.box');

boxes.forEach((box, index) => {
  box.style.top = (120 + index * 60) + 'px'; // 20px den başla, her biri 60px aşağıda olsun
  box.style.left = '400px'; // Hepsi solda 20px sabit
});

let activeBox = null;
let offsetX = 0;
let offsetY = 0;

boxes.forEach(box => {
  box.addEventListener('mousedown', startDrag);
  box.addEventListener('touchstart', startDrag);

  box.addEventListener('touchmove', duringDrag);
  box.addEventListener('touchend', stopDrag);
});

document.addEventListener('mousemove', duringDrag);
document.addEventListener('mouseup', stopDrag);

function startDrag(e) {
  activeBox = this;
  activeBox.style.cursor = 'grabbing';

  const rect = activeBox.getBoundingClientRect();
  const clientX = e.clientX || (e.touches && e.touches[0].clientX);
  const clientY = e.clientY || (e.touches && e.touches[0].clientY);

  offsetX = clientX - rect.left;
  offsetY = clientY - rect.top;

  e.preventDefault(); // Mobilde tarayıcı kaydırmasını engeller
}

function duringDrag(e) {
  if (!activeBox) return;

  const clientX = e.clientX || (e.touches && e.touches[0].clientX);
  const clientY = e.clientY || (e.touches && e.touches[0].clientY);

  activeBox.style.left = (clientX - offsetX) + 'px';
  activeBox.style.top = (clientY - offsetY) + 'px';

  e.preventDefault();
}

function stopDrag() {
  if (activeBox) {
    activeBox.style.cursor = 'grab';
    activeBox = null;
  }
}