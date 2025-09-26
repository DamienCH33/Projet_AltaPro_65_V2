  const images = document.querySelectorAll('.gallery-item');
  const modalImage = document.getElementById('modalImage');
  const galleryModal = new bootstrap.Modal(document.getElementById('galleryModal'));
  let currentIndex = 0;

  // Ouvrir modal au clic sur miniature
  images.forEach(img => {
    img.addEventListener('click', () => {
      currentIndex = parseInt(img.getAttribute('data-index'));
      showImage();
      galleryModal.show();
    });
  });

  // Affiche l'image selon l'index courant
  function showImage() {
    modalImage.src = images[currentIndex].src;
  }

  // Navigation
  document.getElementById('prevBtn').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    showImage();
  });

  document.getElementById('nextBtn').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % images.length;
    showImage();
  });