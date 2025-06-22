  const box = document.querySelector('.box');

  let offsetX = 0;
  let offsetY = 0;
  let isDragging = false;

  box.addEventListener('mousedown', startDrag);
  document.addEventListener('mousemove', duringDrag);
  document.addEventListener('mouseup', stopDrag);

  // Mobil destek için
  box.addEventListener('touchstart', startDrag);
  document.addEventListener('touchmove', duringDrag);
  document.addEventListener('touchend', stopDrag);

  function startDrag(e) {
    isDragging = true;
    box.style.cursor = 'grabbing';
    const rect = box.getBoundingClientRect();
    const clientX = e.clientX || e.touches[0].clientX;
    const clientY = e.clientY || e.touches[0].clientY;
    offsetX = clientX - rect.left;
    offsetY = clientY - rect.top;
  }

  function duringDrag(e) {
    if (!isDragging) return;
    const clientX = e.clientX || e.touches[0].clientX;
    const clientY = e.clientY || e.touches[0].clientY;
    box.style.left = (clientX - offsetX) + 'px';
    box.style.top = (clientY - offsetY) + 'px';
  }

  function stopDrag(e) {
    isDragging = false;
    box.style.cursor = 'grab';
  }